<?php

namespace Database\Seeders;

use App\Models\Manager;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class ManagerTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $Manager = [
            'first_name' => "mostafa",
            'last_name' => "mahmoud",
            'email' => "mostafamahmoud111115@gmail.com",
            'phone' => "01110347546",
            'password' => Hash::make("123456789")
        ];

        Manager::create($Manager);
    }
}
