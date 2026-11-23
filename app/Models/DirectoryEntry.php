<?php

namespace App\Models;

use Database\Factories\DirectoryEntryFactory;
use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

#[Fillable([
    'category',
    'name',
    'address',
    'phone',
    'email',
    'website',
    'details',
    'sort_order',
])]
class DirectoryEntry extends Model
{
    /** @use HasFactory<DirectoryEntryFactory> */
    use HasFactory;

    protected function casts(): array
    {
        return [
            'sort_order' => 'integer',
        ];
    }
}
