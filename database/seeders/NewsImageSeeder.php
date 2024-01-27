<?php

namespace Database\Seeders;

use App\Models\News;
use App\Models\NewsImage;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class NewsImageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        NewsImage::factory()->count(150)->create();
    }
}
