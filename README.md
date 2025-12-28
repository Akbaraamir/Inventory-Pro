 📦 Inventory Management System

A robust Laravel-based inventory management application featuring real-time stock adjustments, category organization, and a data-driven dashboard.

## 🚀 Key Features
- **Product Management:** Complete CRUD operations with search and category filtering.
- **Atomic Stock Adjustments:** Quick "+" and "-" buttons with safety logic to prevent negative stock.
- **Category System:** One-to-Many relationship allowing organized product classification.
- **Smart Dashboard:** Visual analytics using Chart.js (Doughnut Chart) showing category distribution.
- **Stock Alerts:** Automated visual badges for "Low Stock" and "Out of Stock" items.
- **Authentication:** Secure user access powered by Laravel Breeze.

## 🛠️ Tech Stack
- **Framework:** Laravel 11
- **Styling:** Tailwind CSS
- **Interactivity:** Alpine.js & Chart.js
- **Database:** MySQL / SQLite

## 📈 Business Logic
The application calculates total inventory value using the following logic:
$$Total Value = \sum_{i=1}^{n} (Price_i \times Quantity_i)$$

## 📥 Installation & Setup

1. **Clone the repository:**
   ```bash
   git clone [https://github.com/akbaraamir/inventory-pro.git](https://github.com/akbaraamir/inventory-pro.git)
   cd inventory-pro
