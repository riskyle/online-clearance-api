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
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->tinyInteger('role_id')->unsigned();
            $table->foreign('role_id')->references('id')->on('roles')->cascadeOnDelete();
            $table->rememberToken();
            $table->string('profile_picture')->nullable();
            $table->timestamps();
        });

        Schema::create('students', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->cascadeOnDelete();
            $table->bigInteger(column: 'lrn', unsigned: true)->unique();
            $table->string('student_firstname');
            $table->string('student_middlename')->nullable();
            $table->string('student_lastname');
            $table->integer('student_year_level');
            $table->string('student_mobile_number')->unique()->nullable();
            $table->string('student_address')->nullable();
            $table->string('student_sex')->nullable();
            $table->integer('student_age')->nullable();
            $table->date('student_birthdate')->nullable();
            $table->string('student_religion')->nullable();
            $table->string('student_civil_status')->nullable();
            $table->string('student_father_name')->nullable();
            $table->string('student_mother_name')->nullable();
            $table->string('student_guardian_name')->nullable();
            $table->string('student_section');
            $table->string('student_type')->comment("jhs - Junior High School, shs - Senior High School");
            $table->timestamps();
        });

        Schema::create('school_personnels', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->cascadeOnDelete();
            $table->string("sp_firstname");
            $table->string("sp_middlename")->nullable();
            $table->string("sp_lastname");
            $table->string("sp_mobile_number")->unique()->nullable();
            $table->string("sp_address")->nullable();
            $table->string("sp_sex");
            $table->date("sp_birthdate")->nullable();
            $table->string("sp_age")->nullable();
            $table->string("sp_religion")->nullable();
            $table->string("sp_civil_status")->nullable();
            $table->timestamps();
        });

        Schema::create('password_reset_tokens', function (Blueprint $table) {
            $table->string('email')->primary();
            $table->string('token');
            $table->timestamp('created_at')->nullable();
        });

        Schema::create('sessions', function (Blueprint $table) {
            $table->string('id')->primary();
            $table->foreignId('user_id')->nullable()->index();
            $table->string('ip_address', 45)->nullable();
            $table->text('user_agent')->nullable();
            $table->longText('payload');
            $table->integer('last_activity')->index();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
        Schema::dropIfExists('students');
        Schema::dropIfExists('school_personnels');
        Schema::dropIfExists('password_reset_tokens');
        Schema::dropIfExists('sessions');
    }
};
