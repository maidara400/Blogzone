<?php

class Database {
    private static $instance = null;

    public static function getInstance() {
        if (self::$instance === null) {
            $serveur = 'localhost';
            $username = 'root';
            $password = '';
            $database = 'blog_zone';
            $options = [
                PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
                PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_OBJ
            ];

            try {
                self::$instance = new PDO("mysql:host=$serveur;dbname=$database", $username, $password, $options);
            } catch (PDOException $e) {
                die("La connexion a échoué : " . $e->getMessage());
            }
        }

        return self::$instance;
    }
}

