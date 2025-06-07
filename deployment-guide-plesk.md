# Laravel API Deployment Guide for Plesk Panel (No Terminal Access)

## Prerequisites
- Plesk Panel access
- PHP 8.1+ enabled on your hosting
- MySQL/MariaDB database access
- File Manager access in Plesk

## Step 1: Prepare Local Files

### 1.1 Install Dependencies Locally
Before uploading, run these commands on your local machine:
```bash
composer install --no-dev --optimize-autoloader
npm install
npm run build
```

### 1.2 Create Production .env File
Create a `.env` file with production settings:
```env
APP_NAME="MSK Computers API"
APP_ENV=production
APP_KEY=base64:YOUR_APP_KEY_HERE
APP_DEBUG=false
APP_URL=https://api.mskcomputers.lk

LOG_CHANNEL=stack
LOG_DEPRECATIONS_CHANNEL=null
LOG_LEVEL=error

DB_CONNECTION=mysql
DB_HOST=localhost
DB_PORT=3306
DB_DATABASE=your_database_name
DB_USERNAME=your_db_username
DB_PASSWORD=your_db_password

BROADCAST_DRIVER=log
CACHE_DRIVER=file
FILESYSTEM_DISK=local
QUEUE_CONNECTION=sync
SESSION_DRIVER=file
SESSION_LIFETIME=120

REDIS_HOST=127.0.0.1
REDIS_PASSWORD=null
REDIS_PORT=6379

MAIL_MAILER=smtp
MAIL_HOST=mailpit
MAIL_PORT=1025
MAIL_USERNAME=null
MAIL_PASSWORD=null
MAIL_ENCRYPTION=null
MAIL_FROM_ADDRESS="hello@example.com"
MAIL_FROM_NAME="${APP_NAME}"
```

### 1.3 Generate Application Key
If you don't have an APP_KEY, generate one locally:
```bash
php artisan key:generate --show
```
Copy the generated key to your .env file.

## Step 2: Plesk Panel Setup

### 2.1 Create Subdomain/Domain
1. Login to Plesk Panel
2. Go to **Websites & Domains**
3. Click **Add Subdomain** (for api.mskcomputers.lk)
4. Set **Subdomain name**: `api`
5. Set **Document root**: `/api` (or leave default)
6. Enable **SSL/TLS support**

### 2.2 Database Setup
1. Go to **Websites & Domains** → **Databases**
2. Click **Add Database**
3. Create database name (e.g., `msk_api`)
4. Create database user with full privileges
5. Note down the database credentials

### 2.3 PHP Configuration
1. Go to **Websites & Domains** → **PHP Settings**
2. Set **PHP version** to 8.1 or higher
3. Enable required extensions:
   - `mbstring`
   - `xml`
   - `curl`
   - `zip`
   - `pdo_mysql`
   - `fileinfo`
   - `tokenizer`
   - `json`
   - `openssl`

## Step 3: File Upload

### 3.1 Upload Application Files
1. Go to **File Manager** in Plesk
2. Navigate to your domain's **httpdocs** folder
3. Upload all your Laravel files EXCEPT:
   - `.git` folder
   - `node_modules` folder
   - `tests` folder
   - `README.md`
   - `.gitignore`

### 3.2 Set Correct Directory Structure
Your httpdocs should contain:
```
httpdocs/
├── app/
├── bootstrap/
├── config/
├── database/
├── public/  ← This is important!
├── resources/
├── routes/
├── storage/
├── vendor/
├── .env
├── artisan
├── composer.json
└── composer.lock
```

### 3.3 Move Public Files
1. Copy ALL contents from `public/` folder to the root `httpdocs/`
2. Update `index.php` in httpdocs root:

```php
<?php

use Illuminate\Contracts\Http\Kernel;
use Illuminate\Http\Request;

define('LARAVEL_START', microtime(true));

// Determine if the application is in maintenance mode...
if (file_exists($maintenance = __DIR__.'/storage/framework/maintenance.php')) {
    require $maintenance;
}

// Register the Composer autoloader...
require __DIR__.'/vendor/autoload.php';

// Bootstrap Laravel and handle the request...
(require_once __DIR__.'/bootstrap/app.php')
    ->handleRequest(Request::capture());
```

