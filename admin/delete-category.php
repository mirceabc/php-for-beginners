<?php

require '../includes/init.php';

Auth::requireLogin();

$conn = require '../includes/db.php';

if (isset($_GET['id'])) {

    $category = Category::getByID($conn, $_GET['id']);
    if (!$category) {
        die("category not found");
    }

} else {
    die("id not supplied, category not found");
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    Category::delete($conn, $category['id']);
    Url::redirect("/admin");
}

?>
<?php require '../includes/header.php'; ?>

<?php require '../includes/footer.php'; ?>
