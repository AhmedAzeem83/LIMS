<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('calibrations', function (Blueprint $table) {
            $table->id();
            $table->date('calibration_date');
            $table->foreignId('performed_by')->constrained('users')->onDelete('cascade');
            $table->date('next_due_date');
            $table->enum('status', ['passed', 'failed', 'pending'])->default('pending');
            $table->text('notes')->nullable();
            $table->string('certificate')->nullable();
            $table->foreignId('device_id')->constrained()->onDelete('cascade');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('calibrations');
    }
};
