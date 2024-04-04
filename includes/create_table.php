<?php
try {
    $conn = require 'includes/db.php';
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $sql = "
    CREATE TABLE IF NOT EXISTS user(
        id INT(11) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
        username VARCHAR(20) NOT NULL,
        password VARCHAR(255) NOT NULL,
        UNIQUE INDEX username (username)
    );
    
    CREATE TABLE IF NOT EXISTS article (
        id INT(11) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
        title VARCHAR(128) NOT NULL,
        content TEXT NOT NULL,
        published_at DATETIME,
        image_file VARCHAR(200),
        INDEX title (title)
    );

    CREATE TABLE IF NOT EXISTS category (
        id INT(11) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
        name VARCHAR(128) NOT NULL,
        UNIQUE INDEX name (name) 
    );

    CREATE TABLE IF NOT EXISTS article_category (
        article_id INT(11) UNSIGNED,
        category_id INT(11) UNSIGNED,
        PRIMARY KEY(article_id, category_id),
        FOREIGN KEY (article_id) REFERENCES article(id) ON DELETE CASCADE,
        FOREIGN KEY (category_id) REFERENCES category(id) ON DELETE CASCADE
    );
";
$conn->exec($sql);

    // $sql = "CREATE TABLE IF NOT EXISTS user(
    //     id INT(11) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    //     username VARCHAR(20) NOT NULL,
    //     password VARCHAR(255) NOT NULL,
    //     UNIQUE INDEX username (username)
    // )";
    // $conn->exec($sql);
    
    // $sql = "CREATE TABLE IF NOT EXISTS article (
    //     id INT(11) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    //     title VARCHAR(128) NOT NULL,
    //     content TEXT NOT NULL,
    //     published_at DATETIME,
    //     image_file VARCHAR(200),
    //     INDEX title (title)
    // )";

    // $conn->exec($sql);

    // $sql = "CREATE TABLE IF NOT EXISTS category (
    //     id INT(11) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    //     name VARCHAR(128) NOT NULL,
    //     UNIQUE INDEX name (name) 
    //     )";

    // $conn->exec($sql);
  
    // $sql = "CREATE TABLE IF NOT EXISTS article_category (
    //     article_id INT(11) UNSIGNED,
    //     category_id INT(11) UNSIGNED,
    //     PRIMARY KEY(article_id, category_id),
    //     FOREIGN KEY (article_id) REFERENCES article(id) ON DELETE CASCADE,
    //     FOREIGN KEY (category_id) REFERENCES category(id) ON DELETE CASCADE
    // )";
    // $conn->exec($sql);
   
} catch(PDOException $e) {
    echo "Eroare la crearea tabelelor: " . $e->getMessage();
}
