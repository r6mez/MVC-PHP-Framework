# 🚀 MVC PHP Framework

This is a lightweight and extensible MVC (Model-View-Controller) framework built with PHP. It provides a structured way to build web applications by separating concerns into models, views, and controllers.

## ✨ Features

- **🛣️ Routing**: Define routes for GET and POST requests.
- **🧠 Controllers**: Handle application logic and interact with models and views.
- **📦 Models**: Define and validate application data.
- **🎨 Views**: Render dynamic HTML templates with layouts.
- **📝 Form Handling**: Simplified form creation and validation.

## ⚙️ Requirements

- 🐘 PHP 7.4 or higher
- 📦 Composer for dependency management
- 🌐 A web server (e.g., Apache, Nginx)

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

3. Set up your web server to serve the `public` directory as the document root.

## 📂 Directory Structure

```
MVC-PHP-Framework/
├── controllers/       # 🧠 Application controllers
├── core/              # ⚙️ Core framework classes
├── models/            # 📦 Application models
├── public/            # 🌐 Publicly accessible files (e.g., index.php)
├── runtime/           # 🗂️ Temporary runtime files
├── views/             # 🎨 Application views and layouts
├── composer.json      # 📜 Composer configuration
└── README.md          # 📖 Project documentation
```

## 🛠️ Usage

### 🛣️ Routing

Define routes in `public/index.php`:
```php
$app->router->get('/', 'home');
$app->router->get('/contact', [App\Controllers\ExampleController::class, 'view']);
$app->router->post('/contact', [App\Controllers\ExampleController::class, 'handleData']);
```

### 🧠 Controllers

Create controllers in the `controllers` directory. Example:
```php
namespace App\Controllers;

use App\Core\Controller;

class ExampleController extends Controller {
    public function view() {
        return $this->render('contact');
    }
}
```

### 📦 Models

Define models in the `models` directory. Example:
```php
namespace App\Models;

use App\Core\Model;

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

### 🎨 Views

Create views in the `views` directory. Example:
```php
<h1>Welcome to the Home Page</h1>
<p>This is a simple MVC framework.</p>
```

### 🖼️ Layouts

Define layouts in `views/layouts`. Example:
```php
<!DOCTYPE html>
<html>
<head>
    <title>My App</title>
</head>
<body>
    {{content}}
</body>
</html>
```