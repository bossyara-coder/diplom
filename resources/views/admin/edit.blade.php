<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <title>Редактирование товара</title>
    <link rel="stylesheet" href="{{ asset('css/admin-form-style.css') }}">
</head>
<body>

<div class="form-container">
    <h2>Редактирование товара: {{ $product->name }}</h2>

    {{-- Важно: используем метод POST, но внутри добавляем @method('PUT') --}}
    <form action="{{ route('admin.update', $product->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        
        <div class="form-group">
            <label>Название товара:</label><br>
            <input type="text" name="name" value="{{ $product->name }}" required class="form-input">
        </div>

        <div class="form-group">
            <label>Категория:</label><br>
            {{-- Список существующих категорий --}}
            <select name="existing_category" class="form-input" style="margin-bottom: 10px;">
                @foreach($categories as $cat)
                    <option value="{{ $cat }}" {{ $product->category == $cat ? 'selected' : '' }}>
                        {{ $cat }}
                    </option>
                @endforeach
            </select>
            {{-- Поле для новой категории --}}
            <input type="text" name="new_category" placeholder="Или введите новую" class="form-input">
            <small>Если введете новую, она будет в приоритете.</small>
        </div>

        <div class="form-group">
            <label>Цена (руб):</label><br>
            <input type="number" name="price" value="{{ intval($product->price) }}" required class="form-input">
        </div>

        <div class="form-group">
            <label>Текущее изображение:</label><br>
            {{-- Используем basename, чтобы путь не ломался --}}
            <img src="{{ asset('image/products/' . basename($product->image)) }}" alt="Текущее фото" style="width: 100px; margin: 10px 0; display: block; border: 1px solid #ddd;">
            
            <label>Заменить изображение (необязательно):</label><br>
            <input type="file" name="image">
        </div>

        <div class="form-group">
            <label>Описание:</label><br>
            <textarea name="description" rows="5" class="form-input">{{ $product->description }}</textarea>
        </div>

        <button type="submit" class="btn-submit" style="background: #ffc107; color: #000; font-weight: bold;">
            Сохранить изменения
        </button>
        
        <a href="{{ route('admin.index') }}" class="link-back">Отмена и назад</a>
    </form>
</div>

</body>
</html>