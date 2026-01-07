<?php

namespace App\Http\Controllers;

use App\Exports\FeesExport;
use App\Models\Fee;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Log;
use Barryvdh\DomPDF\Facade\Pdf;
use Maatwebsite\Excel\Facades\Excel;

class ReportController extends Controller
{
    public function generateFees(Request $request)
    {
        $request->validate(['type' => 'required|in:pdf,excel']);

        $fees = Fee::with('student')->orderBy('created_at', 'desc')->get();
        $timestamp = now()->format('Ymd_His');

        if ($request->type === 'pdf') {
            $pdf = Pdf::loadView('reports.fees', compact('fees'));
            $filename = "fees_{$timestamp}.pdf";
            Storage::put("reports/{$filename}", $pdf->output());
            return response()->json(['file' => route('reports.download', $filename), 'filename' => $filename]);
        }

        // Excel
        $export = new FeesExport($fees);
        $filename = "fees_{$timestamp}.xlsx";
        Excel::store($export, "reports/{$filename}");
        return response()->json(['file' => route('reports.download', $filename), 'filename' => $filename]);
    }

    public function download($filename)
    {
        $path = "reports/{$filename}";
        if (!Storage::exists($path)) {
            abort(404);
        }
        return Storage::download($path);
    }
}
