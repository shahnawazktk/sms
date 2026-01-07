<?php

namespace Tests\Feature;

use App\Models\Attendance;
use App\Models\Student;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class AttendanceTest extends TestCase
{
    use RefreshDatabase;

    public function test_teacher_can_mark_attendance_single()
    {
        $user = User::factory()->create(['role' => 'teacher']);
        $student = Student::factory()->create();

        $response = $this->actingAs($user)->postJson(route('attendance.store'), [
            'student_id' => $student->id,
            'date' => now()->toDateString(),
            'status' => 'present',
        ]);

        $response->assertStatus(200)->assertJson(['success' => true]);

        $this->assertDatabaseHas('attendances', [
            'student_id' => $student->id,
            'status' => 'present',
            'marked_by' => $user->id,
        ]);
    }

    public function test_teacher_can_bulk_mark_attendance()
    {
        $user = User::factory()->create(['role' => 'teacher']);

        $students = Student::factory()->count(3)->create();
        $statuses = $students->map(fn($s) => ['student_id' => $s->id, 'status' => 'present'])->toArray();

        $response = $this->actingAs($user)->postJson(route('attendance.bulk'), [
            'date' => now()->toDateString(),
            'statuses' => $statuses,
        ]);

        $response->assertStatus(200)->assertJson(['success' => true]);

        foreach ($students as $s) {
            $this->assertDatabaseHas('attendances', [
                'student_id' => $s->id,
                'status' => 'present',
                'marked_by' => $user->id,
            ]);
        }
    }

    public function test_staff_can_mark_attendance()
    {
        $user = User::factory()->create(['role' => 'staff']);
        $student = Student::factory()->create();

        $response = $this->actingAs($user)->postJson(route('attendance.store'), [
            'student_id' => $student->id,
            'date' => now()->toDateString(),
            'status' => 'present',
        ]);

        $response->assertStatus(200)->assertJson(['success' => true]);

        $this->assertDatabaseHas('attendances', [
            'student_id' => $student->id,
            'status' => 'present',
            'marked_by' => $user->id,
        ]);
    }

    public function test_teacher_can_export_attendance_csv()
    {
        $user = User::factory()->create(['role' => 'teacher']);
        $students = Student::factory()->count(2)->create();

        foreach ($students as $s) {
            Attendance::create(['student_id' => $s->id, 'date' => now()->toDateString(), 'status' => 'present', 'marked_by' => $user->id]);
        }

        $response = $this->actingAs($user)->get(route('attendance.export', ['date' => now()->toDateString(), 'type' => 'csv']));

        $response->assertStatus(200);
        $this->assertStringContainsString('text/csv', $response->headers->get('content-type'));
        $this->assertStringContainsString('student_id,student_name,status,marked_by,updated_at', $response->getContent());
    }

    public function test_teacher_can_export_attendance_excel()
    {
        $user = User::factory()->create(['role' => 'teacher']);
        $students = Student::factory()->count(2)->create();

        foreach ($students as $s) {
            Attendance::create(['student_id' => $s->id, 'date' => now()->toDateString(), 'status' => 'present', 'marked_by' => $user->id]);
        }

        $response = $this->actingAs($user)->get(route('attendance.export', ['date' => now()->toDateString(), 'type' => 'excel']));

        $response->assertStatus(200);
        $this->assertStringContainsString('application/vnd.openxmlformats-officedocument.spreadsheetml.sheet', $response->headers->get('content-type'));
    }

    public function test_teacher_can_export_attendance_pdf()
    {
        $user = User::factory()->create(['role' => 'teacher']);
        $students = Student::factory()->count(2)->create();

        foreach ($students as $s) {
            Attendance::create(['student_id' => $s->id, 'date' => now()->toDateString(), 'status' => 'present', 'marked_by' => $user->id]);
        }

        $response = $this->actingAs($user)->get(route('attendance.export', ['date' => now()->toDateString(), 'type' => 'pdf']));

        $response->assertStatus(200);
        $this->assertStringContainsString('application/pdf', $response->headers->get('content-type'));
    }

    public function test_non_privileged_user_cannot_export()
    {
        $user = User::factory()->create(['role' => 'viewer']);
        $response = $this->actingAs($user)->get(route('attendance.export', ['date' => now()->toDateString()]));
        $response->assertStatus(403);
    }
}
