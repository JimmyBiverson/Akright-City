<?php

namespace App\Models;

use Database\Factories\PageContentFactory;
use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

#[Fillable(['key', 'title', 'subtitle', 'hero_image', 'body_html', 'data', 'meta_description'])]
class PageContent extends Model
{
    /** @use HasFactory<PageContentFactory> */
    use HasFactory;

    protected function casts(): array
    {
        return [
            'data' => 'array',
        ];
    }
}
