# Project Setup Guide

Follow these steps to set up the project on your local machine:

1. **Clone the repository**
   ```bash
   git clone https://github.com/<owner>/<repo>.git
   cd <repo>
   ```

2. **Install PHP dependencies using Composer**
   ```bash
   composer install
   ```

3. **Install JavaScript dependencies**
   ```bash
   npm install
   ```

4. **Copy the example environment file and configure your environment variables**
   ```bash
   cp .env.example .env
   # Edit .env to suit your local configuration
   ```

5. **Create storage link**
   ```bash
   php artisan storage:link
   ```


6. **Generate the application key**
   ```bash
   php artisan key:generate
   ```

7. **Run database migrations and seeders**
   ```bash
   php artisan migrate:fresh --seed
   ```

8. **Start the local development server**
   ```bash
   composer run dev 
   ```
---

## Deployment

To deploy the application to your server or production environment, follow these additional steps:

1. **Set environment variables for production**
   - Copy and edit your `.env` file as needed for your production credentials and settings.
2. **Install dependencies (on the server)**
   ```bash
   composer install --no-dev --optimize-autoloader
   npm install
   npm run build
   ```

3. **Run migrations**
   ```bash
   php artisan migrate --force
   ```

4. **Cache configuration and routes**
   ```bash
   php artisan config:cache
   php artisan route:cache
   php artisan view:cache
   ```

5. **Start the server**
   - Configure your web server (e.g., Nginx or Apache) to serve the `public` directory.

---

**You’re all set!** Visit [http://localhost:8000](http://localhost:8000) to view the application locally, or your production URL after deployment.



## Assumptions & Trade-offs
- We can create a role-based authentication process.
- We can implement real-time notifications for all events.
- We can improve the user interface to work well on all platforms.
- We can display a pie chart for ticket categories and a line chart for tickets over time.
- We can make the entire system subscription-based.
