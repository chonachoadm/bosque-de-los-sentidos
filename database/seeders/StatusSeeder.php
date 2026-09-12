<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Status;

class StatusSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $statuses = [
            ["status_name" => "success"],
            ["status_name" => "pending"],
            ["status_name" => "failure"],
        ];
        foreach ($statuses as $status) {
            Status::updateOrCreate(['status_name' => $status['status_name']], $status);
        }
    }
}
