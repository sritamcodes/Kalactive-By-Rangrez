# Kalaktive-By-Rangrez

# KALACTIVE — A CURATION BY RANGREZ

> A contemporary e-commerce experience inspired by the royal heritage, craftsmanship, and visual culture of Rajasthan.

KALACTIVE is a full-stack e-commerce platform built for selling curated home-decor products with a distinctive Rajasthani royal and vintage-inspired identity.

The project combines a premium editorial storefront with a functional seller/admin system, customer authentication, cart and wishlist functionality, checkout, order management, inventory management, and a real-time seller dashboard.

---

## ✨ Highlights

- 🏛️ Royal Rajasthani + vintage-inspired design
- 🛍️ Product browsing and product details
- 🛒 Session-based shopping cart
- ❤️ Wishlist functionality
- 👤 Customer registration and login
- 🔐 Role-based customer/admin authentication
- 👑 Admin panel for sellers
- 📦 Product and inventory management
- 🧾 Order management
- 💳 Multiple payment-method selection
- 📊 Database-driven seller dashboard
- ⚡ Near-real-time dashboard updates
- 📱 Responsive mobile experience
- 🎥 Cinematic desktop hero video
- 🖼️ Mobile-optimized hero image
- 🐳 Docker-ready deployment
- 🗄️ MySQL + PDO backend

---

## 🎨 Design Philosophy

KALACTIVE is designed to bridge two generations.

The visual language combines:

**Rajasthani Royalty × Vintage Editorial × Contemporary Luxury**

Instead of using traditional motifs excessively, the interface uses them selectively through:

- Warm earthy tones
- Aged ivory and parchment surfaces
- Terracotta accents
- Deep charcoal typography
- Subtle antique-brass details
- Editorial typography
- Generous whitespace
- Cinematic imagery
- Smooth micro-interactions

The goal is to make the platform feel familiar to older audiences while remaining visually engaging for Gen Z.

---

## 🛍️ Customer Features

### Authentication

Customers can:

- Register
- Login
- Logout
- Maintain an authenticated session

Checkout is protected and requires customer authentication.

### Product Discovery

Customers can:

- Browse products
- View product details
- Explore categories
- View product availability
- Add products to cart
- Add/remove wishlist items

### Shopping Cart

The cart supports:

- Add product
- Update quantity
- Remove product
- Automatic totals
- Stock validation
- Server-side validation

### Checkout

Checkout includes:

- Customer information
- Order summary
- Payment method selection
- Order validation
- Stock validation
- Order creation

Available payment methods:

- Cash on Delivery
- UPI
- Credit/Debit Card
- Net Banking

> Payment methods are implemented as a demo checkout flow unless a live payment gateway is configured.

Sensitive payment information such as card numbers and CVV values is not stored.

### Order Success

After a successful checkout, customers receive an order confirmation containing relevant order and payment information.

---

# 👑 Seller / Admin System

KALACTIVE treats the admin as the **seller/store owner**.

The seller has a dedicated administration panel.

## Admin Login

Admins authenticate using:

- Email
- Password
- Admin role

Authentication uses the existing MySQL `users` table and password hashing.

Multiple admin accounts are supported.

Customers cannot access protected admin pages.

---

## 📊 Seller Dashboard

The seller dashboard provides database-driven store information including:

- Total Revenue
- Total Orders
- Total Products
- Total Customers
- Recent Orders
- Top Products
- Low Stock Products
- Order Status
- Payment Status

The dashboard uses periodic background requests to refresh current information without requiring a complete page reload.

### Dashboard Architecture

```text
MySQL
   ↓
dashboard-data.php
   ↓
PHP / PDO
   ↓
JavaScript fetch()
   ↓
Seller Dashboard