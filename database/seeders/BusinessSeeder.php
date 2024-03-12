<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class BusinessSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('businesses')->insert([
            'name' => 'Working Remotely Tools',
            'page_id' => '107599201926561',
            'instagram_business_account' => '17841452749614836',
            'access_token' => 'EAAUUCEZBUZAC8BOZBZAxzJJd1pEtfUykQRKTmznfxkVVXDiIghgJH4t5klqgfpJ2o73pp3aNjqPBtzyQ846QvE1xmKORBhrTuzOgX2xZBDpXpGuSMVyfO4xLCssxGy9cjsxQZAbtOvQ1BwocFklDFZCcpZACREeguodH48Fm56rbWugdBmY3b8bfKkiSBq2R4v4wLTqFfP6CKxkT',
            'role_id' => 1,
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }
}
