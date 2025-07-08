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
        Schema::table('users', function (Blueprint $table) {
           
            // $table->string('last_name')->after('first_name');
            // $table->string('admission_number')->unique()->after('last_name');
            // $table->string('roll_number')->nullable()->after('admission_number');
            // Academic Information
            // $table->foreignId('class_id')->references('id')->on('classes')->nullable()->cascadeOnDelete();
            // Personal Details
            $table->enum('gender', ['male', 'female', 'other'])->nullable()->after('class_id');
            $table->date('dob')->nullable()->after('gender');
            $table->integer('age')->nullable()->after('dob');

            $table->string('caste')->nullable()->after('dob');
            // Contact Information
            $table->string('mobile_number', 20)->nullable();
            $table->date('admission_date')->nullable()->after('mobile_number');
            $table->enum('status',[1,0])->default(1);
            // Profile
            $table->string('image')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            //
        });
    }
};
