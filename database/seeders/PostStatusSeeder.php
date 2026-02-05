<?php

namespace Database\Seeders;

use App\Models\PostStatus;
use Illuminate\Database\Seeder;

class PostStatusSeeder extends Seeder
{
    public function run(): void
    {
        $statuses = ['Draft', 'Published', 'Archived'];

        foreach ($statuses as $status) {
            PostStatus::create(['status' => $status]);
        }
    }
}
