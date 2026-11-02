<div align="center">

# Copas

Copas is a gamified learning platform that helps primary school students understand environmental problems
such as flooding and pollution, and what they can do about them. Students work through a path of missions,
earn XP, level up, and compete on a leaderboard. Teachers manage classes and accounts, maintain the question bank,
and follow each student's progress. The interface is in Indonesian.

<br />

![PHP](https://img.shields.io/badge/PHP_8.3%2B-777BB4?style=for-the-badge&logo=php&logoColor=white)
![Laravel](https://img.shields.io/badge/Laravel_13-FF2D20?style=for-the-badge&logo=laravel&logoColor=white)
![Livewire](https://img.shields.io/badge/Livewire_4-FB70A9?style=for-the-badge&logo=livewire&logoColor=white)
![Flux UI](https://img.shields.io/badge/Flux_UI_2-0EA5E9?style=for-the-badge)
![Tailwind CSS](https://img.shields.io/badge/Tailwind_CSS_4-06B6D4?style=for-the-badge&logo=tailwindcss&logoColor=white)
![Vite](https://img.shields.io/badge/Vite_8-646CFF?style=for-the-badge&logo=vite&logoColor=white)
![Redis](https://img.shields.io/badge/Redis-DC382D?style=for-the-badge&logo=redis&logoColor=white)
![SQLite](https://img.shields.io/badge/SQLite-003B57?style=for-the-badge&logo=sqlite&logoColor=white)

</div>

---

## Table of Contents

- [Features](#features)
- [Learning System](#learning-system)
- [Tech Stack](#tech-stack)
- [Getting Started](#getting-started)
  - [Prerequisites](#prerequisites)
  - [Installation](#installation)
  - [Configuration](#configuration)
  - [Running the Application](#running-the-application)
  - [Demo Accounts](#demo-accounts)
- [Available Scripts](#available-scripts)
- [Testing](#testing)
- [Code Style](#code-style)
- [Project Structure](#project-structure)
- [License](#license)

## Features

### For students

- Dashboard with overall progress, current XP, and level.
- Learning path of six missions. Each mission unlocks after the previous one is completed.
- Mixed activities: embedded YouTube lessons, essay questions, true or false statements, and a field observation that includes a photo upload.
- XP and levels from 1 to 10, at 100 XP per level.
- Final quiz of multiple-choice questions, with the completion time recorded.
- Leaderboard that shows the top students and the student's own rank.
- Profile page and an About page.

### For teachers

- Dashboard with per-student progress, a leaderboard, and quiz statistics (average time, average score, lowest score, highest score).
- Student management: create, edit, and delete student accounts, create classes, search by name, and filter by class.
- Quiz results per student, including the number of correct answers and the time taken.
- Question bank editor: add, edit, and delete multiple-choice questions and options, mark the correct option, and attach images with adjustable display settings.
- Answer review for each student, including essay answers and uploaded photos.
- Teachers can register their own account from the landing page.

### Accounts and security

- Role-based access for `student` and `teacher` roles through Spatie Permission. Student pages live under `/siswa` and teacher pages under `/guru`.
- Sign in with either email or username.
- Password reset and email verification flows built on Laravel Fortify.
- Two-factor authentication with recovery codes, password changes, appearance settings, and account deletion.
- Redis-backed sessions, cache, and queues in the default configuration, with Laravel Octane support.
- Pest test suite and Laravel Pint checks that run on GitHub Actions.

## Learning System

The learning content follows an environmental theme. The path starts with flooding after heavy rain, moves through observation of the student's own surroundings, and ends with a reflection mission. A final quiz follows the missions. Lesson notes are in [`docs/pathmap.md`](docs/pathmap.md).

| Mission | Title (as seeded)                            | Max XP |
| ------- | -------------------------------------------- | ------ |
| 1       | Dasar IPAS                                   | 150    |
| 2       | Ayo Tentukan Benar atau Salah!               | 100    |
| 3       | Observasi Lingkungan                         | 150    |
| 4       | Mengapa Terjadi dan Bagaimana Solusinya?     | 150    |
| 5       | ALAM BERUBAH, KITA WASPADA!                  | 100    |
| 6       | Ayo Lakukan Refleksi                         | 150    |

Each correct answer in the final quiz gives 10 XP. [`docs/level.md`](docs/level.md) plans for 20 quiz questions, which brings the total to 1,000 XP and level 10. The seeder imports the questions from [`docs/quiz.md`](docs/quiz.md), which currently holds 18, and teachers can add more in the question bank.

## Tech Stack

| Layer          | Technology                                                  | Version |
| -------------- | ----------------------------------------------------------- | ------- |
| Language       | PHP                                                         | 8.3+    |
| Framework      | Laravel                                                     | 13.x    |
| Authentication | Laravel Fortify                                             | 1.x     |
| Authorization  | Spatie Laravel Permission                                   | 7.x     |
| Frontend       | Livewire, Flux UI                                           | 4.x, 2.x |
| Styling        | Tailwind CSS (via `@tailwindcss/vite`)                      | 4.x     |
| Build tool     | Vite with `laravel-vite-plugin`                             | 8.x     |
| App server     | Laravel Octane                                              | 2.x     |
| Database       | SQLite (default)                                            | n/a     |
| Cache, queue   | Redis through Predis                                        | 3.x     |
| Testing        | Pest, Pest Laravel plugin                                   | 4.x     |
| Code quality   | Laravel Pint                                                | 1.x     |
| Tooling        | Laravel Pail, Laravel Sail, Laravel Boost                   | n/a     |

## Getting Started

### Prerequisites

Install the following before you begin:

- PHP 8.3 or later with the extensions Laravel requires (CI runs on PHP 8.3, 8.4, and 8.5)
- [Composer](https://getcomposer.org/) 2.x
- Node.js 22 and npm (the version used in CI)
- A running Redis server (see [Configuration](#configuration) if you prefer not to use Redis)

### Installation

1. Clone the repository.

   ```bash
   git clone https://github.com/wildannzm/copas.git
   cd copas
   ```

2. Create the SQLite database file.

   ```bash
   touch database/database.sqlite
   ```

3. Run the setup script. It installs Composer and npm dependencies, copies `.env.example` to `.env`, generates the application key, runs migrations, and builds the frontend assets.

   ```bash
   composer run setup
   ```

4. Seed the database with the roles, demo accounts, learning path, and final quiz.

   ```bash
   php artisan db:seed
   ```

If you prefer to run each step yourself:

```bash
composer install
cp .env.example .env
php artisan key:generate
php artisan migrate --seed
npm install
npm run build
```

### Configuration

Application settings live in `.env`. The table below lists the variables you are most likely to change.

| Variable                                  | Default                | Description                                      |
| ----------------------------------------- | ---------------------- | ------------------------------------------------ |
| `APP_NAME`                                | `Laravel`              | Application name shown in the UI and emails.     |
| `APP_ENV`                                 | `local`                | Runtime environment.                             |
| `APP_DEBUG`                               | `true`                 | Set to `false` in production.                    |
| `APP_URL`                                 | `http://localhost`     | Base URL of the application.                     |
| `DB_CONNECTION`                           | `sqlite`               | Database driver.                                 |
| `SESSION_DRIVER`                          | `redis`                | Session storage backend.                         |
| `CACHE_STORE`                             | `redis`                | Cache backend.                                   |
| `QUEUE_CONNECTION`                        | `redis`                | Queue backend.                                   |
| `REDIS_CLIENT`                            | `predis`               | Redis client library.                            |
| `REDIS_HOST`, `REDIS_PORT`                | `127.0.0.1`, `6379`    | Redis connection details.                        |
| `MAIL_MAILER`                             | `log`                  | Mail transport. Emails are written to the log.   |

To run without Redis, set `SESSION_DRIVER`, `CACHE_STORE`, and `QUEUE_CONNECTION` to `database` and run `php artisan migrate`.

To use MySQL or PostgreSQL instead of SQLite, change `DB_CONNECTION` and uncomment the `DB_HOST`, `DB_PORT`, `DB_DATABASE`, `DB_USERNAME`, and `DB_PASSWORD` entries.

### Running the Application

Start the development environment with one command:

```bash
composer run dev
```

This runs four processes together: the PHP development server, a queue listener, Laravel Pail for log tailing, and the Vite dev server. The application is available at `http://localhost:8000`.

To serve the application with Octane, install a server runtime and start it:

```bash
php artisan octane:install
php artisan octane:start
```

### Demo Accounts

`php artisan db:seed` creates two accounts you can use right away. Sign in with the email or the username.

| Role    | Username | Email             | Password   |
| ------- | -------- | ----------------- | ---------- |
| Teacher | `guru`   | `guru@gmail.com`  | `guru1234` |
| Student | `siswa`  | `siswa@gmail.com` | `siswa123` |

The student belongs to the seeded class "Kelas 5A". Delete these accounts or change their passwords before you deploy to a shared or public environment.

## Available Scripts

| Command                  | Description                                                           |
| ------------------------ | --------------------------------------------------------------------- |
| `composer run setup`     | Install dependencies, prepare `.env`, migrate, and build assets.      |
| `composer run dev`       | Start the server, queue listener, log viewer, and Vite together.      |
| `composer run lint`      | Format PHP files with Pint.                                           |
| `composer run lint:check`| Check formatting without changing files.                              |
| `composer run test`      | Clear the config cache, run the lint check, then run the test suite.  |
| `npm run dev`            | Start the Vite dev server only.                                       |
| `npm run build`          | Build production assets.                                              |

## Testing

The project uses [Pest](https://pestphp.com/). The suite covers authentication, email verification, password reset, two-factor challenges, profile and security settings, and the Octane setup. GitHub Actions runs it on every push across PHP 8.3, 8.4, and 8.5. Run the full suite, including the formatting check:

```bash
composer test
```

Run the tests alone, or a single file:

```bash
php artisan test
php artisan test --filter=ExampleTest
```

## Code Style

[Laravel Pint](https://laravel.com/docs/pint) enforces the code style with the rules in `pint.json`. Format your changes before you commit:

```bash
composer lint
```

An `.editorconfig` file in the repository root sets indentation and line endings for most editors.

## Project Structure

```text
copas/
├── app/
│   ├── Livewire/   Student, Teacher, and Settings page components
│   └── Models/     User, ClassRoom, Node, Question, QuestionOption, StudentAnswer, StudentProgress
├── bootstrap/      Framework bootstrap and cache
├── config/         Configuration files
├── database/       Migrations, factories, and seeders (roles, learning path, final quiz)
├── docs/           Learning path, XP and level rules, and quiz content
├── public/         Web root and compiled assets
├── resources/      Blade views, CSS, and JavaScript
├── routes/         Route definitions
├── storage/        Logs, compiled views, and file uploads
├── tests/          Pest feature and unit tests
├── .github/        GitHub Actions workflows for tests and linting
├── .env.example    Environment variable template
├── artisan         Laravel command-line entry point
├── composer.json   PHP dependencies and scripts
├── package.json    Node dependencies and scripts
├── phpunit.xml     Test runner configuration
├── pint.json       Code style rules
└── vite.config.js  Vite build configuration
```

## License

Copas is released under the [MIT License](LICENSE).
