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
        Schema::create('student_profiles', function (Blueprint $table) {
            $table->id();

            $table->string('full_name');
            $table->date('date_of_birth');
            $table->text('address');
            $table->string('phone_number');
            $table->string('license_type');
            $table->boolean('documents_given')->default(false)->comment('basic documents like nic,birth certify');
            $table->string('branch'); // should change as foreign use branch code

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('student_profiles');
    }
};
