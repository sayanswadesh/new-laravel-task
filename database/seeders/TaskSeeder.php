<?php

namespace Database\Seeders;

use App\Models\Task;
use Illuminate\Database\Seeder;

class TaskSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $Task = new Task();
        $Task->project_id = '1';
        $Task->task_name = 'Project Setup';
        $Task->save();

        $Task = new Task();
        $Task->project_id = '1';
        $Task->task_name = 'Make Payment';
        $Task->save();

        $Task = new Task();
        $Task->project_id = '2';
        $Task->task_name = 'Go Live';
        $Task->save();

        $Task = new Task();
        $Task->project_id = '3';
        $Task->task_name = 'Booking';
        $Task->save();
    }
}
