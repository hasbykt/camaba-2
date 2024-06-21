<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // \App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);
        User::create([
            'role' => 'admin',
            'username' => 'admin1',
            'password' => Hash::make('qwertyuiop123'),
            'nama_lengkap' => 'admin 1 camaba',
            'tanggal_lahir' => '2024-01-01',
            'nama_sekolah' => 'Universitas Jambi',
            'alamat' => 'jambi',
            'email' => 'camaba22@gmail.com',
            'foto_profile' => 'img/thank-removebg-preview-4-WsB.png'
        ]);
        User::create([
            'role' => 'admin',
            'username' => 'admin2',
            'password' => Hash::make('qwertyuiop123'),
            'nama_lengkap' => 'admin 2 camaba',
            'tanggal_lahir' => '2024-01-01',
            'nama_sekolah' => 'Universitas Jambi',
            'alamat' => 'jambi',
            'email' => 'camaba222@gmail.com',
            'foto_profile' => 'img/thank-removebg-preview-4-WsB.png'
        ]);
    }
}
