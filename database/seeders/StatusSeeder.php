<?php

namespace Database\Seeders;

use App\Models\Status;
use Illuminate\Database\Seeder;

class StatusSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        foreach (Status::$availableStatuses as $status) {
            Status::create([
                'status' => $status
            ]);
        }
    }
} 