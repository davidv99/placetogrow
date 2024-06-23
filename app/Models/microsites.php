<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class microsites extends Model
{
    use HasFactory;

    protected $fillable = [
        'slug',
        'name',
        'document_type',
        'document_number',
        'logo',
        'category_id',
        'currency',
        'site_type',
    ];

    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }
}
