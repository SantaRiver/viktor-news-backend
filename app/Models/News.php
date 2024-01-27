<?php

namespace App\Models;

use App\NewsStatus;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class News
 * @package App\Models
 * @property int $id
 * @property string $title
 * @property string $description
 * @property string $content
 * @property string $image
 * @property string $author
 * @property string $category
 * @property boolean $main
 * @property string $tags
 * @property int $views
 * @property int $likes
 * @property string $status
 * @property string $published_at
 * @property string $deleted_at
 * @property Carbon $created_at
 * @property Carbon $updated_at
 */
class News extends Model
{
    use HasFactory, SoftDeletes;

    const DEFAULT_SORT_FIELD = 'updated_at';
    const DEFAULT_SORT_DIRECTION = 'desc';

    protected $fillable = [
        'title',
        'description',
        'content',
        'image',
        'author',
        'category',
        'status',
        'main',
        'tags',
        'views',
        'likes',
        'published_at',
        'deleted_at',
        'created_at',
        'updated_at',
    ];
    protected $casts = [
        'status' => NewsStatus::class,
    ];
}
