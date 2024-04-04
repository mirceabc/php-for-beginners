<?php

require '../includes/init.php';

Auth::requireLogin();

$conn = require '../includes/db.php';

$paginator = new Paginator($_GET['category'] ?? 1, 4, Category::getTotal($conn));

$categories = Category::getCategory($conn, $paginator->limit, $paginator->offset);

?>
<?php require '../includes/header.php'; ?>

<h2>Administration</h2>

<?php
if (empty($categories)): ?>
    <a href="new-category.php">Add new category</a>
    <p>No categories found.</p>
<?php else: ?>

    <h2>All Categories</h2><br>
    <a href="new-category.php">Add new category</a>

    <table class="table">
        <thead>
            <tr>
                <th>Name</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($categories as $category): ?>
                <tr>
                    <td>
                        <a href="category.php?id=<?= $category['id']; ?>">
                            <?= htmlspecialchars($category['name']); ?>
                        </a>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>

    <?php require '../includes/pagination.php';

endif;
?>

<?php require '../includes/footer.php'; ?>