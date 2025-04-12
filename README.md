# 💸 Commission Fee Calculator

This is a simple PHP console application for calculating commission fees from financial operations. The application reads a CSV file containing operations (deposits or withdrawals), processes each operation based on the provided business rules, and returns the commission fee per operation.

## 📦 Features

- PSR-4 autoloading via Composer
- Clean and maintainable architecture: Command, Service, Entity
- Uses Symfony Console for CLI interface
- PSR-12 code style enforced
- Supports multiple currencies with real-time exchange rates
- Customizable and extensible without modifying the core logic
- Includes automated PHPUnit test

---

## 🛠️ Installation

1. Clone the repository:

```bash
git clone https://github.com/BrahimAZOUGAGH/commission-fee-app.git
cd commission-fee-app
```

2. Install dependencies:

```bash
composer install
```

---

## 🚀 Usage

Run the app using the following command:

```bash
php bin/console commission:process path/to/input.csv
```

Example:

```bash
php bin/console commission:process data/input.csv
```

The app will output the commission fees line by line.

---

## 🧪 Run Tests

The project includes one automation test as required. To run tests:

```bash
composer test
```

Or directly:

```bash
vendor/bin/phpunit
```

---

## 🧼 Code Style

PSR-12 is enforced using PHP-CS-Fixer.

To check code style:

```bash
composer test-cs
```

To fix code style automatically:

```bash
composer fix-cs
```

---

## 🧠 Architecture

- **Entity/Operation**: Represents a financial operation.
- **Service/CommissionCalculator**: Main service for calculating fees.
- **Service/ExchangeRateProvider**: Handles exchange rates via external API.
- **Command/CalculateCommissionCommand**: CLI command for processing the CSV.
- **Tests/**: Includes a basic test for calculation logic.

---

## 🔄 Extensibility

- Add new currencies without touching core logic.
- Business logic is modular and separated.
- Exchange rate service can be swapped easily.

---

## 🔒 Requirements

- PHP 8.1+
- Composer
- No external infrastructure like DB or temp files used.

---

## 📝 License

This project is for educational and assessment purposes only and is not affiliated with any financial institution.