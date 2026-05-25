<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Category;
use Illuminate\Support\Str;

class AdminController extends Controller
{
    // Показать список всех товаров в админке
    public function index()
    {
        $products = Product::all();
        return view('admin.index', compact('products'));
    }

    // Показать форму создания товара
    public function create()
    {
        $categories = Product::distinct()->pluck('category'); 
        return view('admin.create', compact('categories'));
    }

    // Сохранить новый товар в базу
    public function store(Request $request)
    {
        $category = $request->new_category ?: $request->existing_category;

        if (!$category) {
            return back()->withErrors(['category' => 'Нужно выбрать или создать категорию']);
        }

       $validated = $request->validate([
            'name' => 'required|max:255',
            'price' => 'required|numeric',
            'image' => 'required|image|max:2048',
            'description' => 'nullable',
            'article' => 'required|digits:6|unique:products,article',
        ], [
            // Кастомные сообщения об ошибках
            'article.unique' => 'Товар с таким артикулом уже существует!',
            'article.digits' => 'Артикул должен состоять ровно из 6 цифр!',
            'article.required' => 'Введите артикул!'
        ]
        );

        $validated['category'] = $category;

        // Обработка загрузки картинки
        if ($request->hasFile('image')) {
            $imageName = time().'.'.$request->image->extension();
            $request->image->move(public_path('image/products'), $imageName);
            $validated['image'] = $imageName;
        }


        Product::create($validated);

        return redirect()->route('admin.index')->with('success', 'Товар успешно добавлен!');
    }

    // Удалить товар
    public function destroy($id)
    {
        $product = Product::findOrFail($id);
        $product->delete();
        return redirect()->route('admin.index')->with('success', 'Товар удален');
    }




    // Метод для показа формы
public function edit($id)
{
    $product = Product::findOrFail($id);
    // Берем список категорий для выпадающего списка
    $categories = Product::distinct()->pluck('category'); 
    return view('admin.edit', compact('product', 'categories'));
}

// Метод для сохранения изменений
public function update(Request $request, $id)
{
    $product = Product::findOrFail($id);

    $validated = $request->validate([
        'name' => 'required|max:255',
        'price' => 'required|numeric',
        'image' => 'nullable|image|max:2048', // Картинка теперь необязательна
        'description' => 'nullable',
    ]);

    // Логика категорий (как при создании)
    $category = $request->new_category ?: $request->existing_category;
    $product->category = $category;

    // Если загружено новое фото
    if ($request->hasFile('image')) {
        $imageName = time().'.'.$request->image->extension();
        $request->image->move(public_path('image/products'), $imageName);
        $product->image = $imageName;
    }

    $product->name = $request->name;
    $product->price = $request->price;
    $product->description = $request->description;
    
    $product->save();

    return redirect()->route('admin.index')->with('success', 'Товар успешно обновлен!');
    }
}