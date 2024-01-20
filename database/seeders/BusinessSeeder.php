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
            'name' => 'Wood And Gaz',
            'page_id' => '106543052204531',
            'access_token' => 'EAALtErloVa4BOZBI0chixwhtbDsQG5oPFMmAMvqZByS2cb59xVsUcW1EoDZCGPTRfklNwy6sEyhwZAxjwydK7kVp9ZBKgpOaUGrvg7nBAnZAuBV4sBmIOBHsPm36Ny0pRB6ApW7RW9QpM7SzS70YzInQG2UP8ZCRlHS48qyvMx5LR1IQHRJYZBEt3rLZCnGKRupiDZACXlusJQyHuC',
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        DB::table('businesses')->insert([
            'name' => 'Social Prize',
            'page_id' => '107599201926561',
            'access_token' => 'EAAUUCEZBUZAC8BOzyQM9nASkZAt9LZAOs8fl38ubj8KrPQxC4H1bb6BMznW4PoPJSxhwDZAnbZCQ7eTfYdbZCcD0esblsha4qIWPeQSE3lllPjMAjINAK7WwZCTGNoHCvAaAqw8RcvDIoYNREhNPOw5HwHpZC93oGUZBFPpF4jv28cdcvBHn3FgXlTOK78bxIGdklOudwx12Eni7AE',
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }
}
