@extends('layouts.app')

@section('content')
    <div class="admin-create">
        <form method="POST" action="{{ isset($water) ? route('waters.update', $water->id) : url('storage/php/water.php') }}">
            @csrf
            @if(isset($water))
                @method('PUT')
            @endif

            <div class="form-group">
                <label for="water_name">Название воды</label>
                <input type="text" name="water_name" id="water_name" class="form-control"
                       value="{{ old('water_name', $water->water_name ?? 'Название по умолчанию') }}" required>
                @error('water_name')
                <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-group">
                <label for="src">Ссылка на картинку</label>
                <input type="text" name="src" id="src" class="form-control"
                       value="{{ old('src', $water->src ?? 'https://a.d-cd.net/YCPxEZKp855iRIraVE3u9D7e6vE-960.jpg') }}" required>
                @error('src')
                <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-group">
                <label for="price">Цена</label>
                <input type="text" name="price" id="price" class="form-control"
                       value="{{ old('price', $water->price ?? '1') }}" required>
                @error('price')
                <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-group">
                <label for="calcium">Кальций</label>
                <input type="text" name="calcium" id="calcium" class="form-control"
                       value="{{ old('calcium', $water->calcium ?? '1') }}">
                @error('calcium')
                <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-group">
                <label for="magnesium">Магний</label>
                <input type="text" name="magnesium" id="magnesium" class="form-control"
                       value="{{ old('magnesium', $water->magnesium ?? '1') }}">
                @error('magnesium')
                <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-group">
                <label for="sodium_potassium">Натрий и Калий</label>
                <input type="text" name="sodium_potassium" id="sodium_potassium" class="form-control"
                       value="{{ old('sodium_potassium', $water->sodium_potassium ?? '1') }}">
                @error('sodium_potassium')
                <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-group">
                <label for="sulfates">Сульфаты</label>
                <input type="text" name="sulfates" id="sulfates" class="form-control"
                       value="{{ old('sulfates', $water->sulfates ?? '1') }}">
                @error('sulfates')
                <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-group">
                <label for="chlorides">Хлориды</label>
                <input type="text" name="chlorides" id="chlorides" class="form-control"
                       value="{{ old('chlorides', $water->chlorides ?? '1') }}">
                @error('chlorides')
                <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-group">
                <label for="bicarbonates">Гидрокарбонаты</label>
                <input type="text" name="bicarbonates" id="bicarbonates" class="form-control"
                       value="{{ old('bicarbonates', $water->bicarbonates ?? '1') }}">
                @error('bicarbonates')
                <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-group">
                <label for="nitrates">Нитраты</label>
                <input type="text" name="nitrates" id="nitrates" class="form-control"
                       value="{{ old('nitrates', $water->nitrates ?? '1') }}">
                @error('nitrates')
                <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-group">
                <label for="fluorides">Фториды</label>
                <input type="text"  name="fluorides" id="fluorides" class="form-control"
                       value="{{ old('fluorides', $water->fluorides ?? '1') }}">
                @error('fluorides')
                <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-group">
                <label for="silicon_dioxide">Диоксид кремния</label>
                <input type="text" name="silicon_dioxide" id="silicon_dioxide" class="form-control"
                       value="{{ old('silicon_dioxide', $water->silicon_dioxide ?? '1') }}">
                @error('silicon_dioxide')
                <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-group">
                <label for="ph">Кислотность</label>
                <input type="text" name="ph" id="ph" class="form-control"
                       value="{{ old('ph', $water->ph ?? '1') }}">
                @error('ph')
                <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>

            <button type="submit" class="btn btn-primary">
                {{ isset($water) ? 'Обновить' : 'Добавить' }} карточку воды
            </button>
        </form>
    </div>
@endsection
