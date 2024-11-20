# Kredium Project
This is a Laravel application that lets advisers manage clients and their loans.

## Prerequisites
Before setting up the project, ensure you have the following installed on your system:

- PHP: Version 8.0 or higher
- Composer: Latest version
- Node.js: Version 12.x or higher
- Database Server: MySQL recommended

## Setup
Follow these steps to set up the project:

### 1. Clone the Repository
```
git clone https://github.com/viilance/kredium-task.git
cd kredium-task
```

### 2. Install Dependencies
```
composer install
npm install
```

### 3. Compile Frontend Assets
```
npm run dev
```

### 4. Set Up Environment Variables
Copy the .env.example file to .env and customize it if needed:
```
cp .env.example .env
```

### 5. Generate Application Key
```
php artisan key:generate
```

### 6. Create a Database
```
CREATE DATABASE kredium_task;
```

### 7. Run Migrations and seeder
```
php artisan migrate
php artisan db:seed
```

### 8. Start the Development Server
```
php artisan serve
```
By default, the application will be accessible at http://localhost:8000.

### Usage
There is a seeded adviser with the following credentials:
```
email: first@example.com
password: password
```
There are 5 more advisers seeded, using the same default password, but randomly generated email.

### Features
Adviser Authentication: Secure login for advisers.

Client Management: Create, update, view, and delete clients.

Loan Applications:

 - Cash Loans: Apply for and manage cash loans for clients.
 - Home Loans: Apply for and manage home loans for clients.

Reports: Generate reports for advisers, including exporting to CSV.

Authorization and Validation: Ensures advisers can only manage their own clients and loans.
