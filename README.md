# 📦 Inventory & Financial Reporting System

A Laravel 12-based inventory and accounting system with clean UI using Bootstrap 5.

---

## 🚀 Features

### ✅ Inventory Module
- Product Entry (CRUD)
- Opening Stock & Real-time Stock Updates

### ✅ Sales Module
- Sale with Discount & VAT (5%)
- Stock Auto-Deduction
- Calculates Total, Received & Due
- Journal auto-entry (Sales, VAT, Discount, Cash, Due)

### ✅ Accounting Journal
- Auto-generated journal entries for each sale
- Tracks Sales, Cash, VAT, Discount & Due separately

### ✅ Financial Reporting
- Filter by date range
- View total sales, VAT, discount, due
- View estimated profit

### ✅ Dashboard Summary
- Total products & stock
- This month's sales, due & received
- Profit summary

---

## ⚙️ Tech Stack

- Laravel 12 (Backend)
- Laravel Breeze (Authentication)
- Bootstrap 5 (Frontend UI)
- MySQL (Database)
- jQuery (optional AJAX usage)

---

## 📦 Installation

```bash
git clone https://github.com/your-username/inventory-system.git
cd inventory-system
cp .env.example .env
php artisan key:generate

➡ Set your database credentials in .env:
DB_DATABASE=your_db
DB_USERNAME=root
DB_PASSWORD=

➡ Migrate tables:
php artisan migrate

➡ Compile assets:

npm install
npm run dev

➡ Start server:
php artisan serve

🔐 Auth Credentials

Register from /register
Login from /login

📊 Reports

/dashboard – summary overview
/reports – full financial report with filters

👨‍💻 Author
Rayhan Ali