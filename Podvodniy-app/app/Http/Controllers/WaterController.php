<?php

namespace App\Http\Controllers;

use App\Models\Water;
use Illuminate\Http\Request;

class WaterController extends Controller
{
    public function index()
    {
        // Получаем случайную воду (или все доступные воды для главной страницы)
        $randomWater = Water::inRandomOrder()->first();  // Это пример, вы можете адаптировать под ваши нужды
        $waters = Water::all();  // Все доступные воды

        return view('home', compact('randomWater', 'waters'));
    }

    // Метод для отображения карточки воды
    public function showCard($id)
    {
        // Получаем воду по ID
        $water = Water::find($id);

        if (!$water) {
            return redirect()->route('home')->with('error', 'Вода не найдена!');
        }

        $waters = Water::all();
        return view('card', compact('water', 'waters'));
    }
    public function create()
    {
        return view('waters.create');
    }
    public function edit($id)
    {
        $water = Water::findOrFail($id);
        return view('waters.create', compact('water')); // Используется та же форма create.blade.php
    }
    public function update(Request $request, $id)
    {
        $validatedData = $request->validate([
            'water_name' => 'nullable|string|max:255',
            'src' => 'nullable|string|max:255',
            'price' => 'nullable|string',
            'calcium' => 'nullable|string',
            'magnesium' => 'nullable|string',
            'sodium_potassium' => 'nullable|string',
            'sulfates' => 'nullable|string',
            'chlorides' => 'nullable|string',
            'bicarbonates' => 'nullable|string',
            'nitrates' => 'nullable|string',
            'fluorides' => 'nullable|string',
            'silicon_dioxide' => 'nullable|string',
            'ph' => 'nullable|string',
        ]);

        $water = Water::findOrFail($id);
        $water->update($validatedData);

        return redirect()->route('home')->with('success', 'Карточка успешно обновлена!');
    }
    public function destroy($id)
    {
        $water = Water::findOrFail($id);
        $water->delete();

        return redirect()->route('home')->with('success', 'Карточка успешно удалена!');
    }


    public function store(Request $request)
    {
        $request->validate([
            'water_name' => 'string',
            'price' => 'string'|'nullable',
            'calcium' => 'string'|'nullable',
            'magnesium' => 'string'|'nullable',
            'sodium_potassium' => 'string'|'nullable',
            'sulfates' => 'string'|'nullable',
            'chlorides' => 'string'|'nullable',
            'bicarbonates' => 'string'|'nullable',
            'nitrates' => 'string'|'nullable',
            'fluorides' => 'string'|'nullable',
            'silicon_dioxide' => 'string'|'nullable',
            'ph' => 'string'|'nullable'
        ]);

        Water::create($request->all());

        return redirect()->route('home')->with('success', 'Новая карточка воды добавлена!');
    }
}
