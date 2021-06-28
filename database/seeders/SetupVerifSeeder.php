<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\SetupVerif;

class SetupVerifSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $setup1 = SetupVerif::create([
            'parent_id' => 0,
            'name'      => 'Uploads',
        ]);
    }
}
