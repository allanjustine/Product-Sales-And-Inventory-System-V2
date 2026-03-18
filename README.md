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

### 🔐 Authentication
- Manual login with email & password
- User registration (create account)
- Social login via **Google** and **Facebook** (OAuth 2.0 via Laravel Socialite)
- Secure session management

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

## 🔑 Authentication Flow

```text
Login Page
    ├── Manual Login (Email + Password)
    ├── Register (Create Account)
    ├── Login with Google  → OAuth → Redirect → Dashboard
    └── Login with Facebook → OAuth → Redirect → Dashboard
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

# Install Laravel Socialite
composer require laravel/socialite

# Setup environment
cp .env.example .env
php artisan key:generate

# Configure database, Pusher, Google & Facebook credentials in .env

# Run migrations
php artisan migrate

# Start development server
php artisan serve
npm run dev
```

---

## 🌐 Social Login Setup

Add the following to your `.env` file:

```env
GOOGLE_CLIENT_ID=your-google-client-id
GOOGLE_CLIENT_SECRET=your-google-client-secret
GOOGLE_REDIRECT_URI=http://localhost:8000/auth/google/callback

FACEBOOK_CLIENT_ID=your-facebook-app-id
FACEBOOK_CLIENT_SECRET=your-facebook-app-secret
FACEBOOK_REDIRECT_URI=http://localhost:8000/auth/facebook/callback
```

> Get Google credentials from [Google Cloud Console](https://console.cloud.google.com/)  
> Get Facebook credentials from [Meta for Developers](https://developers.facebook.com/)

---

## 🔐 Security

- CSRF Protection
- Input Validation
- Secure Authentication (Manual + OAuth)
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
