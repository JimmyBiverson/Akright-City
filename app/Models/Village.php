<?php

namespace App\Models;

use Database\Factories\VillageFactory;
use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

#[Fillable([
    'slug',
    'name',
    'tagline',
    'chairperson',
    'chairperson_message',
    'body_html',
    'map_image',
    'gallery_images',
    'card_image',
    'sort_order',
])]
class Village extends Model
{
    /** @use HasFactory<VillageFactory> */
    use HasFactory;

    protected function casts(): array
    {
        return [
            'gallery_images' => 'array',
            'sort_order' => 'integer',
        ];
    }
}
