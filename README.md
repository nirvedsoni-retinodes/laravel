# Laravel Booking Platform

A complete, production-ready sports facility booking platform built with Laravel 11, PHP 8.3, and MySQL 8.

## Features

- **Role-based Access Control**: Player, Manager, and Admin roles
- **Venue & Facility Management**: Complete CRUD operations for venues and facilities
- **Smart Booking System**: Atomic booking creation with availability checking
- **Payment Integration**: Full Razorpay integration with webhook verification
- **WhatsApp Notifications**: Automated notifications via WhatsApp Cloud API
- **Admin Manual Bookings**: Admins can create bookings on behalf of users
- **Invoice Generation**: PDF invoices for successful bookings
- **Timezone Support**: UTC storage with Asia/Kolkata display
- **ULID Booking Codes**: Unique, sortable booking identifiers

## Tech Stack

- **Backend**: Laravel 11, PHP 8.3
- **Database**: MySQL 8
- **Cache**: Redis
- **Frontend**: Blade templates with Tailwind CSS, Livewire 3
- **Authentication**: Laravel Sanctum
- **Permissions**: Spatie Laravel Permission
- **Payments**: Razorpay
- **Notifications**: WhatsApp Cloud API
- **PDF**: DomPDF
- **Testing**: Pest PHP

## Quick Start

### Prerequisites

- Docker and Docker Compose
- Make (optional, but recommended)

### Installation

1. **Clone the repository**
   ```bash
   git clone <repository-url>
   cd laravel-booking-platform
   ```

2. **Start the application**
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

3. **Access the application**
   - **Main App**: http://localhost:8080
   - **phpMyAdmin**: http://localhost:8081
   - **Mailpit**: http://localhost:8025

### Demo Credentials

| Role | Email | Password |
|------|-------|----------|
| Admin | admin@example.com | password |
| Manager | manager@example.com | password |
| Player | player@example.com | password |

## Configuration

### Environment Variables

Copy `.env.example` to `.env` and configure:

```bash
# Razorpay Configuration
RAZORPAY_KEY_ID=your_razorpay_key_id
RAZORPAY_KEY_SECRET=your_razorpay_key_secret
RAZORPAY_WEBHOOK_SECRET=your_webhook_secret

# WhatsApp Cloud API Configuration
WHATSAPP_TOKEN=your_whatsapp_token
WHATSAPP_PHONE_NUMBER_ID=your_phone_number_id
WHATSAPP_VERIFY_TOKEN=your_verify_token
```

### Database Configuration

The application uses MySQL 8 with the following default credentials:
- Database: `laravel_booking`
- Username: `laravel_user`
- Password: `password`
- Root Password: `root`

## API Endpoints

### Public Endpoints

- `GET /api/venues` - List all venues
- `GET /api/venues/{id}` - Get venue details
- `GET /api/facilities` - List all facilities
- `GET /api/facilities/{id}` - Get facility details
- `GET /api/facilities/{id}/availability` - Check facility availability

### Protected Endpoints

- `GET /api/bookings` - List user's bookings
- `POST /api/bookings` - Create new booking
- `GET /api/bookings/{id}` - Get booking details
- `PUT /api/bookings/{id}` - Update booking
- `DELETE /api/bookings/{id}` - Cancel booking
- `POST /api/bookings/{id}/payment/initiate` - Initiate payment

### Webhook Endpoints

- `POST /api/webhooks/razorpay` - Razorpay payment webhook

## Database Schema

### Core Tables

- **users**: User accounts with role-based permissions
- **venues**: Sports venues managed by managers
- **facilities**: Individual sports facilities within venues
- **schedules**: Operating hours for each facility
- **bookings**: Booking records with payment status

### Key Relationships

- Users can have multiple roles (player, manager, admin)
- Venues have one manager and multiple facilities
- Facilities belong to venues and have schedules
- Bookings link users to facilities with time slots

## Business Logic

### Availability Checking

The system implements atomic booking creation to prevent overlapping bookings:

1. **Operating Hours Check**: Verifies requested time is within facility schedule
2. **Conflict Detection**: Database-level checking for overlapping time slots
3. **Transaction Safety**: All operations wrapped in database transactions

### Payment Flow

1. **Order Creation**: Razorpay order created when payment initiated
2. **Payment Processing**: User completes payment on Razorpay
3. **Webhook Verification**: Payment verified via webhook signature
4. **Status Update**: Booking status updated to confirmed
5. **Notification**: WhatsApp confirmation sent to user

## Testing

Run the test suite:

```bash
make test
```

Or manually:

```bash
docker-compose exec app php artisan test
```

## Development

### Available Commands

- `make up` - Start the entire application
- `make down` - Stop all containers
- `make build` - Rebuild containers
- `make install` - Install dependencies
- `make migrate` - Run migrations
- `make seed` - Seed database
- `make test` - Run tests
- `make clean` - Clean up containers and volumes

### Code Quality

- **Linting**: Laravel Pint for code formatting
- **Static Analysis**: Larastan for PHP analysis
- **Testing**: Pest PHP for testing

## Deployment

### Production Considerations

1. **Environment Variables**: Set production values for all services
2. **Database**: Use production MySQL instance
3. **Redis**: Configure production Redis cluster
4. **SSL**: Enable HTTPS for production
5. **Monitoring**: Set up application monitoring
6. **Backups**: Configure database backups

### Docker Production

For production deployment, consider:
- Using multi-stage Docker builds
- Implementing health checks
- Setting up proper logging
- Configuring resource limits
- Using production-grade images

## Contributing

1. Fork the repository
2. Create a feature branch
3. Make your changes
4. Add tests for new functionality
5. Ensure all tests pass
6. Submit a pull request

## License

This project is licensed under the MIT License.

## Support

For support and questions, please open an issue in the repository.
