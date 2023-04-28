<?php

namespace App\Database\Seeds;

use App\Models\Counter;
use CodeIgniter\Database\Seeder;

class CounterSeeder extends Seeder
{
    public function run()
    {
        model(Counter::class)->insertBatch([
            ['user_id' => 1, 'name' => 'Loket 1'],
            ['user_id' => 2, 'name' => 'Loket 2'],
        ]);
    }
}
