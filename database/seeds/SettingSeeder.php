<?php

use Illuminate\Database\Seeder;
use App\Models\Setting;

class SettingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Setting::create([
            'salestype'=>'indirect',
            'salesale'=>'last',
            'buyopration'=>'indirect',
            'buysale'=>'last',
        ]);
    }
}