## Step 4: Configure Permissions

### 4.1 Set Directory Permissions
In Plesk File Manager, set permissions:
- `storage/` folder: **755** (recursive)
- `bootstrap/cache/` folder: **755** (recursive)
- `.env` file: **644**

### 4.2 Create Required Directories
Ensure these directories exist with proper permissions:
```
storage/app/
storage/framework/cache/
storage/framework/sessions/
storage/framework/views/
storage/logs/
```

## Step 5: Database Migration

### 5.1 Upload Database Manually
Since you can't run migrations via terminal:
1. Export your database from development
2. Go to **Databases** → **phpMyAdmin**
3. Import your SQL file
4. Update database credentials in `.env`

### 5.2 Alternative: Create Tables Manually
If you need to create tables manually, use the SQL from your migration files.

## Step 6: SSL Certificate

### 6.1 Enable SSL
1. Go to **Websites & Domains** → **SSL/TLS Certificates**
2. Choose **Let's Encrypt** (free) or upload your certificate
3. Enable **Redirect from HTTP to HTTPS**

## Step 7: Web Server Configuration

### 7.1 Configure Apache/Nginx
Create `.htaccess` file in httpdocs root:
```apache
<IfModule mod_rewrite.c>
    <IfModule mod_negotiation.c>
        Options -MultiViews -Indexes
    </IfModule>

    RewriteEngine On

    # Handle Authorization Header
    RewriteCond %{HTTP:Authorization} .
    RewriteRule .* - [E=HTTP_AUTHORIZATION:%{HTTP:Authorization}]

    # Redirect Trailing Slashes If Not A Folder...
    RewriteCond %{REQUEST_FILENAME} !-d
    RewriteCond %{REQUEST_URI} (.+)/$
    RewriteRule ^ %1 [L,R=301]

    # Send Requests To Front Controller...
    RewriteCond %{REQUEST_FILENAME} !-d
    RewriteCond %{REQUEST_FILENAME} !-f
    RewriteRule ^ index.php [L]
</IfModule>
```

## Step 8: Testing

### 8.1 Test Basic Functionality
1. Visit `https://api.mskcomputers.lk`
2. You should see the Laravel welcome page or API documentation

### 8.2 Test API Endpoints
Test your API endpoints:
- `https://api.mskcomputers.lk/api/status`
- `https://api.mskcomputers.lk/api/products`

## Step 9: Image Domain Setup

### 9.1 Create Image Subdomain
1. Create subdomain: `erpsys.laptopexpert.lk`
2. Point it to the same server
3. In File Manager, create symbolic link or copy assets folder

### 9.2 Configure Image Access
Ensure the path `/assets/uploads/` is accessible on `erpsys.laptopexpert.lk`

## Troubleshooting

### Common Issues:

1. **500 Internal Server Error**
   - Check `.env` file syntax
   - Verify database credentials
   - Check file permissions

2. **Composer Dependencies Missing**
   - Re-upload `vendor/` folder completely
   - Ensure all dependencies are included

3. **Database Connection Failed**
   - Verify database credentials in `.env`
   - Check database user permissions

4. **File Not Found Errors**
   - Verify directory structure
   - Check file permissions
   - Ensure all files uploaded correctly

### Log Files
Check error logs in:
- Plesk Panel → **Logs** → **Error Logs**
- `storage/logs/laravel.log` (if accessible)

## Security Checklist

- [ ] `.env` file is not publicly accessible
- [ ] `storage/` and `bootstrap/cache/` directories have correct permissions
- [ ] SSL certificate is installed and working
- [ ] Database user has minimal required permissions
- [ ] API keys are properly configured
- [ ] Debug mode is disabled in production

## Post-Deployment

1. Test all API endpoints
2. Verify image URLs are working
3. Test API authentication
4. Monitor error logs
5. Set up backup schedule in Plesk 