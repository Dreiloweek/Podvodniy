@extends('layouts.app')

@section('content')
    <h1 class="user-list-title">Список пользователей</h1>

    @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <table class="user-table">
        <thead>
        <tr class="table-header">
            <th>ID</th>
            <th>Имя пользователя</th>
            <th>Роль</th>
            <th>Действия</th>
        </tr>
        </thead>
        <tbody>
        @forelse ($users as $user)
            <tr class="table-row">
                <form method="POST" action="{{ route('admin.update') }}">
                    @csrf
                    <td>{{ $user->id }}</td>
                    <td>
                        <input type="hidden" name="id" value="{{ $user->id }}">
                        <input type="text" name="username" class="username-input" value="{{ $user->username }}">
                    </td>
                    <td>
                        <select name="role" class="role-select">
                            <option value="user" {{ $user->role == 'user' ? 'selected' : '' }}>user</option>
                            <option value="admin" {{ $user->role == 'admin' ? 'selected' : '' }}>admin</option>
                        </select>
                    </td>
                    <td>
                        <button type="submit" class="btn-save">Сохранить</button>
                </form>
                <form method="POST" action="{{ route('admin.delete') }}" style="display:inline;">
                    @csrf
                    <input type="hidden" name="id" value="{{ $user->id }}">
                    <button type="submit" class="btn-delete" onclick="return confirm('Удалить пользователя?')">Удалить</button>
                </form>
            </tr>
        @empty
            <tr class="no-users">
                <td colspan="4">Нет пользователей для отображения.</td>
            </tr>
        @endforelse
        </tbody>
    </table>
@endsection
