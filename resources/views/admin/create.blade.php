<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Document</title>
    <link rel="stylesheet" href="{{ asset('css/admin-form-style.css') }}">

</head>
<body>


<div class="form-container">
    <h2>Добавление нового товара</h2>

    <form action="{{ route('admin.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        
        <div class="form-group">
            <label>Название товара:</label><br>
            <input type="text" name="name" required class="form-input">
        </div>

        <div class="form-group">
            <label>Категория:</label><br>

            {{-- Список уже существующих категорий --}}
            <select name="existing_category" class="form-input" id="categorySelect" style="margin-bottom: 10px;">
                <option value="">-- Выберите из имеющихся --</option>
                @foreach($categories as $cat)
                    <option value="{{ $cat }}">{{ $cat }}</option>
                @endforeach
            </select>

            {{-- Поле для новой категории --}}
            <input type="text" name="new_category" placeholder="Или введите новую" class="form-input">
            <small>Если выбрано из списка и введено новое поле — приоритет будет у нового.</small>
        </div>

        <div class="form-group">
            <label>Цена (руб):</label><br>
            <input type="number" name="price" required class="form-input">
        </div>

        <div class="form-group">
            <label>Изображение:</label><br>
            <input type="file" name="image" required>
        </div>

        <div class="form-group">
            <label>Описание (необязательно):</label><br>
            <textarea name="description" rows="4" class="form-input"></textarea>
        </div>

        <button type="submit" class="btn-submit">Сохранить товар</button>
        <a href="{{ route('admin.index') }}" class="link-back">Назад в список</a>
    </form>
</div>

</body>
</html>