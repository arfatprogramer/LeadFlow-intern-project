# LeadFlow CRM Demo Project

LeadFlow is a CRM demo project built with **Laravel**. It helps manage **leads, contacts, and opportunities**, with support for **role-based access**, **activity logs**, and **bulk operations**. Ideal for demonstrating CRM functionalities in a job interview or project showcase.

---

## Table of Contents

- [Features](#features)
- [Tech Stack](#tech-stack)
- [Installation](#installation)
- [Configuration](#configuration)
- [Usage](#usage)
- [Routes](#routes)
- [Contributing](#contributing)
- [License](#license)

---

## Features

- **Lead Management**
  - Create, update, delete, and view leads
  - Assign leads to users
  - Track lead status (`New`, `Contacted`, `Converted`)
  - Follow-up management
  - Bulk update and delete
- **Contact Management**
  - Manage contacts linked to leads
  - Role-based access for assigned contacts
- **Opportunity Management**
  - Track business opportunities linked to leads
- **Activity Logs**
  - Track actions on leads, contacts, and opportunities
  - View logs per entity
- **Dashboard**
  - Overview of total leads, contacts, opportunities
  - Display recent items for quick access
- **Role-based Access**
  - Admin, Manager, and User roles
  - Admin/Manager see all records
  - Users see only assigned records
- **Notifications**
  - Users get notifications for lead assignment and updates

---

## Tech Stack

- **Backend:** Laravel 10  
- **Frontend:** Blade, Tailwind CSS, Alpine.js  
- **Database:** MySQL  
- **JavaScript:** jQuery, DataTables  
- **Notifications:** Laravel Notifications  

---

## Installation

1. Clone the repository:

```bash
git clone https://github.com/your-username/leadflow.git
cd leadflow



Install PHP dependencies:

composer install


Install frontend dependencies:

npm install
npm run dev


Copy .env.example to .env and configure your database:

cp .env.example .env


Generate application key:

php artisan key:generate


Run migrations and seeders:

php artisan migrate --seed


Serve the application:

php artisan serve
