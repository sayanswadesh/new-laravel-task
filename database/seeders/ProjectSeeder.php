<?php

namespace Database\Seeders;

use App\Models\Project;
use Illuminate\Database\Seeder;

class ProjectSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $Project = new Project();
        $Project->project_name = 'Payment APP';
        $Project->duration = '25';
        $Project->client_id = '1';
        $Project->developer_id = '2';
        $Project->save();

        $Project = new Project();
        $Project->project_name = 'Transport';
        $Project->duration = '20';
        $Project->client_id = '1';
        $Project->developer_id = '2';
        $Project->save();

        $Project = new Project();
        $Project->project_name = 'Web APP';
        $Project->duration = '24';
        $Project->client_id = '2';
        $Project->developer_id = '3';
        $Project->save();
    }
}
