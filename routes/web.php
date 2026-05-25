<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\CatalogController;
use App\Http\Controllers\KorzController;
use App\Http\Controllers\ProflController;
use Illuminate\Support\Facades\Request;
use App\Http\Controllers\AdminController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('home'); 
})->name('home');


Route::get('/register', [AuthController::class, 'showAuthForm'])->name('register');
Route::post('/register', [AuthController::class, 'register']);

Route::get('/login', [AuthController::class, 'showAuthForm'])->name('login');
Route::post('/login', [AuthController::class, 'login']);

Route::post('/logout', [AuthController::class, 'logout'])->name('logout');


// 1. Главная страница (ТЕПЕРЬ ДОСТУПНА ВСЕМ)
Route::get('/', function () { return view('home'); })->name('home');
Route::get('/home', function () { return view('home'); });

// 2. Публичные страницы (Каталог доступен всем)
Route::get('/catalog', [CatalogController::class, 'index'])->name('catalog');




Route::get('/catalog', [CatalogController::class, 'index'])->name('catalog');
Route::get('/cart', [KorzController::class, 'index'])->name('cart');
Route::get('/profl', [ProflController::class, 'index'])->name('profl');

// 3. Маршрут профиля (Убираем middleware('auth'), логику перенаправления сделаем в контроллере)
Route::get('/profl', [ProflController::class, 'index'])->name('profl');


// 5. Защищенные действия (Только для вошедших пользователей)
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProflController::class, 'index'])->name('profile');
    Route::post('/profile/update', [ProflController::class, 'update'])->name('profile.update');
    Route::delete('/profile/delete', [ProflController::class, 'destroy'])->name('profile.destroy');
    
    // Корзина и заказы обычно требуют авторизации
    Route::get('/korz', [KorzController::class, 'index'])->name('korz');
    Route::post('/korz/add', [KorzController::class, 'add'])->name('korz.add');
});


// Route::get('/catalog', 'CatalogController@index')->name('catalog');
// Route::post('/add-to-cart', 'CartController@add')->name('add-to-cart');
// Route::get('/cart', 'CartController@index')->name('cart');
//корзина и каталоги - корзина с новым контроллером

// Каталог товаров
Route::get('/catalog', [CatalogController::class, 'index'])->name('catalog');

Route::get('/product/{id}', [CatalogController::class, 'show'])->name('product.show');

// Корзина
Route::get('/korz', [KorzController::class, 'index'])->name('korz');


// Маршрут для удаления товара из сессии
Route::post('/cart/remove', [App\Http\Controllers\KorzController::class, 'remove'])->name('cart.remove');
// Маршрут для обновления количества товара в сессии
Route::post('/cart/update-quantity', [App\Http\Controllers\KorzController::class, 'updateQuantity'])->name('cart.update.quantity');


// Добавление в корзину
Route::post('/korz/add', [KorzController::class, 'add'])->name('korz.add');
///

// Используем метод DELETE для удаления ресурса
Route::delete('/profile/delete', [ProflController::class, 'destroy'])->name('profile.destroy');

Route::post('/cart-add-session', [KorzController::class, 'addToSession'])->name('cart.add.session');



Route::post('/cart/add', [App\Http\Controllers\KorzController::class, 'add'])->name('cart.add');


Route::post('/cart/add', function (Illuminate\Http\Request $request) {
    $cart = session()->get('cart', []);
    $id = $request->id;

    if(isset($cart[$id])) {
        $cart[$id]['quantity']++;
    } else {
        $cart[$id] = [
            "name" => $request->name,
            "quantity" => 1,
            "price" => $request->price,
            "image" => $request->image
        ];
    }

    session()->put('cart', $cart);
    return response()->json(['status' => 'success']);
})->name('cart.add');





// Группа маршрутов для админ-панели эти пути доступны ТОЛЬКО админу
Route::prefix('admin')->name('admin.')->middleware(['auth', 'admin'])->group(function () {
    // Главная страница админки (список товаров)
    Route::get('/', [AdminController::class, 'index'])->name('index');

    // Страница с формой добавления
    Route::get('/create', [AdminController::class, 'create'])->name('create');

    // Логика сохранения
    Route::post('/store', [AdminController::class, 'store'])->name('store');

    // Удаление товара
    Route::delete('/delete/{id}', [AdminController::class, 'destroy'])->name('destroy');
});




// Показать форму редактирования
Route::get('/admin/edit/{id}', [App\Http\Controllers\AdminController::class, 'edit'])->name('admin.edit');
// Обновить данные в базе
Route::put('/admin/update/{id}', [App\Http\Controllers\AdminController::class, 'update'])->name('admin.update');


// Маршрут для сохранения оценки (доступен только авторизованным)
Route::post('/product/{id}/rate', [App\Http\Controllers\CatalogController::class, 'rate'])
    ->name('product.rate')
    ->middleware('auth');



Route::post('/product/{id}/comment', [\App\Http\Controllers\CatalogController::class, 'storeComment'])->name('comment.store')->middleware('auth');
Route::delete('/comment/{id}', [\App\Http\Controllers\CatalogController::class, 'destroyComment'])->name('comment.destroy')->middleware('auth');