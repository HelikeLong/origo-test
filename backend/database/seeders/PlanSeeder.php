<?php

namespace Database\Seeders;

use App\Models\Plan;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\File;

class PlanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = json_decode(File::get('/var/www/html/resources/seeds/plans.json'), true);
        array_map(function ($arr) {
            Plan::create($arr);
        }, $data);
    }
}
