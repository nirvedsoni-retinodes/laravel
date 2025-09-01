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

## 📋 **Installation Wizard Steps**

### **Step 1: Requirements Check**
The wizard automatically verifies:
- ✅ PHP version compatibility
- ✅ Required extensions
- ✅ Directory permissions
- ✅ System resources

### **Step 2: Database Setup**
**XAMPP Default Settings:**
- **Host**: `localhost`
- **Port**: `3306`
- **Username**: `root`
- **Password**: (leave empty)
- **Database**: `laravel_booking` (auto-created)

### **Step 3: Admin Configuration**
- **Site Name**: Your platform name
- **Site URL**: Your website URL
- **Admin Account**: Full system access credentials

### **Step 4: Completion**
- ✅ Database tables created
- ✅ Demo data seeded
- ✅ Admin account created
- ✅ System ready to use

---

## 👤 **Demo Accounts**

After installation, these accounts are available:

| Role | Email | Password | Access |
|------|-------|----------|---------|
| **Admin** | admin@example.com | password | Full System Access |
| **Manager** | manager@example.com | password | Venue Management |
| **Player** | player@example.com | password | Booking Access |

---

## 🛠️ **Post-Installation Setup**

### **1. Configure External APIs**
Edit `.env` file to add:
```bash
# Razorpay Payment Gateway
RAZORPAY_KEY_ID=your_razorpay_key_id
RAZORPAY_KEY_SECRET=your_razorpay_key_secret
RAZORPAY_WEBHOOK_SECRET=your_webhook_secret

# WhatsApp Cloud API
WHATSAPP_TOKEN=your_whatsapp_token
WHATSAPP_PHONE_NUMBER_ID=your_phone_number_id
WHATSAPP_VERIFY_TOKEN=your_verify_token
```

### **2. Customize Platform**
- Modify site settings in admin panel
- Add your venues and facilities
- Configure operating schedules
- Set up payment methods

---

## 🐛 **Troubleshooting**

### **Common Issues**

#### **"Class not found" Error**
```bash
# Solution: Install dependencies
composer install
```

#### **Database Connection Failed**
- Check if MySQL is running in XAMPP
- Verify database credentials
- Ensure port 3306 is not blocked

#### **Permission Errors**
```bash
# Set proper permissions
chmod -R 755 storage bootstrap/cache
```

#### **PHP Version Too Low**
- Update XAMPP to latest version
- Check PHP version in XAMPP Control Panel

---

## 🔒 **Security Features**

- **CSRF Protection** on all forms
- **SQL Injection Prevention** with Eloquent ORM
- **XSS Protection** with Blade templating
- **Role-Based Access Control** with granular permissions
- **Input Validation** on all user inputs
- **Secure Password Hashing**

---

## 📱 **Responsive Design**

The platform is fully responsive and works on:
- 🖥️ **Desktop computers**
- 💻 **Laptops**
- 📱 **Tablets**
- 📱 **Mobile phones**

Built with **Tailwind CSS** for modern, beautiful UI.

---

## 🚀 **Production Deployment**

### **Environment Setup**
```bash
APP_ENV=production
APP_DEBUG=false
APP_URL=https://yourdomain.com
```

### **Security Measures**
- Change default passwords immediately
- Use HTTPS in production
- Regular database backups
- Keep dependencies updated

---

## 📚 **Documentation**

- **📖 Installation Guide**: `INSTALLATION_GUIDE.md`
- **🔧 Configuration**: See `.env.example`
- **🌐 API Documentation**: Built-in API endpoints
- **📱 User Manual**: Available in admin panel

---

## 🎉 **What You Get**

### **Complete Application**
- ✅ **Full booking platform** with all features
- ✅ **Beautiful installation wizard** for easy setup
- ✅ **Demo data** to explore functionality
- ✅ **Admin dashboard** for system management
- ✅ **User management** system
- ✅ **Venue and facility management**
- ✅ **Smart booking system** with conflict prevention
- ✅ **Payment integration** ready for Razorpay
- ✅ **WhatsApp notifications** ready for configuration
- ✅ **Responsive design** for all devices

### **No Docker Required**
- ✅ **Traditional web server** installation
- ✅ **XAMPP compatible** out of the box
- ✅ **Easy deployment** on any hosting
- ✅ **Familiar setup** for developers

---

## 🏆 **Why Choose This Platform?**

1. **🎯 Complete Solution** - Everything you need for sports facility booking
2. **🚀 Easy Installation** - Beautiful GUI wizard, no command line needed
3. **🔧 XAMPP Ready** - Works perfectly with XAMPP for local development
4. **📱 Responsive Design** - Works on all devices and screen sizes
5. **🔒 Production Ready** - Secure, tested, and ready for deployment
6. **💳 Payment Ready** - Razorpay integration included
7. **📱 Notification Ready** - WhatsApp integration included
8. **🎨 Beautiful UI** - Modern design with Tailwind CSS

---

## 📞 **Support**

### **Getting Help**
1. **Check troubleshooting** section above
2. **Verify system requirements**
3. **Review installation guide**
4. **Check XAMPP error logs**
5. **Review Laravel logs** in `storage/logs/`

### **Common Solutions**
- **PHP version**: Update XAMPP to latest
- **Extensions**: Enable in php.ini
- **Permissions**: Set proper folder permissions
- **Database**: Check MySQL service status

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