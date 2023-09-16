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
        Schema::create('news_reporters', function (Blueprint $table) {
            $table->id();
            $table->string('image');
            $table->string('name');
            $table->string('phone');
            $table->string('email')->unique();
            $table->string('nid_no')->unique();
            $table->string('father_name');
            $table->string('mother_name');
            $table->text('present_address');
            $table->text('permanent_address');
            $table->date('joining_date');
            $table->string('password');
            $table->integer('role')->default(1);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('news_reporters');
    }
};
