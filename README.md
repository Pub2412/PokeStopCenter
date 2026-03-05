# PokeStop Center

A Laravel-based e-commerce application for buying and selling Pokémon merchandise, cards, accessories and collectibles.  

**This README contains installation instructions, database design documentation, and pointers to source code.**

---

<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400" alt="Laravel Logo"></a></p>

<p align="center">
<a href="https://github.com/laravel/framework/actions"><img src="https://github.com/laravel/framework/workflows/tests/badge.svg" alt="Build Status"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/dt/laravel/framework" alt="Total Downloads"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/v/laravel/framework" alt="Latest Stable Version"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/l/laravel/framework" alt="License"></a>
</p>

## About Laravel

Laravel is a web application framework with expressive, elegant syntax. We believe development must be an enjoyable and creative experience to be truly fulfilling. Laravel takes the pain out of development by easing common tasks used in many web projects, such as:

- [Simple, fast routing engine](https://laravel.com/docs/routing).
- [Powerful dependency injection container](https://laravel.com/docs/container).
- Multiple back-ends for [session](https://laravel.com/docs/session) and [cache](https://laravel.com/docs/cache) storage.
- Expressive, intuitive [database ORM](https://laravel.com/docs/eloquent).
- Database agnostic [schema migrations](https://laravel.com/docs/migrations).
- [Robust background job processing](https://laravel.com/docs/queues).
- [Real-time event broadcasting](https://laravel.com/docs/broadcasting).

Laravel is accessible, powerful, and provides tools required for large, robust applications.

## Learning Laravel

Laravel has the most extensive and thorough [documentation](https://laravel.com/docs) and video tutorial library of all modern web application frameworks, making it a breeze to get started with the framework. You can also check out [Laravel Learn](https://laravel.com/learn), where you will be guided through building a modern Laravel application.

If you don't feel like reading, [Laracasts](https://laracasts.com) can help. Laracasts contains thousands of video tutorials on a range of topics including Laravel, modern PHP, unit testing, and JavaScript. Boost your skills by digging into our comprehensive video library.

## Laravel Sponsors

We would like to extend our thanks to the following sponsors for funding Laravel development. If you are interested in becoming a sponsor, please visit the [Laravel Partners program](https://partners.laravel.com).

### Premium Partners

- **[Vehikl](https://vehikl.com)**
- **[Tighten Co.](https://tighten.co)**
- **[Kirschbaum Development Group](https://kirschbaumdevelopment.com)**
- **[64 Robots](https://64robots.com)**
- **[Curotec](https://www.curotec.com/services/technologies/laravel)**
- **[DevSquad](https://devsquad.com/hire-laravel-developers)**
- **[Redberry](https://redberry.international/laravel-development)**
- **[Active Logic](https://activelogic.com)**

## Contributing

Thank you for considering contributing to the Laravel framework! The contribution guide can be found in the [Laravel documentation](https://laravel.com/docs/contributions).

## Code of Conduct

In order to ensure that the Laravel community is welcoming to all, please review and abide by the [Code of Conduct](https://laravel.com/docs/contributions#code-of-conduct).

## Security Vulnerabilities

If you discover a security vulnerability within Laravel, please send an e-mail to Taylor Otwell via [taylor@laravel.com](mailto:taylor@laravel.com). All security vulnerabilities will be promptly addressed.


## License

The Laravel framework is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).

---

## Project Documentation

### Installation

1. Clone or copy the repository into your working directory.
2. Run `composer install` to install PHP dependencies.
3. (Optional but strongly recommended) scaffold authentication. You can use
   Laravel Breeze, UI, or Jetstream. Whichever package you choose must be
   installed *before* the application attempts to use `Auth::routes()` in
   `routes/web.php` – otherwise you will see the runtime exception
   "please install the laravel/ui package".

   **Laravel Breeze** (modern, minimal):
   ```bash
   composer require laravel/breeze --dev
   php artisan breeze:install
   npm install && npm run dev
   php artisan migrate
   ```
   choose 'blade'
   choose PHPUnit (1)
   Breeze places its own routes file at `routes/auth.php` and you don’t
   need to call `Auth::routes()` manually.

   **Laravel UI** (legacy):
   ```bash
   composer require laravel/ui --dev
   php artisan ui bootstrap --auth
   npm install && npm run dev
   php artisan migrate
   ```
   After installing UI you can uncomment the `Auth::routes(['verify'=>true])`
   line in `routes/web.php`.

   This step must be completed before the server is started; otherwise the
   login, register and password-reset links on the layout will throw a
   RouteNotFoundException.
4. Duplicate `.env.example` to `.env` and set up your database credentials.
   -- 4.1 Create a database titled "pkstop" on MySQL
5. Execute `php artisan key:generate`.
5. **Create storage directories** (needed for product images):
   ```bash
   mkdir -p storage/app/public/images
   ```
6. Run migrations and seeders: `php artisan migrate --seed`.
   > the factories use placeholder image paths; if you later upload real images they will land in `storage/app/public/images`.
7. Publish storage link: `php artisan storage:link`.
8. Optional NPM build: `npm install` and `npm run dev`.
9. Start the server with `php artisan serve` and visit `http://localhost:8000`.

### Code Structure

- **routes/web.php** &ndash; defines public and admin routes including middleware guards.
- **app/Models/** &ndash; Eloquent models representing tables and relationships.
- **database/migrations/** &ndash; migration scripts constructing the normalized schema.
- **database/seeders/** &ndash; seeds for initial data.
- **app/Http/Controllers/** &ndash; controllers handling request logic.
- **resources/views/** &ndash; Blade templates; layout files allow easy theme changes.

### Database Design

The ERD appears earlier in this README; main tables include `users`, `categories`, `products`, `product_images`, `reviews`, `transactions` and `transaction_items`.  Fields are designed to satisfy 2NF with foreign key constraints.

### Further Development

Refer to controller comments and look for `TODO` markers when extending features such as:

- File uploads for single/multiple photos
- Excel import of products
- Role and status updates in admin views
- Email verification and notifications
- PDF receipt generation
- Filters, validation rules, charts, and search techniques as per assignment requirements.

The front end is deliberately simple; you can modify or replace any view under `resources/views` to fit your design. Image paths stored in the database start blank by default; the upload logic stores files in `storage/app/public`.

### ERD Diagram

(see above, rendered via Mermaid)

---

*This README may be extended as project evolves.*
