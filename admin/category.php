<?php

require '../includes/init.php';

Auth::requireLogin();

$conn = require '../includes/db.php';

if (isset($_GET['id'])) {
    $category = Category::getByID($conn, $_GET['id']);
} else {
    $category = null;
}

?>
<?php require '../includes/header.php'; ?>

<?php if ($category) : ?>

    <h2>Category <?= htmlspecialchars($category['name']); ?></h2>
    <label for="name">Category you selected is <?= htmlspecialchars($category['name']); ?></label>
    <br>
    <a href="edit-category.php?id=<?= $category['id']; ?>">Edit</a>
    <a class="delete" href="delete-category.php?id=<?= $category['id']; ?>">Delete</a>

<?php else : ?>
    <p>Category not found</p>
<?php endif; ?>

<?php require '../includes/footer.php'; ?>
