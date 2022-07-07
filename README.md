### 🚧 In Construction 🚧
### This app aims to be the base of a system with laravel technologies:
- Admin view
- File management
- Employees management
- Account management
- Roles
- Permissions
- Assign roles to users
- Views by roles
- Export (Excel | PDF) page selector
- Search functionality
- CRUD
  - Users
  - Roles
  - Company
  - Locations
  - Departments
  - Areas
  - Charges

----------

# Getting started

Clone the repository

    git clone git@github.com/dcarvallo/sistema-ERP.git

Switch to the repo folder

    cd sistema-ERP

Install all the dependencies using composer and npm

    composer install
    npm install

Copy the example env file and make the required configuration changes in the .env file

    cp .env.example .env

Generate a new application key

    php artisan key:generate

Create a database connection

Check Redis Service is up

Run the database migrations (**Set the database connection in .env before migrating**)

    php artisan migrate --seed

Start the local development server

    php artisan serve


You can now access the server at http://localhost:8000

**TL;DR command list**

    git clone git@github.com/dcarvallo/sistema-ERP.git
    cd sistema-ERP
    composer install
    npm install
    cp .env.example .env
    php artisan key:generate
    
**Make sure you set the correct database connection information before running the migrations**

    php artisan migrate --seed
    php artisan serve

----------

## Environment variables

- `.env` - Environment variables can be set in this file

***Note*** : You can quickly set the database information and other variables in this file and have the application fully working.

----------
