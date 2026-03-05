# Code Walkthrough

This document highlights key sections of the codebase and explains their purpose line-by-line.  It is intended as a companion to the assignment requirement for detailed documentation.

## routes/web.php

```php
Route::get('/', function () {
    return view('welcome');
});
```
- Defines the homepage; returns the `welcome` view shipped with Laravel (you can replace it).

```php
Route::resource('products', \App\Http\Controllers\ProductController::class)->only(['index','show']);
```
- Generates two routes: `GET /products` -> `ProductController@index` and `GET /products/{product}` -> `ProductController@show`.
- The `only` array limits routes to read-only actions.

```php
Route::middleware(['auth','verified','role:admin'])->prefix('admin')->name('admin.')->group(function () {
    Route::resource('products', \App\Http\Controllers\Admin\ProductController::class);
    // ...
});
```
- Creates a group of routes that all require the user to be logged in (`auth`), have a verified email (`verified`) and have the `admin` role (custom `role` middleware defined in `App\Http\Middleware\CheckRole`).
- URL paths are prefixed with `/admin` and route names begin with `admin.` (e.g. `admin.products.index`).

## app/Http/Controllers/ProductController.php

```php
public function index(Request $request)
{
    // TODO: implement filtering by price/name/category
    $query = Product::with('images');
    if ($request->filled('search')) {
        $query->where('name', 'like', '%'.$request->search.'%');
    }
    // additional filters ...
    $products = $query->paginate(12);
    return view('products.index', compact('products'));
}
```
- Receives an HTTP request; builds an Eloquent query for products including their images to avoid N+1 problems.
- Applies a `LIKE` search if the `search` query parameter is present.
- Paginates results (12 per page) and passes them to the `products.index` view via `compact()`.

## app/Models/Product.php

```php
class Product extends Model
{
    use HasFactory;
    protected $fillable = [...];
    public function category() { return $this->belongsTo(Category::class); }
    public function images() { return $this->hasMany(ProductImage::class); }
    // ...
}
```
- `HasFactory` enables generation of fake records in tests/seeding.
- `$fillable` lists columns that may be mass-assigned via `Product::create($request->all())`.
- Relationship methods define how products relate to other entities. Laravel uses them to load related records and to construct join queries.

## database/migrations/2026_03_05_000002_create_products_table.php

Schema definition example:

```php
$table->decimal('price', 10, 2)->default(0);
$table->foreignId('category_id')->nullable()->constrained()->onDelete('set null');
```
- Creates a `price` column suitable for currency (up to 10 digits with 2 decimals).
- `foreignId` creates an unsigned bigint column `category_id` and sets up a foreign key pointing to `categories.id`. `onDelete('set null')` will prevent deleting a category if products exist; instead the field becomes `NULL`.

The other migration files follow the same pattern.

## Custom Middleware: app/Http/Middleware/CheckRole.php

```php
public function handle(Request $request, Closure $next, $role)
{
    $user = Auth::user();
    if (! $user || $user->role !== $role) {
        abort(403, 'Unauthorized');
    }
    return $next($request);
}
```
- Checks the authenticated user against the role parameter passed when registering middleware (`->middleware('role:admin')`). If the user is not logged in or does not have the expected role the request aborts with HTTP 403.

## Conclusion

Further explanation can be found by reading the remaining controllers, views, and migration files; comments (`//`) indicate where to plug in features such as validation rules, file upload handling, or email/receipt logic. By following Laravel's conventions, the application remains modular and easy to extend.
