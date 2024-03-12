<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
{
    // Check if the users table doesn't exist before creating
    if (!Schema::hasTable('users')) {
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('username');
            $table->string('password');
            $table->enum('role', ['GM', 'manager', 'teacher', 'student']);
            $table->bigInteger('school_id')->unsigned()->nullable();
            $table->string('subject');
            $table->integer('class');
            $table->timestamps();
        });
    }
}

public function down()
{
    Schema::dropIfExists('users');
}
};
