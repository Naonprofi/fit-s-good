<?php

namespace App\Models;

use App\Policies\FoodPolicy;
use Illuminate\Database\Eloquent\Attributes\UsePolicy;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Food extends Model
{
    /** @use HasFactory<\Database\Factories\FoodFactory> */
    use HasFactory;
    use SoftDeletes;
    #[UsePolicy(FoodPolicy::class)]

    protected $fillable = [
        'category_id',
        'name',
        'calories',
        'protein',
        'carbs',
        'fat',
    ];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }
}
