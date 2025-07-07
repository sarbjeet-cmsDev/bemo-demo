<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Ticket>
 */
class TicketFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $subjects = [
            'Login authentication failed',
            'Payment processing error',
            'Mobile app crashes on startup',
            'Data export not working',
            'Email notifications missing',
            'Slow page loading times',
            'API rate limit exceeded',
            'UI layout broken on mobile',
            'Database connection timeout',
            'File upload size limit',
            'Search functionality not working',
            'User profile update failed',
            'Password reset email not sent',
            'Dashboard data not loading',
            'Report generation failed',
            'Calendar sync issues',
            'Push notifications disabled',
            'Video playback error',
            'Print functionality broken',
            'Backup restore failed',
            'Integration webhook timeout',
            'SSL certificate expired',
            'Memory usage too high',
            'Cache clearing not working',
            'Scheduled task failed',
            'User permissions incorrect',
            'Data import validation error',
            'Third-party API connection lost',
            'System maintenance notification',
            'Performance monitoring alert'
        ];

        $categories = [
            'Authentication', 'Billing', 'Mobile App', 'Features', 'Notifications',
            'Performance', 'API', 'UI/UX', 'Infrastructure', 'File Management',
            'Search', 'User Management', 'Email', 'Dashboard', 'Reports',
            'Calendar', 'Push Notifications', 'Media', 'Print', 'Backup',
            'Integration', 'Security', 'System', 'Cache', 'Scheduled Tasks',
            'Permissions', 'Data Import', 'Third-party', 'Maintenance', 'Monitoring'
        ];

        $statuses = ['open', 'in_progress', 'closed', 'resolved'];

        $notes = [
            'User reported multiple failed attempts',
            'Payment gateway integration issue suspected',
            'iOS compatibility problem identified',
            'High priority - user needs data for presentation',
            'Email service configuration issue',
            'Database query optimization needed',
            'Enterprise customer requesting rate limit increase',
            'CSS layout issue on Chrome 120+',
            'Database connection pool configuration issue',
            'User needs larger file upload capacity',
            'Search index needs rebuilding',
            'Profile update validation failing',
            'SMTP server configuration issue',
            'Dashboard query timeout',
            'Report generation memory limit exceeded',
            'Calendar API authentication failed',
            'Push notification service down',
            'Video codec compatibility issue',
            'Print driver configuration problem',
            'Backup storage quota exceeded',
            'Webhook endpoint returning 500 errors',
            'SSL certificate renewal required',
            'Memory leak in background processes',
            'Cache invalidation not working properly',
            'Cron job configuration incorrect',
            'Role-based access control misconfigured',
            'CSV import validation rules too strict',
            'Third-party service experiencing downtime',
            'Scheduled maintenance window',
            'Performance metrics showing degradation'
        ];

        return [
            'subject' => $this->faker->randomElement($subjects),
            'body' => $this->faker->paragraphs(rand(2, 4), true),
            'category' => $this->faker->randomElement($categories),
            'note' => $this->faker->optional(0.7)->randomElement($notes),
            'status' => $this->faker->randomElement($statuses),
        ];
    }
}
