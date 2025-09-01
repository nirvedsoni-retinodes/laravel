# 🚀 Laravel Booking Platform with Installation Wizard

A **complete, production-ready** sports facility booking platform built with Laravel 10, featuring a **beautiful GUI installation wizard** that makes setup effortless on XAMPP, localhost, or any web server.

## ✨ **Key Features**

### 🎯 **Core Booking System**
- **Smart Venue Management** - Create and manage sports venues
- **Facility Booking** - Book sports facilities with conflict prevention
- **Role-Based Access** - Player, Manager, and Admin roles
- **Atomic Booking Logic** - Prevents overlapping bookings automatically
- **ULID Booking Codes** - Unique, sortable identifiers

### 💳 **Payment & Notifications**
- **Razorpay Integration** - Complete payment processing
- **WhatsApp Notifications** - Automated booking confirmations
- **PDF Invoice Generation** - Professional invoices for bookings
- **Payment Status Tracking** - Real-time payment updates

### 👨‍💼 **Admin Features**
- **Manual Booking Creation** - Admins can book for any user
- **Payment Management** - Mark bookings as paid/unpaid
- **User Administration** - Complete user management system
- **Demo Data Seeding** - Ready-to-use sample data

### 🌍 **Technical Features**
- **Timezone Support** - UTC storage, Asia/Kolkata display
- **Responsive Design** - Works on all devices
- **Modern UI** - Built with Tailwind CSS and FontAwesome
- **API Ready** - RESTful API with Laravel Sanctum

---

## 🎯 **Installation Methods**

### **Method 1: XAMPP Installation (Recommended)**
1. **Install XAMPP** with PHP 8.1+
2. **Extract** the application to `htdocs/laravel-booking-platform/`
3. **Access** `http://localhost/laravel-booking-platform/install`
4. **Follow** the installation wizard

### **Method 2: Manual Installation**
1. **Setup web server** pointing to project directory
2. **Run** `composer install`
3. **Copy** `.env.example` to `.env`
4. **Run** `php artisan migrate:fresh --seed`

---

## 🚀 **Quick Start with XAMPP**

### **Step 1: Download & Install XAMPP**
- Download from [https://www.apachefriends.org/](https://www.apachefriends.org/)
- Choose version with **PHP 8.1 or higher**
- Install and start Apache + MySQL services

### **Step 2: Setup Application**
```bash
# Extract to XAMPP htdocs
C:\xampp\htdocs\laravel-booking-platform\

# Or on Linux/Mac
/opt/lampp/htdocs/laravel-booking-platform/
```

### **Step 3: Run Installation Wizard**
1. Open browser: `http://localhost/laravel-booking-platform/install`
2. Follow the 4-step wizard:
   - ✅ **System Requirements Check**
   - 🗄️ **Database Configuration**
   - 👤 **Admin Account Setup**
   - 🎉 **Installation Complete**

### **Step 4: Access Your Platform**
- **Main App**: `http://localhost/laravel-booking-platform`
- **Admin Login**: Use credentials from installation

---

## 🔧 **System Requirements**

### **Minimum Requirements**
- **PHP**: 8.1 or higher
- **MySQL**: 5.7 or higher (8.0+ recommended)
- **Web Server**: Apache/Nginx
- **Memory**: 512MB RAM
- **Disk Space**: 100MB free space

### **Required PHP Extensions**
- BCMath, Ctype, JSON, Mbstring
- OpenSSL, PDO, Tokenizer, XML
- cURL, GD, fileinfo, zip

---

## 🎯 **Ready to Start?**

1. **Download** the Laravel Booking Platform
2. **Install XAMPP** with PHP 8.1+
3. **Extract** to htdocs folder
4. **Access** the installation wizard
5. **Follow** the simple setup steps
6. **Enjoy** your new booking platform!

---

**🎉 Your Laravel Booking Platform is just a few clicks away from being fully operational!**

The installation wizard makes setup so simple that anyone can have a professional sports facility booking platform running in minutes.

**No Docker, no complex commands, just a beautiful GUI wizard that does everything for you!** 🚀
