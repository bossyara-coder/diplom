<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Админ-панель</title>
    <link rel="stylesheet" href="{{asset('css/admin-style.css')}}">


</head>
<body>


<div class="admin-container">
    <div class="admin-header">
        <h1>Управление товарами</h1>
        <div class="admin-nav-links">
            {{-- Новая кнопка возврата --}}
            <a href="{{ route('catalog') }}" class="btn-catalog">← В каталог</a>
        
            {{-- Твоя существующая кнопка добавления --}}
            <a href="{{ route('admin.create') }}" class="btn-add">+ Добавить товар</a>
        </div>
    </div>

    @if(session('success'))
        <div class="alert-success">{{ session('success') }}</div>
    @endif

    <table class="admin-table">
        <thead>
            <tr>
                <th>Фото</th>
                <th>Название</th>
                <th>Категория</th>
                <th>Цена</th>
                <th>Действия</th>
            </tr>
        </thead>
        <tbody>
            @foreach($products as $product)
            <tr>
                <td>
                    <img src="{{ asset('image/products/' . basename($product->image)) }}" alt="" style="width: 50px;">
                </td>
                <td>{{ $product->name }}</td>
                <td>{{ $product->category }}</td>
                <td>{{ number_format($product->price, 0, '', ' ') }} руб.</td>
                <td>
                    <div class="actions-cell">
                        {{-- Кнопка редактирования --}}
                        <a href="{{ route('admin.edit', $product->id) }}" class="btn-edit">Редактировать</a>

                        {{-- Форма удаления --}}
                        <form action="{{ route('admin.destroy', $product->id) }}" method="POST" class="form-inline" onsubmit="return confirm('Точно удалить?')">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn-delete">Удалить</button>
                        </form>
                    </div>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>

</body>
</html>