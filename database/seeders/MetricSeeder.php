<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class MetricSeeder extends Seeder
{
    public function run(): void
    {
        $csvFile = database_path('seeds/metrics.csv');
        $data = array_map('str_getcsv', file($csvFile));
        $header = array_shift($data);

        foreach ($data as $row) {
            DB::table('metrics')->insert([
                'name' => $row[0],
                'code' => $row[1],
                'description' => $row[2],
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}
