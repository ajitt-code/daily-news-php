
Daily News PHP Project

Daily News is a simple and responsive news management system built with PHP, MySQL, and Bootstrap. This project allows users to create, view, update, and delete news articles with ease, while maintaining a clean and modern interface.

⸻

Features
	•	Add news with title, description, category, region, city, country, language, status, and banner image.
	•	Record the name of the person who creates or updates news.
	•	View news in clean Bootstrap cards with banner images and details.
	•	Update existing news, including images.
	•	Delete news with confirmation prompt.
	•	Responsive design for desktop and mobile.

⸻

Tech Stack
	•	Backend: PHP
	•	Database: MySQL (images stored as BLOBs)
	•	Frontend: Bootstrap 5

⸻

Folder Structure

/daily-news-php
│
├── config.php         # Database connection
├── header.php         # Header with navigation
├── footer.php         # Footer
├── index.php          # Homepage displaying all news
├── create.php         # Form to add news
├── insert.php         # Handles insertion into database
├── view.php           # View single news
├── update.php         # Update news
├── delete.php         # Delete news
└── assets/            # Optional folder for CSS, JS, images


⸻

Getting Started

Follow these steps to run the project locally:

1. Prerequisites
	•	Install XAMPP/WAMP/LAMP for PHP and MySQL support.
	•	Make sure PHP 7.4+ is installed.
	•	MySQL database server is running.

2. Clone the Repository

git clone https://github.com/yourusername/daily-news-php.git
cd daily-news-php

3. Create Database
	1.	Open phpMyAdmin or MySQL CLI.
	2.	Create a database:

CREATE DATABASE daily_news_db;

	3.	Create news table:

CREATE TABLE news (
    News_Id INT AUTO_INCREMENT PRIMARY KEY,
    News_Title VARCHAR(255),
    News_Description TEXT,
    News_Banner_Image LONGBLOB,
    Category VARCHAR(100),
    Region VARCHAR(100),
    Status VARCHAR(50),
    Language VARCHAR(50),
    City VARCHAR(100),
    Country VARCHAR(100),
    CreatedOn DATETIME DEFAULT CURRENT_TIMESTAMP,
    CreatedBy VARCHAR(100),
    UpdatedOn DATETIME NULL,
    UpdatedBy VARCHAR(100) NULL
);

4. Configure Database
	•	Open config.php and set your database credentials:

<?php
$servername = "localhost";
$username   = "root";        // your DB username
$password   = "";            // your DB password
$dbname     = "daily_news_db";

$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>

5. Run the Project
	•	Copy the project folder into your XAMPP htdocs (or equivalent).
	•	Start Apache and MySQL from XAMPP.
	•	Open your browser and go to:

http://127.0.0.1/daily-news-php/index.php


⸻

Usage
	•	Add News: Click the “Add News” button and fill the form.
	•	View News: Click “View” on a news card to see full details.
	•	Update News: On the view page, click “Update”, make changes, and submit.
	•	Delete News: On the view page, click “Delete” to remove news.

⸻

Author

Built by Ajit Sanap – for learning, demonstration, and practice with PHP and MySQL.
