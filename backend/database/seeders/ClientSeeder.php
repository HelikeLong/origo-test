<?php

namespace Database\Seeders;

use App\Models\Client;
use App\Models\Plan;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\File;

class ClientSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = json_decode(File::get('/var/www/html/resources/seeds/clients.json'), true);
        array_map(function ($arr) {
            $client = Client::create($arr);
            $client->plans()->attach(Plan::inRandomOrder()->first()->id);
        }, $data);
    }
}
