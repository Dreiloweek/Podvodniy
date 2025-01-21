
    <div class="mini-card">
        <div class="card-image">
            <img src="{{ $water->src }}" alt="{{ $water->water_name }}">
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

