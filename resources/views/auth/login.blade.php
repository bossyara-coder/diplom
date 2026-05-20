<!DOCTYPE html>
<html>
<head>
    <title>Register & Login</title>
    <link rel="stylesheet" href="{{ asset('css/style-register.css') }}">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100..900;1,100..900&display=swap" rel="stylesheet">
</head>
<body>
    <div class="container">
        <div class="form-container sign-up-container">
            <h2>Регистрация</h2>
            <form method="POST" action="{{ route('register') }}" class="registr">
                @csrf
                <label for="name">Name</label>
                <input type="text" name="name" id="name" required>

                <label for="email">Email</label>
                <input type="email" name="email" id="email" required>

                <label for="password">Password</label>
                <input type="password" name="password" id="password" required>

                <label for="password_confirmation">Confirm Password</label>
                <input type="password" name="password_confirmation" id="password_confirmation" required>

                <button type="submit">Зарегистрироваться</button>
            </form>
        </div>

        <div class="form-container sign-in-container">
            <h2>Вход</h2>
            <form method="POST" action="{{ route('login') }}" class="registr">
                @csrf
                <label for="email">Email</label>
                <input type="email" name="email" id="email" required>

                <label for="password">Password</label>
                <input type="password" name="password" id="password" required>

                <button type="submit">Войти</button>
            </form>
        </div>

        <div class="overlay-container">
            <div class="overlay">
                <div class="overlay-panel overlay-left">
                    <h2>С возвращением!</h2>
                    <p>Чтобы приобрести товары, войдите в систему. Ещё нет аккаунта — зарегистрируйтесь прямо сейчас!</p>
                    <button class="ghost" id="signIn">Регистрация</button>
                </div>
                <div class="overlay-panel overlay-right">
                    <h2>Добро пожаловать!</h2>
                    <p>Создайте аккаунт чтобы начать покупки. Уже зарегистрированы? Войдите в систему!</p>
                    <button class="ghost" id="signUp">Войти</button>
                </div>
            </div>
        </div>
    </div>

    <script src="{{ asset('js/register.js') }}"></script>
</body>
</html>