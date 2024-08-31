<?php

use App\Http\Controllers\AdminDashBoardController;
use App\Http\Controllers\BrandController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\PagesController;
use App\Http\Controllers\PageVisitController;
use App\Http\Controllers\PostImagesController;
use App\Http\Controllers\PostsController;
use App\Http\Controllers\ProductImagesController;
use App\Http\Controllers\ProductsController;
use App\Http\Controllers\ProjectController;
use App\Http\Controllers\ProjectImageController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\UserDashBoardController;
use Illuminate\Support\Facades\Route;

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

// PAGES
Route::get('/', [PagesController::class, 'index'])->name('beta-home');
Route::get('/solar', [PagesController::class, 'solar'])->name('solar-home');
Route::get('/networking', [PagesController::class, 'networking'])->name('networking-home');
Route::get('/surveillance', [PagesController::class, 'surveillance'])->name('surveillance-home');
Route::get('/contact_us', [PagesController::class, 'contact_us'])->name('contact-us');

//Mail
Route::post('/contact_form', [ContactController::class, 'contact_form'])->name('contact.form');

//Brands
Route::get('/admin/brands', [BrandController::class, 'index'])->name('brands')->middleware(['admin.access']);
Route::get('/admin/brands/new', [BrandController::class, 'create'])->name('brand.create')->middleware(['auth']);
Route::post('/admin/brands/new', [BrandController::class, 'store'])->name('brand.store')->middleware(['auth']);
Route::get('/admin/brands/edit/{id}', [BrandController::class, 'edit'])->name('brand.edit')->middleware(['auth']);
Route::post('/admin/brands/update/{id}', [BrandController::class, 'update'])->name('brand.update')->middleware(['auth']);
// Route::post('/admin/brands/delete_image/{id}', [BrandController::class, 'delete_image'])->name('brand.delete_image')->middleware(['auth']);
// Route::post('/admin/brands/delete_icon/{id}', [BrandController::class, 'delete_icon'])->name('brand.delete_icon')->middleware(['auth']);
Route::post('/admin/brands/delete/{id}', [BrandController::class, 'destroy'])->name('brand.delete')->middleware(['auth']);


//Categories
Route::get('/admin/categories', [CategoryController::class, 'index'])->name('categories')->middleware(['admin.access']);
Route::get('/admin/categories/new', [CategoryController::class, 'create'])->name('category.create')->middleware(['auth']);
Route::post('/admin/categories/new', [CategoryController::class, 'store'])->name('category.store')->middleware(['auth']);
Route::get('/admin/categories/edit/{id}', [CategoryController::class, 'edit'])->name('category.edit')->middleware(['auth']);
Route::post('/admin/categories/update/{id}', [CategoryController::class, 'update'])->name('category.update')->middleware(['auth']);
// Route::post('/admin/categories/delete_image/{id}', [CategoryController::class, 'delete_image'])->name('category.delete_image')->middleware(['auth']);
// Route::post('/admin/categories/delete_icon/{id}', [CategoryController::class, 'delete_icon'])->name('category.delete_icon')->middleware(['auth']);
Route::post('/admin/categories/delete/{id}', [CategoryController::class, 'destroy'])->name('category.delete')->middleware(['auth']);


//PROJECTS 
Route::get('/projects', [ProjectController::class, 'index'])->name('projects-home');
Route::get('/project/{slug}', [ProjectController::class, 'show'])->name('project.show');
Route::get('/admin/projects', [ProjectController::class, 'projects_manage'])->name('projects.manage')->middleware(['admin.access']);
Route::get('/admin/projects/new', [ProjectController::class, 'create'])->name('project.new')->middleware(['auth']);
Route::get('/admin/projects/edit/{id}', [ProjectController::class, 'edit'])->name('project.edit')->middleware(['auth']);
Route::post('/admin/projects/store_preview', [ProjectController::class, 'store_preview'])->name('project.store_preview')->middleware(['auth']);
Route::post('/admin/projects/update/{id}', [ProjectController::class, 'update'])->name('project.update')->middleware(['auth']);
Route::post('/admin/projects/publish/{id}', [ProjectController::class, 'publish'])->name('project.publish')->middleware(['auth']);
Route::post('/admin/projects/delete/{id}', [ProjectController::class, 'destroy'])->name('project.delete')->middleware(['auth']);

