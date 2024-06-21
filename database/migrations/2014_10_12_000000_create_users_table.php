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
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->enum('role',['user','admin']);
            $table->string('username',16)->unique();
            $table->string('password');
            $table->string('nama_lengkap',50);
            $table->date('tanggal_lahir');
            $table->string('nama_sekolah',50);
            $table->string('alamat',100);
            $table->string('email',100)->unique();
            $table->string('foto_profile');
            $table->integer('otp')->nullable();
            $table->timestamps();

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
    }
};
