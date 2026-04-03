<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class item extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'category_id',
        'stock'
    ];

    public function category()
{
    return $this->belongsTo(Category::class);
}

public function movements()
{
    return $this->hasMany(StockMovement::class);
}
}
