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
- BCMath
- Ctype
- JSON
- Mbstring
- OpenSSL
- PDO
- Tokenizer
- XML
- cURL
- GD
- fileinfo
- zip

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

### **Method 2: Manual Installation**

#### **Step 1: Setup Web Server**
1. Configure your web server (Apache/Nginx) to point to the project directory
2. Ensure the web server has read/write permissions to the project folder

#### **Step 2: Install Dependencies**
```bash
cd /path/to/laravel-booking-platform
composer install
```

#### **Step 3: Environment Setup**
```bash
cp .env.example .env
php artisan key:generate
```

#### **Step 4: Database Setup**
```bash
php artisan migrate:fresh --seed
```

---

## 🔧 **Installation Wizard Steps**

### **Step 1: System Requirements Check**
The wizard will automatically check:
- ✅ PHP version compatibility
- ✅ Required PHP extensions
- ✅ Directory permissions
- ✅ System resources

**If requirements are not met:**
- Update PHP to 8.1+ in XAMPP
- Enable required extensions in php.ini
- Set proper directory permissions (755 for folders, 644 for files)

### **Step 2: Database Configuration**
**For XAMPP users, use these settings:**
- **Host**: `localhost` or `127.0.0.1`
- **Port**: `3306`
- **Database**: `laravel_booking` (will be created automatically)
- **Username**: `root`
- **Password**: (leave empty for XAMPP default)

**For other setups:**
- Use your MySQL server details
- Ensure the user has CREATE DATABASE privileges

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

### **3. Configure External Services**
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

---

## 🐛 **Troubleshooting**

### **Common Issues & Solutions**

#### **1. "Class not found" Error**
**Solution**: Install Composer dependencies
```bash
cd /path/to/laravel-booking-platform
composer install
```

#### **2. Database Connection Failed**
**Solutions**:
- Check if MySQL is running in XAMPP
- Verify database credentials
- Ensure MySQL port 3306 is not blocked
- Check firewall settings

#### **3. Permission Denied Errors**
**Solutions**:
- Set directory permissions: `chmod -R 755 storage bootstrap/cache`
- On Windows: Right-click folder → Properties → Security → Edit permissions
- Ensure web server user has write access

#### **4. PHP Version Too Low**
**Solutions**:
- Update XAMPP to latest version
- Check PHP version in XAMPP Control Panel
- Verify php.ini settings

#### **5. Extensions Missing**
**Solutions**:
- Open XAMPP Control Panel → Apache → Config → php.ini
- Uncomment required extensions (remove semicolon)
- Restart Apache service

---

## 🔒 **Security Considerations**

### **Production Deployment**
1. **Change default passwords** immediately
2. **Set APP_ENV=production** in .env
3. **Disable APP_DEBUG** in production
4. **Use HTTPS** for production sites
5. **Regular backups** of database and files
6. **Keep dependencies updated**

### **File Permissions**
```bash
# Secure permissions for production
chmod -R 755 storage bootstrap/cache
chmod -R 644 .env
chmod -R 644 storage/logs/*
```

---

## 📚 **Additional Resources**

### **XAMPP Resources**
- [XAMPP Official Documentation](https://www.apachefriends.org/docs.html)
- [PHP Configuration Guide](https://www.apachefriends.org/docs/php-configuration.html)
- [MySQL Configuration](https://www.apachefriends.org/docs/mysql-configuration.html)

### **Laravel Resources**
- [Laravel Official Documentation](https://laravel.com/docs)
- [Laravel Installation Guide](https://laravel.com/docs/installation)
- [Laravel Troubleshooting](https://laravel.com/docs/troubleshooting)

---

## 🎉 **Installation Complete!**

Once installation is complete, you'll have:
- ✅ **Complete booking platform** with all features
- ✅ **Admin dashboard** for managing the system
- ✅ **Demo data** to explore functionality
- ✅ **User management** system
- ✅ **Venue and facility management**
- ✅ **Booking system** with conflict prevention
- ✅ **Payment integration** ready for Razorpay
- ✅ **WhatsApp notifications** ready for configuration

**Your Laravel Booking Platform is now ready to use!** 🚀

---

## 📞 **Support**

If you encounter any issues:
1. Check the troubleshooting section above
2. Verify system requirements
3. Check XAMPP error logs
4. Review Laravel logs in `storage/logs/`
5. Ensure all prerequisites are met

**Happy Booking!** 🎯