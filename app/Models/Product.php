<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

#[Fillable(['category_id', 'name', 'description', 'stock', 'price'])]
class Product extends Model
{
    use HasFactory;

    // Stok sebanyak ini atau kurang dianggap rendah
    public const LOW_STOCK_LIMIT = 5;

    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }

    public function isLowStock(): bool
    {
        return $this->stock <= self::LOW_STOCK_LIMIT;
    }
}