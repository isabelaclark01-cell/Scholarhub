<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint; // Make sure this line is at the top
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('students', function (Blueprint $table) { // Changed 'Table' to 'Blueprint'
            $table->id();
            $table->string('name');
            $table->string('student_id')->unique();
            $table->string('course');
            $table->string('year');
            $table->string('status')->default('Active');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('students');
    }
};
