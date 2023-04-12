<?php

namespace Database\Seeders;

use App\Models\Type;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Type::insert([
            [
                'name'=>"Concert",
                'created_at' => now(),
                'updated_at' => now(),
            ],[
                'name'=>"Charity",
                'created_at' => now(),
                'updated_at' => now(),
            ],[
                'name'=>"Product",
                'created_at' => now(),
                'updated_at' => now(),
            ]
        ]);
    }
}
