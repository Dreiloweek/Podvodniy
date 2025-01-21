@extends('layouts.app')

@section('content')
<div class="card" id="card">
    <div class="left-column">
        <div class="recommendation">
            <h1><span class="highlight">Ваш</span> <br>выбор </h1>
        </div>
        <div class="details">
            <a class="water-name">{{ $water->water_name }}</a><br>
            @if(auth()->user())
                <button class="btn-rate" id="btn-rate">Оценить</button><br>
            @endif
        </div>
    </div>

    <div class="center-column">
        <img src="{{ $water->src }}" alt="{{ $water->water_name }}" class="bottle-image">
    </div>

    <div class="right-column">
        <ul class="info-list">
            <li>Кальций <span class="num">{{ $water->calcium }}</span></li>
            <li>Магний <span class="num">{{ $water->magnesium }}</span></li>
            <li>Натрий и Калий <span class="num">{{ $water->sodium_potassium }}</span></li>
            <li>Сульфаты <span class="num">{{ $water->sulfates }}</span></li>
            <li>Хлориды <span class="num">{{ $water->chlorides }}</span></li>
            <li>Гидрокарбонаты <span class="num">{{ $water->bicarbonates }}</span></li>
            <li>Нитраты <span class="num">{{ $water->nitrates }}</span></li>
            <li>Фториды <span class="num">{{ $water->fluorides }}</span></li>
            <li>Диоксид кремния <span class="num">{{ $water->silicon_dioxide }}</span></li>
            <li>Кислотность <span class="num">{{ $water->ph }}</span></li>
        </ul>
    </div>
</div>
<div id="rate-form" class="rate-form">
    <div class="slider-form" id="sliderForm">
        <div class="slider-item">
            <label>Цена</label>
            <input type="range" min="1" max="5" step="1" value="0">
        </div>
        <div class="slider-item">
            <label>Горечь</label>
            <input type="range" min="1" max="5" step="1" value="0">
        </div>
        <div class="slider-item">
            <label>Сладость</label>
            <input type="range" min="1" max="5" step="1" value="0">
        </div>
        <div class="slider-item">
            <label>Соленость</label>
            <input type="range" min="1" max="5" step="1" value="0">
        </div>
        <div class="slider-item">
            <label>Железный привкус</label>
            <input type="range" min="1" max="5" step="1" value="0">
        </div>
        <div style="align-self: flex-start; margin-left: 35%">
            <button class="btn-rate2" id="btn-rate2">Оценить</button>
        </div>
    </div>
</div>
<div class="card-container">
    @foreach($waters as $water)
        <x-water-card :water="$water" />
    @endforeach
</div>

    <script>
        document.addEventListener('DOMContentLoaded', () => {
            const rateBtn = document.getElementById('btn-rate'); // Кнопка для показа формы
            const rateForm = document.getElementById('rate-form'); // Форма для оценки
            const rateBtn2 = document.getElementById('btn-rate2'); // Кнопка для закрытия формы

            // Обработчик нажатия на btn-rate
            rateBtn.addEventListener('click', (e) => {
                e.preventDefault();
                rateForm.classList.add('active'); // Показываем форму
                rateBtn.style.display = 'none'; // Скрываем кнопку
            });

            // Обработчик нажатия на btn-rate2
            rateBtn2.addEventListener('click', (e) => {
                e.preventDefault();
                rateForm.classList.remove('active'); // Скрываем форму
                rateBtn.style.display = 'block'; // Показываем кнопку
            });

            // Обработчик клика вне формы для закрытия
            document.addEventListener('click', (e) => {
                const isClickInsideForm = rateForm.contains(e.target) || rateBtn.contains(e.target);
                if (!isClickInsideForm) {
                    rateForm.classList.remove('active'); // Скрыть форму
                    rateBtn.style.display = 'block'; // Показать кнопку
                }
            });
        });
    </script>
@endsection
