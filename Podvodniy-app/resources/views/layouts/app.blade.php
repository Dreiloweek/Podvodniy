
<!doctype html>

<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <linl rel="jscheet" href="{{asset('js/app.js')}}">
    <title>@yield('title')</title>
</head>
<body>
<header class="header" id="header">
    <div class="logo-container">
        <a href="/" class="logo-link" id="logo-link">
            <img src="{{ asset('storage/images/logo.png') }}" alt="Подводный" class="logo-image">
        </a>
    </div>
    <nav class="nav-bar">
        <ul class="nav-menu">
            <li class="nav-item"><a href="/" class="nav-link">Главная</a></li>
            <li class="nav-item"><a href="/about" class="nav-link">О нас</a></li>
            <li class="nav-item user-icon" id="profile-icon">
                <a href="#" class="user-link">
                    <img src="{{ asset('storage/images/profile.png') }}" class="user-placeholder" alt="profilepic">
                </a>
            </li>
            @if(auth()->user() && auth()->user()->role === 'admin')
                <li class="nav-item"><a href="/admin" class="nav-link">Админ-панель</a></li>
                <li class="nav-item"><a href={{route('waters.create')}} class="nav-link">Создать карточку</a></li>
            @endif
        </ul>
    </nav>

    <div class="logreg-form" id="registration-form">
        @if(Auth::check())
        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
            @csrf
        </form>
        <a href="javascript:void(0);" class="btn-reg" id="btn-logout" onclick="document.getElementById('logout-form').submit();">Выход из аккаунта</a>
            @else
        <form class="login-form" id="login-form" >
            @csrf
            <div >
                <div class="input-container">
                    <input class="effect" type="text" name="username" required placeholder="Логин" id="log-login-field">
                    <span class="focus-border"></span>
                </div>
                <div class="input-container">
                    <input class="effect" type="password" name="password" required placeholder="Пароль" id="log-password-field">
                    <span class="focus-border"></span>
                </div>
            </div>
            <button type="submit" class="btn-in" id="btn-in" >Войти</button>
        </form>
        <form class="register-form" style="display: none;" method="POST" action="storage/php/reg.php">
        @csrf
            <div >
                <div class="input-container">
                    <input class="effect" type="text" name="register" required placeholder="Логин" id="reg-login-field">
                    <span class="focus-border"></span>
                </div>
                <div class="input-container">
                    <input type="password" placeholder="Пароль" name="password" required class="effect" id="reg-password-field">
                    <span class="focus-border"></span>
                </div>
        </div>
            <button type="submit" class="btn-in" id="btn-reg">Зарегистрироваться</button>
        </form>
        <a class="btn-reg" id="btn-swich" href="javascript:void(0);">регистрация</a><br>
        @endif
    </div>


</header>

<script>
    const profileIcon = document.getElementById('profile-icon');
    const header = document.getElementById('header');
    let isFormVisible = false;

    profileIcon.addEventListener('click', (e) => {
        e.preventDefault();

        isFormVisible = !isFormVisible;
        header.classList.toggle('active', isFormVisible);
    });
    document.addEventListener('click', (e) => {
        if (isFormVisible && !header.contains(e.target) && !profileIcon.contains(e.target)) {
            isFormVisible = false;
            header.classList.remove('active');
        }
    });

    const loginForm = document.querySelector('.login-form');
    const registerForm = document.querySelector('.register-form');
    const actionButton = document.getElementById('btn-in');
    const toggleButton = document.getElementById('btn-swich');
    const loginField = document.getElementById('log-login-field');
    const passwordField = document.getElementById('log-password-field');
    const regLoginField = document.getElementById('reg-login-field');
    const regPasswordField = document.getElementById('reg-password-field');
    toggleButton.addEventListener('click', () => {
        if (registerForm.style.display === 'none') {
            // Переход к форме регистрации
            loginField.value = '';
            passwordField.value = '';
            loginForm.style.display = 'none';
            registerForm.style.display = 'block';
            actionButton.textContent = 'Зарегистрироваться';
            toggleButton.textContent = 'у меня уже есть аккаунт';
        } else {
            regLoginField.value = '';
            regPasswordField.value = '';
            registerForm.style.display = 'none';
            loginForm.style.display = 'block';
            actionButton.textContent = 'Войти';
            toggleButton.textContent = 'Регистрация';
        }
    });
    document.getElementById('login-form').addEventListener('submit', function(e) {
        e.preventDefault();


        let formData = new FormData(this);


        fetch("{{ route('login') }}", {
            method: 'POST',
            body: formData,
            headers: {
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
            }
        })
            .then(response => window.location.reload())
    });

</script>
@yield('content')
<footer class="footer">
    <div class="footer-container">
        <div class="footer-column">
            <h4>О компании</h4>
            <ul>
                <li><a href="/about">О нас</a></li>
                <li><a href="#team">Команда</a></li>
                <li><a href="#careers">Карьера</a></li>
                <li><a href="#contact">Контакты</a></li>
            </ul>
        </div>
        <div class="footer-column">
            <h4>Полезные ссылки</h4>
            <ul>
                <li><a href="#faq">FAQ</a></li>
                <li><a href="#blog">Блог</a></li>
                <li><a href="#terms">Условия использования</a></li>
                <li><a href="#privacy">Политика конфиденциальности</a></li>
            </ul>
        </div>
        <div class="footer-column">
            <h4>Свяжитесь с нами</h4>
            <ul>
                <li>Email: <a href="mailto:info@example.com">info@example.com</a></li>
                <li>Телефон: <a href="tel:+1234567890">+1 234 567 890</a></li>
                <li>
                    <div class="social-links">
                        <a href="https://vk.com/mirea_official" aria-label="Facebook"><img src="https://cdn-icons-png.flaticon.com/128/25/25684.png" alt="VK"></a>
                        <a href="https://www.mirea.ru/" aria-label="Twitter"><img src="https://troparevo-gazeta.ru/files/data/user/AiF/elizaveta.m/files/sample/2020.07.23-1595511267.8624_rtu.png" alt="mirea"></a>
                        <a href="https://telegram.me/rtumirea_official" aria-label="Instagram"><img src="https://cdn-icons-png.flaticon.com/128/2111/2111710.png" alt="Telegram"></a>
                    </div>
                </li>
            </ul>
        </div>
    </div>
    <div class="footer-bottom">
        <p>© 2024 Подводный. Все права защищены.</p>
    </div>
</footer>
</body>
</html>
