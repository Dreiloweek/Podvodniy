<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserRating extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'water_id',
        'price',
        'bitterness',
        'sweetness',
        'saltiness',
        'metallic',
    ];
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // Связь с маркой воды
    public function water()
    {
        return $this->belongsTo(WaterBrand::class, 'water_id');
    }
}