//Project Images
Route::post('/admin/projects/image_main/{id}', [ProjectImageController::class, 'mark_main'])->name('image.project_main')->middleware(['auth']);
Route::post('/admin/projects/image_delete/{id}', [ProjectImageController::class, 'destroy'])->name('image.project_delete')->middleware(['auth']);



// POSTS - BLOG
Route::get('/blog', [PostsController::class, 'index'])->name('blog-home');
Route::get('/post/{slug}', [PostsController::class, 'show'])->name('post.show');
Route::get('/admin/posts', [PostsController::class, 'blog_manage'])->middleware(['writer.access'])->name('posts.manage');
Route::get('/admin/posts/new', [PostsController::class, 'create'])->name('post.new')->middleware(['auth']);
// Route::get('/post/admin/{identifier}', [PostsController::class, 'admin_show'])->middleware(['auth'])->name('post.show_admin');
Route::get('/admin/posts/edit/{id}', [PostsController::class, 'edit'])->name('post.edit')->middleware(['auth']);
Route::post('/admin/posts/store_preview', [PostsController::class, 'store_preview'])->name('post.store_preview')->middleware(['auth']);
Route::post('/admin/posts/update/{id}', [PostsController::class, 'update'])->name('post.update')->middleware(['auth']);
Route::post('/admin/posts/publish/{id}', [PostsController::class, 'publish'])->name('post.publish')->middleware(['auth']);
Route::post('/admin/posts/delete/{id}', [PostsController::class, 'destroy'])->name('post.delete')->middleware(['auth']);


//Post Images
Route::post('/admin/blog/image_upload', [PostImagesController::class, 'image_upload'])->name('image.post_upload')->middleware(['auth']);
Route::post('/admin/blog/image_main/{id}', [PostImagesController::class, 'mark_main'])->name('image.post_main')->middleware(['auth']);
Route::post('/admin/blog/image_delete/{id}', [PostImagesController::class, 'destroy'])->name('image.post_delete')->middleware(['auth']);




// PRODUCTS - SHOP
Route::get('/shop', [ProductsController::class, 'index'])->name('shop-home');
Route::get('/product/search', [ProductsController::class, 'product_search'])->name('product.search');
Route::get('/product/{slug}', [ProductsController::class, 'show'])->name('product.show');
Route::get('/product/share/{identifier}', [ProductsController::class, 'admin_show'])->middleware(['auth'])->name('product.show_admin');
Route::get('/products/category/{category}', [ProductsController::class, 'show_category'])->name('product.show_category');
Route::get('/products/filter/filter_brand', [ProductsController::class, 'filter_brand'])->name('product.filter_brand');
Route::get('/admin/products', [ProductsController::class, 'products_manage'])->name('products.manage')->middleware(['lister.access']);
Route::get('/admin/products/new', [ProductsController::class, 'create'])->name('product.new')->middleware(['auth']);
Route::get('/admin/products/edit/{id}', [ProductsController::class, 'edit'])->name('product.edit')->middleware(['auth']);
Route::post('/admin/products/new', [ProductsController::class, 'store'])->name('product.store')->middleware(['auth']);
Route::match(['get', 'post'], '/admin/products/list', [ProductsController::class, 'generate_list'])->name('products.list')->middleware(['auth']);
Route::post('/admin/products/update/{id}', [ProductsController::class, 'update'])->name('product.update')->middleware(['auth']);
Route::post('/admin/products/set_price/{id}', [ProductsController::class, 'set_price'])->name('product.set_price')->middleware(['auth']);
Route::post('/admin/products/mark_list/{id}', [ProductsController::class, 'mark_listed'])->name('product.mark_listed')->middleware(['auth']);
Route::post('/admin/products/mark_sold/{id}', [ProductsController::class, 'mark_sold'])->name('product.mark_sold')->middleware(['auth']);
Route::post('/admin/products/delete/{id}', [ProductsController::class, 'destroy'])->name('product.delete')->middleware(['auth']);

