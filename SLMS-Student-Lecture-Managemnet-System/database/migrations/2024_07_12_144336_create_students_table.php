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
        Schema::create('students', function (Blueprint $table) {
            $table->id();
            
            $table->string('student_id')->unique();
            $table->string('nic');
            $table->string('fname');
            $table->string('lname');
            $table->string('gender');
            $table->date('dob');
            $table->string('phone_no')->unique();
            $table->string('address');
            $table->string('email')->unique();
            $table->string('degree_id');
            $table->string('degree_name');
            $table->string('batch_no');
            $table->timestamps();


        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('students');
    }
};
