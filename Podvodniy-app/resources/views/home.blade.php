@extends('layouts.app')

@section('content')

    @if ($randomWater)
        <form action="{{ route('card.show', $randomWater->id) }}" method="POST">
            @csrf
            <div class="card" id="card">
                <div class="left-column">
                    <div class="recommendation">
                        <h1><span class="highlight">Подводный</span> <br>рекомендует <br>вам</h1>
                    </div>
                    <div class="details">
                        <a class="water-name">{{ $randomWater->water_name }}</a><br>
                        @if(auth()->user())
                            <button class="btn-rate" id="btn-rate" type="button">Оценить</button><br>
                        @endif
                    </div>
                </div>

                <div class="center-column">
                    <img src="{{ $randomWater->src }}" alt="{{ $randomWater->water_name }}" class="bottle-image">
                </div>

                <div class="right-column">
                    <ul class="info-list">
                        <li>Кальций <span class="num">{{ $randomWater->calcium }}</span></li>
                        <li>Магний <span class="num">{{ $randomWater->magnesium }}</span></li>
                        <li>Натрий и Калий <span class="num">{{ $randomWater->sodium_potassium }}</span></li>
                        <li>Сульфаты <span class="num">{{ $randomWater->sulfates }}</span></li>
                        <li>Хлориды <span class="num">{{ $randomWater->chlorides }}</span></li>
                        <li>Гидрокарбонаты <span class="num">{{ $randomWater->bicarbonates }}</span></li>
                        <li>Нитраты <span class="num">{{ $randomWater->nitrates }}</span></li>
                        <li>Фториды <span class="num">{{ $randomWater->fluorides }}</span></li>
                        <li>Диоксид кремния <span class="num">{{ $randomWater->silicon_dioxide }}</span></li>
                        <li>Кислотность <span class="num">{{ $randomWater->ph }}</span></li>
                    </ul>
                </div>
            </div>

    @else
        <p>Нет доступных данных о воде.</p>
    @endif

            <form id="rate-form-php" action="storage/php/submit_rating.php" method="POST">
                <div id="rate-form" class="rate-form">
                    <div class="slider-form" id="sliderForm">
                        <input type="hidden" name="water_id" value="{{ $randomWater->id }}"> <!-- Передаем water_id -->

                        <div class="slider-item">
                            <label>Цена</label>
                            <input type="range" name="price" min="1" max="5" step="1" value="1">
                        </div>
                        <div class="slider-item">
                            <label>Горечь</label>
                            <input type="range" name="bitterness" min="1" max="5" step="1" value="1">
                        </div>
                        <div class="slider-item">
                            <label>Сладость</label>
                            <input type="range" name="sweetness" min="1" max="5" step="1" value="1">
                        </div>
                        <div class="slider-item">
                            <label>Соленость</label>
                            <input type="range" name="saltiness" min="1" max="5" step="1" value="1">
                        </div>
                        <div class="slider-item">
                            <label>Железный привкус</label>
                            <input type="range" name="metallic" min="1" max="5" step="1" value="1">
                        </div>

                        <div style="align-self: flex-start; margin-left: 35%">
                            <button class="btn-rate2" id="btn-rate2" type="submit">Оценить</button>
                        </div>
                    </div>
                </div>
            </form>


        </form>

    <div class="card-container">
        @foreach($waters as $water)
        <div class="mini-card">
            <div class="card-image">
                <img src={{$water->src}} alt="{{ $water->water_name }}">
            </div>

            <div class="card-content">
                @if(auth()->user() && auth()->user()->role === 'admin')
                    <a href="{{ route('waters.edit', $water->id) }}" class="btn btn-secondary">Редактировать</a>
                    <form action="{{ route('waters.destroy', $water->id) }}" method="POST" style="display:inline-block;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger">Удалить</button>
                    </form>
                @endif
                <h3>{{ $water->water_name }}</h3>
                    <form action="{{ route('card.show', $water->id) }}" method="post">
                        @csrf
                        <input type="hidden" name="water_id" value="{{ $water->id }}">
                        <button class="mini-rate" type="submit">Оценить</button>
                    </form>
            </div>
        </div>
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
            document.getElementById("rate-form-php").addEventListener("submit", async function (event) {
            event.preventDefault(); // Останавливаем стандартное поведение формы

            // Получаем значения полей формы
            const formData = new FormData(this);
            const waterId = document.querySelector('input[name="water_id"]').value;
            const price = document.querySelector('input[name="price"]').value;
            const bitterness = document.querySelector('input[name="bitterness"]').value;
            const sweetness = document.querySelector('input[name="sweetness"]').value;
            const saltiness = document.querySelector('input[name="saltiness"]').value;
            const metallic = document.querySelector('input[name="metallic"]').value;

            // Дополнительная проверка данных
            if (
            price < 1 || price > 5 ||
            bitterness < 1 || bitterness > 5 ||
            sweetness < 1 || sweetness > 5 ||
            saltiness < 1 || saltiness > 5 ||
            metallic < 1 || metallic > 5
            ) {
            alert("Пожалуйста, убедитесь, что все значения находятся в пределах от 1 до 5.");
            return;
        }

            // Отправка данных на сервер
            try {
            const response = await fetch("storage/php/submit_rating.php", {
            method: "POST",
            body: formData,
        });

            if (response.ok) {
            const result = await response.text();
            alert(result); // Выводим сообщение от сервера
        } else {
            alert("Ошибка отправки данных на сервер: " + response.statusText);
        }
        } catch (error) {
            console.error("Ошибка при отправке данных:", error);
            alert("Произошла ошибка. Попробуйте еще раз.");
        }
        });



        </script>
@endsection
