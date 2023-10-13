<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RegionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $regions = [
            ['name' => 'Miền Bắc', 'status' => 'on'],
            ['name' => 'Miền Trung - Tây Nguyên', 'status' => 'on'],
            ['name' => 'Hà Nội', 'status' => 'on'],
            ['name' => 'Hồ Chí Minh', 'status' => 'on'],
            ['name' => 'ABC Sport', 'status' => 'on'],
            ['name' => 'Miền Nam', 'status' => 'on'],
        ];

        DB::table('regions')->insert($regions);
    }
}
