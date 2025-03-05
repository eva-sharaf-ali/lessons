<?php
namespace Core;

use PDO;
use PDOException;

class Database {
    private static $host = 'localhost';  // Database host
    private static $dbName = 'lab11_db'; // Change if needed
    private static $user = 'root';       // Change if needed
    private static $password = '';       // Change if needed
    private static $conn = null;

    public static function connect() {
        if (self::$conn === null) {
            try {
                // Connect to MySQL without selecting a database
                self::$conn = new PDO("mysql:host=" . self::$host, self::$user, self::$password);
                self::$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

                // Create the database if it does not exist
                $query = "CREATE DATABASE IF NOT EXISTS " . self::$dbName . " CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci";
                self::$conn->exec($query);

                // Now connect to the newly created database
                self::$conn = new PDO("mysql:host=" . self::$host . ";dbname=" . self::$dbName, self::$user, self::$password);
                self::$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

                // Create the users table if it does not exist
                self::createUsersTable();
                // Create the categories table if it does not exist
                self::createCategoriesTable();
                // Create the products table if it does not exist
                self::createProductsTable();

            } catch (PDOException $e) {
                die("Database connection failed: " . $e->getMessage());
            }
        }
        return self::$conn;
    }

    private static function createUsersTable() {
        try {
            $conn = self::connect();
            $query = "CREATE TABLE IF NOT EXISTS users (
                id INT AUTO_INCREMENT PRIMARY KEY,
                first_name VARCHAR(50) NOT NULL,
                last_name VARCHAR(50) NOT NULL,
                email VARCHAR(100) NOT NULL UNIQUE,
                password VARCHAR(255) NOT NULL,
                birth_date DATE,
                role ENUM('admin', 'user') DEFAULT 'user',
                phone VARCHAR(20),
                created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
            ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4";
            
            $conn->exec($query);
        } catch (PDOException $e) {
            die("Table creation failed: " . $e->getMessage());
        }
    }

    private static function createCategoriesTable() {
        try {
            $conn = self::connect();
            $query = "CREATE TABLE IF NOT EXISTS categories (
                id INT AUTO_INCREMENT PRIMARY KEY,
                name VARCHAR(100) NOT NULL UNIQUE,
                created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
            ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4";
            
            $conn->exec($query);
        } catch (PDOException $e) {
            die("Table creation failed: " . $e->getMessage());
        }
    }

    private static function createProductsTable() {
        try {
            $conn = self::connect();
            $query = "CREATE TABLE IF NOT EXISTS products (
                id INT AUTO_INCREMENT PRIMARY KEY,
                name VARCHAR(30) NOT NULL,
                description TEXT NULL,
                price DECIMAL(10,2) NOT NULL,
                category_id INT NOT NULL,
                image VARCHAR(255) NOT NULL,
                created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
                FOREIGN KEY (category_id) REFERENCES categories(id) ON DELETE CASCADE
            ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4";
            
            $conn->exec($query);
        } catch (PDOException $e) {
            die("Table creation failed: " . $e->getMessage());
        }
    }
}