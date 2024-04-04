<?php
try {
    $conn = require 'includes/db.php';
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $sql = "CREATE TABLE IF NOT EXISTS test_user(
        id INT(11) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
        username VARCHAR(20) NOT NULL,
        password VARCHAR(255) NOT NULL,
        UNIQUE INDEX username (username)
    )";
    $conn->exec($sql);
    echo "Tabela user a fost creată cu succes!";
    
    $sql = "CREATE TABLE IF NOT EXISTS test (
        id INT(11) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
        title VARCHAR(128) NOT NULL,
        content TEXT NOT NULL,
        published_at DATETIME,
        image_file VARCHAR(200),
        INDEX title (title)
    )";

    $conn->exec($sql);
    echo "Tabela 'article' a fost creată cu succes și indexul pentru coloana 'title' a fost adăugat!";

    $sql = "CREATE TABLE IF NOT EXISTS test_category (
        id INT(11) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
        name VARCHAR(128) NOT NULL,
        UNIQUE INDEX name (name) 
        )";

    $conn->exec($sql);
    echo "Tabela 'category' a fost creată cu succes și indexul pentru coloana 'name' a fost adăugat!";

    $sql = "CREATE TABLE IF NOT EXISTS test_article_category (
        article_id INT(11) UNSIGNED,
        category_id INT(11) UNSIGNED,
        PRIMARY KEY(article_id, category_id),
        FOREIGN KEY (article_id) REFERENCES test(id) ON DELETE CASCADE,
        FOREIGN KEY (category_id) REFERENCES test_category(id) ON DELETE CASCADE
    )";
    $conn->exec($sql);
    echo "Tabela 'article_category' a fost creată cu succes și cheile străine au fost adăugate!";

} catch(PDOException $e) {
    echo "Eroare la crearea tabelelor: " . $e->getMessage();
}
