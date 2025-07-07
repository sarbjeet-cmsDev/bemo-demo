# Environment Setup Guide

## Frontend Environment Configuration

### Development Environment
Create `.env.development` file in `bemo-fe/` directory:
```
VITE_APP_NAME=Bemo
VITE_APP_ENV=development
VITE_API_BASE_URL=http://localhost:8000/api
VITE_APP_URL=http://localhost:5173
VITE_API_TIMEOUT=10000
VITE_DEBUG=true
VITE_APP_VERSION=1.0.0
```

### Staging Environment
Create `.env.staging` file:
```
VITE_APP_NAME=Bemo Staging
VITE_APP_ENV=staging
VITE_API_BASE_URL=https://staging-api.bemo.com/api
VITE_APP_URL=https://staging.bemo.com
VITE_API_TIMEOUT=15000
VITE_DEBUG=false
VITE_APP_VERSION=1.0.0
```

### Production Environment
Create `.env.production` file:
```
VITE_APP_NAME=Bemo
VITE_APP_ENV=production
VITE_API_BASE_URL=https://api.bemo.com/api
VITE_APP_URL=https://bemo.com
VITE_API_TIMEOUT=15000
VITE_DEBUG=false
VITE_APP_VERSION=1.0.0
```

## Backend Environment Configuration

### Development Environment
Create `.env` file in `bemo/` directory:
```
APP_NAME=Bemo
APP_ENV=local
APP_KEY=base64:YOUR_APP_KEY_HERE
APP_DEBUG=true
APP_TIMEZONE=UTC
APP_URL=http://localhost:8000

FRONTEND_URL=http://localhost:5173

DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=bemo
DB_USERNAME=root
DB_PASSWORD=

CACHE_STORE=database
SESSION_DRIVER=database
SESSION_LIFETIME=120

MAIL_MAILER=log
MAIL_HOST=127.0.0.1
MAIL_PORT=2525
MAIL_USERNAME=null
MAIL_PASSWORD=null
MAIL_ENCRYPTION=null
MAIL_FROM_ADDRESS="hello@example.com"
MAIL_FROM_NAME="${APP_NAME}"

QUEUE_CONNECTION=database
LOG_CHANNEL=stack
LOG_LEVEL=debug

OPENAI_API_KEY=your_openai_api_key_here
OPENAI_ORGANIZATION=your_openai_org_here
OPENAI_MODEL=gpt-3.5-turbo

CORS_ALLOWED_ORIGINS=http://localhost:5173,http://localhost:3000
```

### Staging Environment
```
APP_NAME=Bemo
APP_ENV=staging
APP_KEY=base64:YOUR_STAGING_APP_KEY_HERE
APP_DEBUG=false
APP_URL=https://staging-api.bemo.com

FRONTEND_URL=https://staging.bemo.com

DB_CONNECTION=mysql
DB_HOST=staging-db-host
DB_PORT=3306
DB_DATABASE=bemo_staging
DB_USERNAME=staging_user
DB_PASSWORD=staging_password

CACHE_STORE=redis
SESSION_DRIVER=redis
REDIS_HOST=staging-redis-host
REDIS_PASSWORD=staging-redis-password
REDIS_PORT=6379

MAIL_MAILER=smtp
MAIL_HOST=smtp.mailtrap.io
MAIL_PORT=587
MAIL_USERNAME=staging_mail_user
MAIL_PASSWORD=staging_mail_password
MAIL_ENCRYPTION=tls

QUEUE_CONNECTION=redis
LOG_CHANNEL=errorlog
LOG_LEVEL=warning

OPENAI_API_KEY=staging_openai_api_key
OPENAI_ORGANIZATION=staging_openai_org
```

### Production Environment
```
APP_NAME=Bemo
APP_ENV=production
APP_KEY=base64:YOUR_PRODUCTION_APP_KEY_HERE
APP_DEBUG=false
APP_URL=https://api.bemo.com

FRONTEND_URL=https://bemo.com

DB_CONNECTION=mysql
DB_HOST=production-db-host
DB_PORT=3306
DB_DATABASE=bemo_production
DB_USERNAME=production_user
DB_PASSWORD=production_password

CACHE_STORE=redis
SESSION_DRIVER=redis
REDIS_HOST=production-redis-host
REDIS_PASSWORD=production-redis-password
REDIS_PORT=6379

MAIL_MAILER=smtp
MAIL_HOST=smtp.mailgun.org
MAIL_PORT=587
MAIL_USERNAME=production_mail_user
MAIL_PASSWORD=production_mail_password
MAIL_ENCRYPTION=tls

QUEUE_CONNECTION=redis
LOG_CHANNEL=errorlog
LOG_LEVEL=error

OPENAI_API_KEY=production_openai_api_key
OPENAI_ORGANIZATION=production_openai_org
```

## Available Commands

### Frontend
```bash
# Development
npm run dev

# Staging
npm run dev:staging

# Production build
npm run build

# Staging build
npm run build:staging

# Development build
npm run build:dev
```

### Backend
```bash
# Generate application key
php artisan key:generate

# Run migrations
php artisan migrate

# Seed database
php artisan db:seed

# Start development server
php artisan serve

# Clear caches
php artisan config:clear
php artisan cache:clear
php artisan route:clear
php artisan view:clear
```

## Setup Instructions

1. **Backend Setup**:
   - Copy environment variables to `.env`
   - Run `php artisan key:generate`
   - Configure database connection
   - Run `php artisan migrate`
   - Run `php artisan db:seed`

2. **Frontend Setup**:
   - Copy environment variables to appropriate `.env.*` file
   - Run `npm install`
   - Run `npm run dev` for development

3. **CORS Configuration**:
   - Ensure `CORS_ALLOWED_ORIGINS` in backend includes frontend URL
   - Update `config/cors.php` if needed

4. **API Integration**:
   - Frontend automatically uses environment-specific API URLs
   - Backend CORS is configured to allow frontend requests 