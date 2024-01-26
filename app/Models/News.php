<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

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
 * @property Carbon $date
 * @property boolean $main
 * @property string $status
 * @property Carbon $created_at
 * @property Carbon $updated_at
 */
class News extends Model
{
    use HasFactory;

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
        'date',
        'created_at',
        'updated_at',
    ];

}
