# ☕ Samnang Coffee - Management System

A modern, full-featured Laravel application for managing coffee business operations including products, orders, customers, and inventory.

## ✨ Features

### 🔐 Authentication
- User registration and login
- Secure password hashing
- Session management
- Demo account: `admin@samnang.test` / `password`

### 📊 Dashboard
- Real-time statistics (products, orders, customers, revenue)
- Recent orders list
- Top products display
- Quick action buttons
- Live data from database

### ☕ Product Management (CRUD)
- Create, read, update, delete products
- Product SKU tracking
- Price management with decimals
- Stock quantity tracking
- Category assignment
- Active/inactive status
- Product descriptions

### 📂 Category Management (CRUD)
- Create and manage product categories
- Slug generation
- Category descriptions
- Product association

### 👥 Customer Management (CRUD)
- Complete customer database
- Contact information
- Address tracking
- Phone numbers
- Order history per customer

### 📦 Order Management (CRUD)
- Create and manage orders
- Customer assignment
- Order total tracking
- Status management (pending, processing, completed, cancelled)
- Order items with line details
- Notes and comments
- Order date tracking

### 🎨 Beautiful User Interface
- Responsive design (mobile, tablet, desktop)
- Hero carousel/slider on welcome page
- Sticky navigation bar
- Active page highlighting
- Bootstrap 5 integration
- Smooth animations
- Feature cards section
- Professional styling

## 🚀 Quick Start

### Installation
```bash
cd /Applications/XAMPP/xamppfiles/htdocs/samnang-coffee
composer install
php artisan migrate:fresh --seed
php artisan serve --port=8004
```

### Access
```
http://127.0.0.1:8004
```

### Demo Login
- **Email:** admin@samnang.test
- **Password:** password

## 📋 Project Structure

```
samnang-coffee/
├── app/Models/              # Database models
├── app/Http/Controllers/    # Request handlers
├── database/migrations/     # Database schema
├── database/seeders/        # Test data
├── resources/views/         # Blade templates
│   ├── layouts/            # Master layout
│   ├── auth/               # Login/Register
│   ├── categories/         # Category CRUD
│   ├── products/           # Product CRUD
│   ├── customers/          # Customer CRUD
│   ├── orders/             # Order CRUD
│   └── dashboard.blade.php # Dashboard
└── routes/web.php          # Route definitions
```

## 🗄️ Database Schema

- **Users:** Authentication and user profiles
- **Categories:** Product categories with descriptions
- **Products:** Coffee products with inventory tracking
- **Customers:** Customer contact and address information
- **Orders:** Order tracking with status management
- **OrderItems:** Individual items within orders

## 🔧 Tech Stack

- **Backend:** Laravel 8.x
- **Database:** MySQL
- **Frontend:** Bootstrap 5, Blade Templating
- **PHP:** 7.4+
- **Authentication:** Laravel Built-in Auth

## 📚 Available Resources

### Products
- `GET /products` - List all products
- `GET /products/create` - Create product form
- `POST /products` - Store new product
- `GET /products/{id}` - View product details
- `GET /products/{id}/edit` - Edit product form
- `PUT /products/{id}` - Update product
- `DELETE /products/{id}` - Delete product

### Categories, Customers, Orders
- Similar CRUD routes available for all resources

### Authentication
- `GET /login` - Login page
- `POST /login` - Process login
- `GET /register` - Register page
- `POST /register` - Create account
- `POST /logout` - Logout

## 🎯 Features Highlights

✅ Full CRUD operations for all resources  
✅ Real-time dashboard with live statistics  
✅ Beautiful carousel slider on welcome page  
✅ Responsive mobile-first design  
✅ Smooth animations and transitions  
✅ Secure authentication system  
✅ Database relationships and validation  
✅ Flash messages for user feedback  
✅ Professional UI/UX design  
✅ Production-ready code  

## 🛠️ Useful Commands

```bash
# Start development server
php artisan serve --port=8004

# Run migrations with seeders
php artisan migrate:fresh --seed

# Clear application caches
php artisan optimize:clear

# Access Laravel Tinker shell
php artisan tinker

# Create new model with migration
php artisan make:model Name -m

# Check migration status
php artisan migrate:status
```

## 📝 Demo Accounts

**Admin User:**
- Email: admin@samnang.test
- Password: password

