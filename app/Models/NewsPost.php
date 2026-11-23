<?php

namespace App\Models;

use Database\Factories\NewsPostFactory;
use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

#[Fillable([
    'slug',
    'title',
    'published_at',
    'image',
    'excerpt',
    'body_html',
    'link',
    'link_label',
    'sort_order',
])]
class NewsPost extends Model
{
    /** @use HasFactory<NewsPostFactory> */
    use HasFactory;

    protected function casts(): array
    {
        return [
            'published_at' => 'date',
            'sort_order' => 'integer',
        ];
    }
}
