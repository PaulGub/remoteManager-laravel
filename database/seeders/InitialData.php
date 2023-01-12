<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class InitialData extends Seeder
{

    public function run()
    {
        User::truncate();

        User::create([
            "email" => "admin@dawin.test",
            "password" => Hash::make("admin"),
            "name" => "Admin",
        ]);

        foreach (range(1, 10) as $i) {
            User::create([
                "email" => "salarie{$i}@dawin.test",
                "password" => Hash::make("salarie{$i}"),
                "name" => "Salarié n°{$i}",
            ]);
        }
    }
}