**Test User:**
- Email: test@samnang.test
- Password: password

## 🌟 UI Features

- **Navbar:** Sticky header with active link highlighting
- **Dashboard:** Cards with real statistics and quick actions
- **Forms:** Bootstrap form styling with validation
- **Tables:** Responsive tables with action buttons
- **Alerts:** Flash messages for success/error feedback
- **Carousel:** Auto-rotating hero slider on home page
- **Cards:** Feature cards with hover effects
- **Footer:** Professional footer with copyright

## 🔒 Security

- CSRF protection on all forms
- Password hashing with bcrypt
- SQL injection prevention via ORM
- XSS protection with Blade escaping
- Secure session management
- Input validation on all forms

## 📈 Performance

- Eager loading with relationships
- Pagination on list views
- Optimized database queries
- Asset minification ready
- Database indexing on foreign keys

## 🐛 Troubleshooting

**Port already in use?**
```bash
php artisan serve --port=8005
```

**Database errors?**
```bash
php artisan migrate:fresh --seed
```

**Cache issues?**
```bash
php artisan optimize:clear
```

## 📞 Support

Check application logs at: `storage/logs/laravel.log`

---

**Status:** ✅ Production Ready  
**Version:** 1.0.0  
**Created:** February 3, 2026  

Enjoy managing your Samnang Coffee business! ☕

Laravel is a web application framework with expressive, elegant syntax. We believe development must be an enjoyable and creative experience to be truly fulfilling. Laravel takes the pain out of development by easing common tasks used in many web projects, such as:

- [Simple, fast routing engine](https://laravel.com/docs/routing).
- [Powerful dependency injection container](https://laravel.com/docs/container).
- Multiple back-ends for [session](https://laravel.com/docs/session) and [cache](https://laravel.com/docs/cache) storage.
- Expressive, intuitive [database ORM](https://laravel.com/docs/eloquent).
- Database agnostic [schema migrations](https://laravel.com/docs/migrations).
- [Robust background job processing](https://laravel.com/docs/queues).
- [Real-time event broadcasting](https://laravel.com/docs/broadcasting).

Laravel is accessible, powerful, and provides tools required for large, robust applications.

## Learning Laravel

Laravel has the most extensive and thorough [documentation](https://laravel.com/docs) and video tutorial library of all modern web application frameworks, making it a breeze to get started with the framework.

If you don't feel like reading, [Laracasts](https://laracasts.com) can help. Laracasts contains over 1500 video tutorials on a range of topics including Laravel, modern PHP, unit testing, and JavaScript. Boost your skills by digging into our comprehensive video library.

## Laravel Sponsors

We would like to extend our thanks to the following sponsors for funding Laravel development. If you are interested in becoming a sponsor, please visit the Laravel [Patreon page](https://patreon.com/taylorotwell).

### Premium Partners

- **[Vehikl](https://vehikl.com/)**
- **[Tighten Co.](https://tighten.co)**
- **[Kirschbaum Development Group](https://kirschbaumdevelopment.com)**
- **[64 Robots](https://64robots.com)**
- **[Cubet Techno Labs](https://cubettech.com)**
- **[Cyber-Duck](https://cyber-duck.co.uk)**
- **[Many](https://www.many.co.uk)**
- **[Webdock, Fast VPS Hosting](https://www.webdock.io/en)**
- **[DevSquad](https://devsquad.com)**
- **[Curotec](https://www.curotec.com/services/technologies/laravel/)**
- **[OP.GG](https://op.gg)**
- **[WebReinvent](https://webreinvent.com/?utm_source=laravel&utm_medium=github&utm_campaign=patreon-sponsors)**
- **[Lendio](https://lendio.com)**

## Contributing

Thank you for considering contributing to the Laravel framework! The contribution guide can be found in the [Laravel documentation](https://laravel.com/docs/contributions).

## Code of Conduct

In order to ensure that the Laravel community is welcoming to all, please review and abide by the [Code of Conduct](https://laravel.com/docs/contributions#code-of-conduct).

## Security Vulnerabilities

If you discover a security vulnerability within Laravel, please send an e-mail to Taylor Otwell via [taylor@laravel.com](mailto:taylor@laravel.com). All security vulnerabilities will be promptly addressed.

## License

The Laravel framework is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).
