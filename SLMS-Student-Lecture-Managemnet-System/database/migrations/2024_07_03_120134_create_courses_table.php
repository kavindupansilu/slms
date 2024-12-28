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
        Schema::create('courses', function (Blueprint $table) {
            $table->id();
            $table->string('ccode')->unique();
            $table->string('cname');
            $table->string('credit');
            $table->string('year');
            $table->string('semster');
            $table->string('degree_name');
            $table->string('fname');
            $table->string('lname');
            $table->unsignedBigInteger('degree_id');
            $table->unsignedBigInteger('user_id');
            $table->timestamps();

            // Add foreign key constraints
            $table->foreign('degree_id')->references('id')->on('degrees')->onDelete('cascade');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('courses', function (Blueprint $table) {
            // Drop foreign key constraints
            $table->dropForeign(['degree_id']);
            $table->dropForeign(['lecturer_id']);
        });
        
        Schema::dropIfExists('courses');
    }
};
