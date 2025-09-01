# 🚀 Laravel Booking Platform - COMPLETE & READY TO RUN

## ✅ What's Built

A complete, production-ready sports facility booking platform with:

### 🏗️ Core Features
- **Role-based Access Control**: Player, Manager, Admin roles with Spatie Laravel Permission
- **Venue & Facility Management**: Complete CRUD operations
- **Smart Booking System**: Atomic booking creation preventing overlapping bookings
- **Payment Integration**: Full Razorpay integration with webhook verification
- **WhatsApp Notifications**: Automated booking confirmations via WhatsApp Cloud API
- **Admin Manual Bookings**: Admins can create bookings on behalf of users
- **Invoice Generation**: PDF invoices using DomPDF
- **ULID Booking Codes**: Unique, sortable identifiers
- **Timezone Support**: UTC storage, Asia/Kolkata display

### 🛠️ Tech Stack
- **Laravel 11** + **PHP 8.3**
- **MySQL 8** + **Redis**
- **Livewire 3** + **Tailwind CSS**
- **Laravel Sanctum** API
- **Docker & Docker Compose**
- **Nginx** web server
- **phpMyAdmin** for database management
- **Mailpit** for email testing

### 📦 Development Tools
- **Pest PHP** for testing
- **Laravel Pint** for code formatting
- **Larastan** for static analysis
- **GitHub Actions** CI/CD
- **OpenAPI** specification
- **Postman** collection

## 🚀 Quick Start

### 1. Start the Application
```bash
make up
```

This single command will:
- Build and start all Docker containers
- Install PHP dependencies
- Run database migrations
- Seed demo data
- Create storage links
- Start queue workers and scheduler

### 2. Access the Application
- **Main App**: http://localhost:8080
- **phpMyAdmin**: http://localhost:8081 (user: root, password: root)
- **Mailpit**: http://localhost:8025

### 3. Demo Credentials
| Role | Email | Password |
|------|-------|----------|
| Admin | admin@example.com | password |
| Manager | manager@example.com | password |
| Player | player@example.com | password |

## 📋 Available Commands

- `make up` - Start the entire application
- `make down` - Stop all containers
- `make build` - Rebuild containers
- `make test` - Run tests
- `make clean` - Clean up containers and volumes

## 🔧 Configuration

Edit `.env` file for:
- Razorpay API keys
- WhatsApp Cloud API credentials
- Database settings
- Email settings

## 📚 Documentation

- **API Documentation**: `openapi.yaml`
- **Postman Collection**: `postman_collection.json`
- **Database Schema**: See migration files in `database/migrations/`

## 🧪 Testing

The platform includes comprehensive tests:
```bash
make test
```

## 🎯 Key Features Implemented

### For Players
- Register and login
- Browse venues and facilities
- Check availability
- Create bookings
- Make payments via Razorpay
- Receive WhatsApp notifications
- Download invoices

### For Managers
- Manage venues
- Manage facilities
- View bookings for their venues
- Set operating schedules

### For Admins
- Complete system management
- Create bookings on behalf of users
- Mark bookings as paid/unpaid
- View reports and analytics
- Manage users and roles

## 🔒 Security Features
- Role-based permissions
- CSRF protection
- SQL injection prevention
- XSS protection
- Rate limiting
- Secure password hashing

## 📱 API Features
- RESTful API with Sanctum authentication
- Comprehensive endpoint coverage
- Webhook support for Razorpay
- OpenAPI 3.0 specification
- Postman collection for testing

## 🚀 Production Ready
- Docker containerization
- Environment-based configuration
- Database migrations and seeders
- Queue workers for background jobs
- Comprehensive error handling
- Logging and monitoring ready
- CI/CD pipeline with GitHub Actions

## 📝 Next Steps

1. Configure your Razorpay API keys in `.env`
2. Set up WhatsApp Cloud API credentials
3. Customize the UI/branding as needed
4. Deploy to your production environment
5. Set up monitoring and backups

**The application is fully functional and ready for immediate use-la* 🎉
