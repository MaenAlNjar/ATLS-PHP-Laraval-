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
        if(!Schema::hasTable('study_materials')){
            Schema::create('study_materials', function (Blueprint $table) {
                $table->id();
                $table->integer('school_id');
                $table->string('subject_name')->nullable();
                $table->timestamps();
            });
        }
     
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('study_materials');
    }
};
