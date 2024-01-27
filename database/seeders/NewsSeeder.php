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
        News::factory()->count(30)->create();
        News::query()->where('status', '=', NewsStatus::Published)
            ->inRandomOrder()
            ->limit(4)
            ->update(['main' => true]);
    }
}
