# 🚀 Laravel Project Setup Guide

Welcome to my Restaurant project! This guide will walk you through setting everything up and running locally in no time.

---

## 📦 Requirements

Make sure you have the following installed:

- PHP 8.1+
- Composer
- Node.js & npm
- MySQL or PostgreSQL
- Laravel Herd (or Valet / XAMPP / WAMP / Docker — whatever works for you)

---

## ⚙️ Installation

Clone the repo:

```bash
git clone https://github.com/SeadSilajdzic/food-delivery.git
cd food-delivery
```

Install PHP dependencies:

```bash
composer install
```

Install frontend dependencies:

```bash
npm install
```

Copy the `.env` file and generate the app key:

```bash
cp .env.example .env
php artisan key:generate
```

Set up your local database and update `.env`:

```dotenv
DB_DATABASE=your_database
DB_USERNAME=your_username
DB_PASSWORD=your_password
```

Run migrations:

```bash
php artisan migrate
```

(Optional) Seed the database:

```bash
php artisan db:seed
```

---

## 🔧 Build Frontend

For development:

```bash
npm run dev
```

For production:

```bash
npm run build
```

---

## 🧪 Useful Commands

Lint & format code before committing (if Husky is set up):

```bash
npm run lint
npm run pint
npm run format
```

Clear cache:

```bash
php artisan optimize:clear
```

❗ Note:

This project uses husky and will automatically run "Useful Commands" before each commit.

---

## 🐞 Troubleshooting

- **Permission errors?**  
  Run `chmod -R 775 storage bootstrap/cache` on Unix systems.

- **App not loading?**  
  Check your `.env`, database connection, and local dev server URL.

---

## 💖 Contributing

Pull requests are welcome. For major changes, please open an issue first to discuss what you’d like to change.

---

## 📄 License

[MIT](LICENSE)

---

Made with ☕, 💻, and too many `php artisan` commands.
