<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Water extends Model
{
    use HasFactory;
    public static function withDefault($id)
    {
        $water = self::find($id);

        if (!$water) {
            return new self([
                'id' => 0,
                'water_name' => 'Без названия',
                'src' => 'https://example.com/default.jpg',
                'price' => 0,
                'calcium' => 0,
                'magnesium' => 0,
                'sodium_potassium' => 0,
                'sulfates' => 0,
                'chlorides' => 0,
                'bicarbonates' => 0,
                'nitrates' => 0,
                'fluorides' => 0,
                'silicon_dioxide' => 0,
                'ph' => 7,
            ]);
        }

        return $water;
    }

    protected $table = 'water_brands';


    protected $fillable = [
        'water_name', 'price', 'calcium', 'magnesium', 'sodium_potassium', 'sulfates',
        'chlorides', 'bicarbonates', 'nitrates', 'fluorides', 'silicon_dioxide', 'ph'
    ];
}
