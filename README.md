# Email Campaign Management System

This project is a comprehensive Email Campaign Management System developed using Laravel. It offers a full suite of tools for managing email campaigns, templates, user authentication, and analytics. The system emphasizes reliability and scalability with Laravel Queues.

## Key Features

- **Authentication Endpoints:** Secure user registration, login, and session management.
- **Campaign Management Endpoints:** Full management capabilities for email campaigns including creation, update, deletion, listing, scheduling, and saving drafts.
- **Email Sending Queue Endpoints:** A robust queuing system for efficient email batch processing and progress monitoring.
- **Template Management Endpoints:** Allows for the creation, update, deletion, and listing of email templates.
- **Analytics Endpoints:** Provides detailed campaign analytics such as open rates and click-through rates, updated through background jobs.
- **Laravel Queue Implementations:** Efficient email processing with Laravel's queue system including handling retries and failures.
- **Scheduled Campaigns with Queues:** Automated queuing of scheduled campaigns.
- **Analytics Calculation in Background Jobs:** Regular updates of campaign analytics using background jobs.
- **Queue Management Endpoints:** Tools for monitoring and managing the queue, including handling of failed jobs.

## System Requirements

- PHP ^7.3|^8.0
- Laravel Framework ^8.0
- Database (MySQL, PostgreSQL, SQLite, SQL Server)
- Laravel-compatible Queue backend (Redis, Database, SQS, etc.)
- Email service provider (SMTP, Mailgun, etc.)

## Installation

1. Clone the repository:



## Usage

Access the system through the Laravel server URL (`http://localhost:8000`). Utilize the API endpoints for managing users, campaigns, templates, and analytics.

## API Endpoints

### Authentication
- `POST /register`: Register a new user.
- `POST /login`: Login user and start a session.

### Campaign Management
- `POST /campaigns`: Create a new campaign.
- `GET /campaigns`: List all campaigns.
- `PUT /campaigns/{id}`: Update a campaign.
- `DELETE /campaigns/{id}`: Delete a campaign.
- `PUT /campaigns/{id}/schedule`: Schedule a campaign.

### Template Management
- `POST /templates`: Create a new template.
- `GET /templates`: List all templates.
- `PUT /templates/{id}`: Update a template.
- `DELETE /templates/{id}`: Delete a template.

### Email Queue
- `POST /queue/send`: Queue emails for sending.
- `GET /queue/status`: Check the status of the email sending queue.

### Analytics
- `GET /analytics/{campaignId}`: Retrieve analytics for a campaign.

### Queue Management
- `GET /queue/jobs`: View jobs in the queue.
- `POST /queue/jobs/{id}/retry`: Retry a failed job.

## License

This project is open-sourced software licensed under the [MIT license](LICENSE).
