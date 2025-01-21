@extends('layouts.app')

@section('content')

    <div class="container-1">
        <div class="grid">

            <!-- Левая часть -->
            <div class="content">
                <!-- Заголовок -->
                <h2 class="title">Нужно ли пить 2 литра воды в день?</h2>
                <!-- Кнопка -->
                <a href="#" class="button">Читать статью</a>
                <!-- Автор -->
                <div class="author">
                    <img src="https://placehold.co/40x40" alt="Аватар автора" class="avatar">
                    <div>
                        <p class="author-name">Владимир Бугаров</p>
                        <p class="author-info">База лютая</p>
                    </div>
                </div>
                <a href="#" class="comments-link">Показать ещё комментарии</a>
                <!-- Добавить комментарий -->
                <div class="comment-section">
                    <input type="text" class="comment-input" placeholder="Добавить комментарий">
                </div>
            </div>

            <!-- Правая часть -->
            <div class="image-container">
                <img src="https://placehold.co/600x400" alt="Water Drinking" class="image">
            </div>

        </div>
    </div>


@endsection
