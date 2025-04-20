![](assets/banner.png)
# 🚀 MVC PHP Framework

This is a lightweight and extensible MVC (Model-View-Controller) framework built with PHP. It provides a structured way to build web applications by separating concerns into models, views, and controllers.

> **Note:** The core framework code resides in `vendor/ramez/php-mvc-core`. Your application code (controllers, models, views) lives in the project root folders.

## ✨ Features

- **🛣️ Routing**: Define routes for GET and POST requests, mapping to views or controller actions.
- **🧠 Controllers**: Organize application logic, render views, manage layouts, and register middleware.
- **📦 Models**: Data validation, labels, error handling, and database integration (ActiveRecord-like).
- **🔐 Authentication**: Built-in user authentication, login/logout, and user session management.
- **🛡️ Middleware**: Protect routes/actions with middleware (e.g., authentication).
- **🎨 Views & Layouts**: Render dynamic HTML templates with layouts and flash messages.
- **📝 Form Handling**: Simplified form creation, validation, and error display.
- **⚡ Flash Messages**: Show one-time notifications (e.g., success/error).
- **🗄️ Database Migrations**: Versioned schema migrations for easy DB management.
- **🔑 Environment Variables**: Use `.env` for configuration (via `vlucas/phpdotenv`).
- **🧩 Extensible**: Easily add your own controllers, models, and views.

## ⚙️ Requirements

- 🐘 PHP 7.4 or higher
- 📦 Composer for dependency management
- 🌐 A web server (e.g., Apache, Nginx)
- 🗄️ MySQL or compatible database

## 📥 Installation

1. Clone the repository:
   ```bash
   git clone https://github.com/your-repo/mvc-php-framework.git
   cd mvc-php-framework
   ```

2. Install dependencies using Composer:
   ```bash
   composer install
   ```

3. Copy `.env.example` to `.env` and update your database credentials.

4. Run database migrations:
   ```bash
   php migrations.php
   ```

5. Set up your web server to serve the `public` directory as the document root.

## 📂 Directory Structure

```
MVC-PHP-Framework/
├── controllers/       # 🧠 Application controllers
├── models/            # 📦 Application models
├── views/             # 🎨 Application views and layouts
├── migrations/        # 🗄️ Database migration files
├── public/            # 🌐 Publicly accessible files (entry point: index.php)
├── runtime/           # 🗂️ Temporary runtime files
├── vendor/            # 📦 Composer dependencies (core framework here)
├── composer.json      # 📜 Composer configuration
└── README.md          # 📖 Project documentation
```

> **Core framework code is in `vendor/ramez/php-mvc-core/`. Do not modify vendor files directly.**

## 🛠️ Usage

### 🛣️ Routing

Define routes in `public/index.php`:
```php
$app->router->get('/', 'home'); // renders views/home.php
$app->router->get('/contact', 'contact'); // renders views/contact.php

// Controller routes
$app->router->get('/login', [App\Controllers\AuthController::class, 'login']);
$app->router->post('/login', [App\Controllers\AuthController::class, 'login']);
$app->router->get('/register', [App\Controllers\AuthController::class, 'register']);
$app->router->post('/register', [App\Controllers\AuthController::class, 'register']);
$app->router->get('/logout', [App\Controllers\AuthController::class, 'logout']);
$app->router->get('/profile', [App\Controllers\AuthController::class, 'profile']);
```

### 🧠 Controllers

Create controllers in the `controllers` directory. Example:
```php
namespace App\Controllers;

use Ramez\PhpMvcCore\Controller;

class ExampleController extends Controller {
    public function view() {
        return $this->render('contact');
    }
}
```
- Use `$this->setLayout('main')` or `'auth'` to change layouts.
- Register middleware in the constructor:  
  `$this->registerMiddleware(new AuthMiddleware(['profile']));`

### 📦 Models

Define models in the `models` directory. Example:
```php
namespace App\Models;

use Ramez\PhpMvcCore\Model;

class RegisterModel extends Model {
    public string $name = "";
    public string $email = "";
    public string $password = "";

    public function rules(): array {
        return [
            'name' => [self::RULE_REQUIRED],
            'email' => [self::RULE_REQUIRED, self::RULE_EMAIL],
            'password' => [self::RULE_REQUIRED, [self::RULE_MIN, 'min' => 8]],
        ];
    }
}
```
- For database models, extend `DatabaseModel` and implement `tableName()`, `attributes()`, and `id()`.

### 🔐 Authentication

- User models should extend `UserModel` and implement `getDisplayName()`.
- Use `Application::$app->login($user)` and `Application::$app->logout()`.
- Protect routes/actions with `AuthMiddleware`.

### 🛡️ Middleware

- Create middleware by extending `BaseMiddleware`.
- Register in controllers to protect actions (e.g., only logged-in users can access `/profile`).

### 🎨 Views & Layouts

- Place views in `views/` and layouts in `views/layouts/`.
- Use `{{content}}` in layouts to inject view content.
- Set page title with `$this->title = "Page Title";` in views.

### 📝 Form Handling

- Use the built-in form builder:
```php
$form = \Ramez\PhpMvcCore\Form\Form::begin('/register', 'post');
echo $form->field($model, 'email')->emailField();
echo $form->field($model, 'password')->passwordField();
\Ramez\PhpMvcCore\Form\Form::end();
```
- Validation errors are displayed automatically.

### ⚡ Flash Messages

- Set a flash message:  
  `Application::$app->session->setFlash("success", "Message");`
- Display in layout:
```php
<?php if (Application::$app->session->getFlash("success")): ?>
  <div class="notification is-success">
    <?= Application::$app->session->getFlash("success") ?>
  </div>
<?php endif; ?>
```

### 🗄️ Database Migrations

- Place migration files in `migrations/`.
- Run all migrations:  
  `php migrations.php`

### 🔑 Environment Variables

- Store sensitive config in `.env` (see `.env.example`).

## 🧩 Extending the Framework

- Add your own controllers, models, and views in the respective folders.
- Do **not** modify files in `vendor/ramez/php-mvc-core/` directly, you can fork this [MVC-PHP-Core](https://github.com/r6mez/MVC-PHP-Core)
