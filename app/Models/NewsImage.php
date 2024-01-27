<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * Class NewsImage
 * @package App\Models
 *
 * @property int $id
 * @property int $news_id
 * @property string $path
 *
 * @property-read News $news
 */
class NewsImage extends Model
{
    use HasFactory;

    public $timestamps = false;

    protected $fillable = [
        'news_id',
        'path',
    ];

    public function news(): BelongsTo
    {
        return $this->belongsTo(News::class);
    }

}
