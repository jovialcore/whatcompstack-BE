## ✨ What-Company-Stack Backend and Admin


### Installation

Before you begin, ensure you have met the following requirements:

- [PHP](https://www.php.net/) >= 8.x
- [Composer](https://getcomposer.org/) installed
- [Node.js](https://nodejs.org/) and [npm](https://www.npmjs.com/) (for frontend assets)

### Installation

```bash
git clone  https://github.com/jovialcore/whatcompstack-BE.git
cd whatcompstack-BE
composer install
npm install
cp .env.example .env
```
### Configuration
```bash
php artisan key:generate
```

### Database Setup
```bash
php artisan migrate
php artisan db:seed
```

### Running the application

```bash
php artisan serve
```
