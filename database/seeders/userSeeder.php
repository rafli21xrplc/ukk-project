<?php

namespace Database\Seeders;

use App\Models\User;
use Carbon\Carbon;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class userSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        DB::table('roles')->insert([
            [
                'code' => Str::uuid(),
                'name' => "admin",
            ],
            [
                'code' => Str::uuid(),
                'name' => "petugas",
            ],
            [
                'code' => Str::uuid(),
                'name' => "siswa",
            ],
        ]);

        DB::table('petugas')->insert([
            [
                'code' => Str::uuid(),
                'username' => 'admin',
                'password' => bcrypt('password'),
                'nama_petugas' => 'Surya Rafliansyah',
                'level' => 'admin'
            ],
            [
                'code' => Str::uuid(),
                'username' => 'petugas',
                'password' => bcrypt('password'),
                'nama_petugas' => 'Surya Rafliansyah',
                'level' => 'petugas'
            ],
        ]);

        DB::table('users')->insert(
            [
                [
                    'code' => Str::uuid(),
                    'username' => "admin",
                    'password' => bcrypt('password'),
                    'petugas_id' => 1,
                    'role_id' => 1,
                ],
                [
                    'code' => Str::uuid(),
                    'username' => "petugas",
                    'password' => bcrypt('password'),
                    'petugas_id' => 2,
                    'role_id' => 2,
                ],
            ]
        );
    }
}