//Product Images
Route::post('/admin/product/image_main/{id}', [ProductImagesController::class, 'mark_main'])->name('image.product_main')->middleware(['auth']);
Route::post('/admin/product/image_delete/{id}', [ProductImagesController::class, 'destroy'])->name('image.product_delete')->middleware(['auth']);

//PageVisits
Route::get('/admin/page_visits', [PageVisitController::class, 'index'])->name('page_visits')->middleware(['admin.access']);
Route::get('/admin/page_visits/all/view', [PageVisitController::class, 'visits_all'])->name('visits_all')->middleware(['admin.access']);
Route::get('/admin/page_visits/{identifier}', [PageVisitController::class, 'show_list'])->name('visits.list')->middleware(['admin.access']);

//Admin Users Management
Route::get('/admin/users', [UserController::class, 'index'])->name('admin.users')->middleware(['admin.access']);
Route::get('/admin/users/{username}', [UserController::class, 'show'])->name('user.show')->middleware(['admin.access']);
Route::post('/admin/users/update/{id}', [UserController::class, 'update'])->name('admin.update_user')->middleware(['admin.access']);
Route::post('/admin/users/change_role/{id}', [UserController::class, 'change_role'])->name('admin.change_role')->middleware(['admin.access']);
Route::post('/admin/users/ban/{id}', [UserController::class, 'ban'])->name('admin.ban_user')->middleware(['admin.access']);
Route::post('/admin/users/delete/{id}', [UserController::class, 'destroy'])->name('admin.delete_user')->middleware(['admin.access']);

//Dashboard
Route::get('/admin/dashboard', [AdminDashBoardController::class, 'index'])->name('admin.dashboard')->middleware(['admin.access']);
Route::get('/admin/mtc/artmg', [AdminDashBoardController::class, 'artisan_migrate'])->name('admin.artmg')->middleware(['admin.access']);
Route::get('/admin/mtc/artmgfrsh', [AdminDashBoardController::class, 'artisan_mgrtfrsh'])->name('admin.artmgfrsh')->middleware(['admin.access']);
Route::get('/admin/mtc/artdbseed', [AdminDashBoardController::class, 'artisan_seed'])->name('admin.artsd')->middleware(['admin.access']);
Route::get('/admin/mtc/artvwcch', [AdminDashBoardController::class, 'artisan_vwcch'])->name('admin.artvwcch')->middleware(['admin.access']);
Route::get('/admin/mtc/artvwclr', [AdminDashBoardController::class, 'artisan_vwclr'])->name('admin.artvwclr')->middleware(['admin.access']);
Route::get('/admin/mtc/artchclr', [AdminDashBoardController::class, 'artisan_chclr'])->name('admin.artchclr')->middleware(['admin.access']);
Route::get('/admin/mtc/artcfgclr', [AdminDashBoardController::class, 'artisan_cfgclr'])->name('admin.artcfgclr')->middleware(['admin.access']);
Route::get('/admin/mtc/artstglnk', [AdminDashBoardController::class, 'artisan_stglnk'])->name('admin.artstglnk')->middleware(['admin.access']);

//User
Route::get('/user/{username}', [UserController::class, 'profile'])->middleware(['auth'])->name('user.profile');
Route::get('/user/dashboard', [UserDashBoardController::class, 'index'])->name('user.dashboard')->middleware(['auth']);


// Route::get('/', function () {
//     return view('welcome');
// });;;;;;;



Route::get('/dashboard', function () {
    if (auth()->user()->is_admin) {
        return redirect()->route('admin.dashboard');
    }
    return redirect()->route('user.dashboard');
})->middleware(['auth'])->name('dashboard');

require __DIR__ . '/auth.php';
