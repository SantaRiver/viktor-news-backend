<?php

namespace Database\Seeders;

use App\Enums\NewsStatus;
use App\Models\News;
use Illuminate\Database\Seeder;

class NewsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        News::factory()->count(100)->create();
        News::query()->where('status', '=', NewsStatus::Published->name)
            ->inRandomOrder()
            ->limit(4)
            ->update(['main' => true]);
    }
}
