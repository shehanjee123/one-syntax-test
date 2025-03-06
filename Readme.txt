Practical Test - OneSyntax

# Project Overview
This project is a simple subscription platform that allows users to subscribe to one or more websites. When a new post is published on a subscribed website, all its subscribers receive an email notification containing the post title and description.

This application is built using:
* MySQL – Database Management
* Laravel Blade – Backend Framework
* TailwindCSS – Frontend Styling
No authentication is required for this project.

# Project Setup
1. Download and Open the Project
After downloading, open the project in your preferred IDE (e.g., VS Code, PhpStorm).

2. Set Up the Database
Create a MySQL database named 'shehanTest'.

Run the migration
php artisan migrate

3. Run the Seeder
To populate the database with initial website data, execute the following command:
php artisan db:seed --class=WebsiteSeeder

4. Install Dependencies
Run the following commands to install all required dependencies:
npm install
composer install

5. Start the Project
Execute these commands to launch the project:
npm run dev
php artisan serve
php artisan queue:work


# Testing (Test-Driven Development - TDD)
To ensure everything is working correctly, run the following test cases:

//user subscribe a website,
//user cannot subscribe twice to the same website
//subscription fails with invalid data
php artisan test --filter=SubscriptionTest

//A post is successfully created,
//Send Mail to the subscribers,
//post is stored in the database with correct data,
//PostSubscription table correctly records the sent notification
phpunit --filter a_post_can_be_uploaded_and_notified_to_subscribers

// resends emails only to users who did not receive
php artisan test --filter=ResendEmailTest

Note: If the database data is cleared after running tests, re-run the seeder:
php artisan db:seed --class=WebsiteSeeder

# Using the Application

Home Page
The homepage displays a list of websites registered in the system.
You can subscribe to any website using your email address to receive notifications when a new post is published.

Creating a Post
Click the "Create a Post" button in the header.
Select a website, enter a title and description, then submit the post.
Once submitted, the post is stored in the database, and an email notification is sent to all subscribers.

Checking Sent Emails:
Emails are logged in the Laravel log file:
Path: storage/logs/laravel.log

Viewing and Resending Posts
Click the "Show Posts" button in the header to view all published posts.
If an email was not received, you can resend it using the "Send Mail" button inside the post details.
