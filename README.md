# Email Campaign Management System

This project is an API for Email Campaign Management System developed using Laravel. It offers a variety of functionalities for managing email campaigns, templates, user authentication. It also uses Laravel's Queues system to send both batch and individual emails.

## Key Features

- **Authentication Endpoints:** Secure user registration, login, and session management.
- **Campaign Management Endpoints:** Email campaign management including creation, update, deletion, listing.
- **Email Sending Queue Endpoints:** A queuing system for email batch processing.
- **Template Management Endpoints:** Allows for the creation, update, deletion, and listing of email templates.

## System Requirements

- PHP 8.1.2
- Laravel Framework 10.39.0
- Database (MySQL)

## Usage

Access the system through the Laravel server URL (`http://localhost:8000`). Utilize the API endpoints for managing users, campaigns, templates.

## API Endpoints

### Authentication
- `POST /register`: Register a new user.
- `POST /login`: Login user and start a session.

### Campaign Management
- `POST /campaigns`: Create a new campaign.
- `GET /campaigns`: List all campaigns.
- `PUT /campaigns/{id}`: Update a campaign.
- `DELETE /campaigns/{id}`: Delete a campaign.
- `PUT /campaigns/{id}/launch`: Launch a campaign.

### Template Management
- `POST /templates`: Create a new template.
- `GET /templates`: List all templates.
- `PUT /templates/{id}`: Update a template.
- `DELETE /templates/{id}`: Delete a template.

## Potential improvements
- Analytics endpoints: retrieve campaign analytics like open rates and click-through rates
- Queue management endpoints: monitor and manage queue (like viewing failed jobs, retry jobs)

## License

This project is open-sourced software licensed under the [MIT license](LICENSE).
