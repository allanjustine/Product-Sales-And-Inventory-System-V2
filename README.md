# 🛒 Product Sales and Inventory System

A modern **Real-Time Product Sales and Inventory Management System** designed to streamline sales operations, inventory tracking, and order monitoring.

Built using:
- Laravel
- Livewire
- Pusher (for real-time communication)

---

## 🚀 Tech Stack

- **Backend:** Laravel  
- **Frontend:** Livewire  
- **Real-Time Communication:** Pusher  

---

## ✨ Features

### 📦 Inventory Management
- Add, edit, and delete products
- Categorize products
- Track stock levels
- Low stock alerts
- Automatic stock deduction when orders are placed

### 🧾 Sales Management
- Create and manage orders
- View order history
- Generate invoices
- Track sales performance

### 🔄 Real-Time Order Tracking
- Orders update instantly across all users
- Live stock updates
- Real-time dashboard refresh
- No page reload required

### 📊 Dashboard & Reports
- Daily, weekly, and monthly sales reports
- Revenue analytics
- Inventory summaries
- Best-selling products tracking

### 👥 User Management
- Role-based access control (Admin / Staff)
- Secure authentication
- Permission management

---

## ⚡ How Real-Time Works

```text
User Action
    ↓
Laravel Backend
    ↓
Database Update
    ↓
Broadcast Event
    ↓
Pusher Channel
    ↓
Livewire Updates UI in Real-Time
```

---

## 🛠️ Installation Guide

```bash
# Clone repository
git clone https://github.com/allanjustine/Product-Sales-And-Inventory-System-V2.git

# Navigate into project
cd Product-Sales-And-Inventory-System-V2

# Install dependencies
composer install
npm install

# Setup environment
cp .env.example .env
php artisan key:generate

# Configure database & Pusher credentials in .env

# Run migrations
php artisan migrate

# Start development server
php artisan serve
npm run dev
```

---

## 🔐 Security

- CSRF Protection
- Input Validation
- Secure Authentication
- Role-Based Authorization
- Broadcast Channel Authorization

---

## 📈 Use Cases

- Retail stores
- Wholesale businesses
- Warehouses
- SMEs
- Multi-branch operations

---

## 📬 Contact

Email: labya31@gmail.com 
Portfolio: https://allanjustine.github.io/Portfolio/
Website: https://e-commerce.smctgroup.ph  

---

### 🌟 Built with Laravel + Livewire + Pusher for powerful real-time performance.
