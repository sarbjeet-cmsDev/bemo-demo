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
   php artisan serve
   npm run dev
   ```

9. **Start the queue consumer**
   ```bash
   php artisan queue:work
   ```

10. **You’re all set!** Visit [http://localhost:8000](http://localhost:8000) to view the application locally, or your production URL after deployment.

---




## Assumptions & Trade-offs
- Setup Authentication For Ticket SUbmission and Agent login
- Real Time Email Notification as ticket status changed
- Mobile Responsive
- More Interactive UI/UX

## What I already did in term of code and scalablity
- Global Axios CLient
- Global Alert System
- Global Modal Component Or loader component
- Pie Chart component
- Global Css for Compoenets like form, modal