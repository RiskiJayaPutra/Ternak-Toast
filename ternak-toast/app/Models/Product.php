<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Attributes\Fillable;

#[Fillable(['category_id', 'name', 'slug', 'description', 'price', 'stock', 'image'])]
class Product extends Model
{
    public function category()
    {
        return $this->belongsTo(Category::class);
    }
}
