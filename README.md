Coalition Technologies (Laravel Test Skill for Remote Laravel Developer)

Laravel Web Application Task Management

Create a very simple Laravel web application for task management:

Create task (info to save: task name, priority, timestamps)
Edit task
Delete task
Reorder tasks with drag and drop in the browser. Priority should automatically be updated based on this. #1 priority goes at top, #2 next down and so on.
Tasks should be saved to a mysql table.
BONUS POINT: add project functionality to the tasks. User should be able to select a project from a dropdown and only view tasks associated with that project.

## Installation

To use this web application make sure that your local machine has PHP, Composer, MySQL and the Laravel installer installed.

Visit this link for detailed step: https://laravel.com/docs/11.x/installation#installing-php

For MySQL databas, (https://dev.mysql.com/downloads/mysql/)

In addition, you should install Node and NPM (https://nodejs.org/en) so that you can compile the application's frontend assets. This application is using Tailwind CSS and Livewire.

Once you successfully the following prerequisites, kindly go to laravel app.

cd task_management
composer install && npm install
npm run build
composer run dev

## OPTIONAL

For a fully-featured, graphical PHP installation and management experience,You can use Laravel Herd to setup and deploy this application (https://laravel.com/docs/11.x/installation#local-installation-using-herd)

## Databases and Migrations

Configure the .env file. Setup the database, set DB_CONNECTION=MySQL and your database credentials.

Once you setup your .env file, you can run "php artisan migrate" which will create tables.
After you successfully created the following tables. Kindly run "php artisan db::seed". It will create default Admin account with admin role to create Projects.

Username: administrator
Password: adminpass123@

Use this account to create Project Name that can be used by users to organize their task.

## User

You can register on the application to have a normal user role and to create task for each project that the admin added.

## Live Demo Site Also Available

I also release the application on this site: https://ct-laravel-test.drawrewards.com, you can use the default Admin account and create different normal user role.
