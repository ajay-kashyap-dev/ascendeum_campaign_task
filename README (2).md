# Stats viewing app

Create a basic stats viewing application by designing a database schema,
importing data from a CSV file and implementing the routes.

## Installation

This project comes with a pre-seeded SQLite database. Run `php artisan serve` to
start a web server.

Make sure to run the migrations and seeders and update the configuration if you
would like to run this application with a MySQL database.

## Assignment

In the `storage/` folder you will find two files: _stats_2024_03_31.csv_ and
_stats_2024_04_01.csv_.

These files contain individual monetization events with or without tracking
parameters: utm_campaign and utm_term.

First, extend the database schema in a way that lets you store these stats in a
format which allows you run hourly breakdowns by utm_campaign and utm_campaign +
utm_term. Stats should link to the campaigns table.

The schema should be as normalized as possible, preferably 3rd normal form.
utm_campaign and utm_term values should exist only once in the whole database.

Second, implement the `ImportStatsCommand`. It should accept a filename and import
the data from that file into the newly created schema. A row should not be
imported when it does not have a value for the utm_campaign or utm_term column.

Finally, implement the routes defined in `routes/web.php`. The first route
should render a table with all revenue aggregated by campaign. Each row should
link to the second route.

The second route should render a table with all revenue for a single campaign
broken down by date and hour.

The third route should render a table with all revenue for a single campaign
broken down by utm_term.

## Assignment Completed

Campaign Project Setup

Overview
This is a Campaign application. The following steps will guide you through the process of setting up and running the project locally.

Prerequisites
PHP 8.2+ installed on your system
Composer installed on your system
A MySQL database (or another database depending on the configuration)

Steps to Set Up
1. Clone the Repository
Clone the repository to your local machine using Git:

git clone https://github.com/ajay-kashyap-dev/ascendeum_campaign_task.git
cd ascendeum_campaign_task

2. Install PHP Dependencies
Make sure you have Composer installed. Then, install the project dependencies:

composer install

3. Set Up Environment File
Copy the example environment file to create your own .env file:

cp .env.example .env

4. Configure the .env File
Open the .env file and set up your environment-specific variables. At a minimum, you need to configure the database connection:

DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=your_database_name
DB_USERNAME=your_database_user
DB_PASSWORD=your_database_password

5. Generate Application Key
Run the following command to generate the application key and set it in your .env file:

php artisan key:generate

6. Run Database Migrations
If the project includes migrations, run them to set up your database:

php artisan migrate
7. Set Up Storage Permissions
Ensure that the storage and bootstrap/cache directories have the correct write permissions:

chmod -R 775 storage
chmod -R 775 bootstrap/cache

8. Serve the Application
You can now serve the application locally using the built-in Laravel development server:

php artisan serve
The application will be available at http://localhost:8000.

9. Access the Application
Open your web browser and go to http://localhost:8000 to access the application.