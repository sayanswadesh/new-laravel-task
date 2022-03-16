<?php

namespace Database\Seeders;

use App\Models\Client;
use Illuminate\Database\Seeder;

class ClientSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $Client = new Client();
        $Client->client_name = 'Airtel';
        $Client->mobile = '1234567890';
        $Client->email = 'airtel@gmail.com';
        $Client->save();

        $Client = new Client();
        $Client->client_name = 'BSNL';
        $Client->mobile = '1234567654';
        $Client->email = 'bsnl@gmail.com';
        $Client->save();
    }
}
