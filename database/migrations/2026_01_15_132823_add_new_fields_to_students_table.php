<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('students', function (Blueprint $table) {
            // Naye fields jo Admission form ke liye zaroori hain
            $table->date('dob')->nullable()->after('email');
            $table->string('course')->nullable()->after('phone');
            $table->string('gender')->nullable()->after('course');
            $table->text('address')->nullable()->after('gender');
            $table->string('profile_image')->nullable()->after('address');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('students', function (Blueprint $table) {
            // Rollback ki surat mein ye columns khatam ho jayenge
            $table->dropColumn(['dob', 'course', 'gender', 'address', 'profile_image']);
        });
    }
};