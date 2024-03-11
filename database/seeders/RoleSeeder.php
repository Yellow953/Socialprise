<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RoleSeeder extends Seeder
{
    public function run(): void
    {
        $now = now();
        $roleId = 1;

        DB::table('roles')->insert([
            'id' => $roleId,
            'name' => 'Blog',
            'description' => 'this is a blog',
            'created_at' => $now,
            'updated_at' => $now,
        ]);

        $metricRoleData = [
            ['role_id' => $roleId, 'metric_id' => 17],
            ['role_id' => $roleId, 'metric_id' => 18],
            ['role_id' => $roleId, 'metric_id' => 19],
        ];

        DB::table('metric_role')->insert($metricRoleData);
    }
}
