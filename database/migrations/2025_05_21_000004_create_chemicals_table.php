<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('chemicals', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('cas_number')->nullable();
            $table->string('category');
            $table->decimal('quantity', 10, 2);
            $table->string('unit');
            $table->string('location');
            $table->date('expiry_date')->nullable();
            $table->string('msds_file')->nullable();
            $table->foreignId('lab_id')->constrained()->onDelete('cascade');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('chemicals');
    }
};
