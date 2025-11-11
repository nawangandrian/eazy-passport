<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;

class UserSeeder extends Seeder
{
    /**
     * Jalankan seeder untuk tabel users.
     */
    public function run(): void
    {
        DB::table('users')->insert([
            [
                'username'      => 'pic_user',
                'password'      => Hash::make('password123'),
                'nama_lengkap'  => 'Perwakilan Pemohon',
                'email'         => 'pic@example.com',
                'no_telepon'    => '081234567890',
                'role'          => 'PIC',
                'status'        => 'Aktif',
                'created_at'    => now(),
                'updated_at'    => now(),
            ],
            [
                'username'      => 'petugas_user',
                'password'      => Hash::make('password123'),
                'nama_lengkap'  => 'Petugas Imigrasi',
                'email'         => 'petugas@example.com',
                'no_telepon'    => '081298765432',
                'role'          => 'PETUGAS',
                'status'        => 'Aktif',
                'created_at'    => now(),
                'updated_at'    => now(),
            ],
            [
                'username'      => 'kepala_kantor',
                'password'      => Hash::make('password123'),
                'nama_lengkap'  => 'Kepala Kantor Imigrasi',
                'email'         => 'kepala@example.com',
                'no_telepon'    => '081212341234',
                'role'          => 'KEPALA_KANTOR',
                'status'        => 'Aktif',
                'created_at'    => now(),
                'updated_at'    => now(),
            ],
        ]);
    }
}
