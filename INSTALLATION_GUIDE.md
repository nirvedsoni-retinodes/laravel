# 🚀 Laravel Booking Platform - Installation Guide

## 📋 **Prerequisites**

Before installing the Laravel Booking Platform, ensure you have:

### **System Requirements**
- **PHP**: 8.1 or higher
- **MySQL**: 5.7 or higher (8.0+ recommended)
- **Web Server**: Apache/Nginx (XAMPP includes Apache)
- **Memory**: Minimum 512MB RAM
- **Disk Space**: At least 100MB free space

### **Required PHP Extensions**
- BCMath, Ctype, JSON, Mbstring
- OpenSSL, PDO, Tokenizer, XML
- cURL, GD, fileinfo, zip

---

## 🎯 **Installation Methods**

### **Method 1: XAMPP Installation (Recommended for Beginners)**

#### **Step 1: Install XAMPP**
1. Download XAMPP from [https://www.apachefriends.org/](https://www.apachefriends.org/)
2. Choose the version with PHP 8.1+ (latest version recommended)
3. Install XAMPP following the installation wizard
4. Start Apache and MySQL services

#### **Step 2: Download the Application**
1. Download the Laravel Booking Platform ZIP file
2. Extract it to your XAMPP htdocs folder:
   ```
   C:\xampp\htdocs\laravel-booking-platform\
   ```
   (Windows) or
   ```
   /opt/lampp/htdocs/laravel-booking-platform/
   ```
   (Linux/Mac)

#### **Step 3: Access the Installation Wizard**
1. Open your web browser
2. Navigate to: `http://localhost/laravel-booking-platform/install`
3. The installation wizard will automatically start

---

## 🔧 **Installation Wizard Steps**

### **Step 1: System Requirements Check**
The wizard will automatically check:
- ✅ PHP version compatibility
- ✅ Required PHP extensions
- ✅ Directory permissions
- ✅ System resources

### **Step 2: Database Configuration**
**For XAMPP users, use these settings:**
- **Host**: `localhost` or `127.0.0.1`
- **Port**: `3306`
- **Database**: `laravel_booking` (will be created automatically)
- **Username**: `root`
- **Password**: (leave empty for XAMPP default)

### **Step 3: Admin Account Setup**
- **Site Name**: Your platform name
- **Site URL**: Your website URL (e.g., `http://localhost/laravel-booking-platform`)
- **Admin Name**: Your full name
- **Admin Email**: Your email address
- **Admin Password**: Secure password (minimum 8 characters)

### **Step 4: Installation Complete**
- ✅ Database tables created
- ✅ Demo data seeded
- ✅ Admin account created
- ✅ System configured

---

## 🚀 **Post-Installation Setup**

### **1. Access Your Application**
- **Main URL**: `http://localhost/laravel-booking-platform`
- **Admin Login**: Use the credentials you created during installation

### **2. Demo Accounts Available**
| Role | Email | Password |
|------|-------|----------|
| **Admin** | admin@example.com | password |
| **Manager** | manager@example.com | password |
| **Player** | player@example.com | password |

---

## 🎉 **Installation Complete!**

Once installation is complete, you will have:
- ✅ **Complete booking platform** with all features
- ✅ **Admin dashboard** for managing the system
- ✅ **Demo data** to explore functionality
- ✅ **User management** system
- ✅ **Venue and facility management**
- ✅ **Booking system** with conflict prevention
- ✅ **Payment integration** ready for Razorpay
- ✅ **WhatsApp notifications** ready for configuration

**Your Laravel Booking Platform is now ready to use!** 🚀
