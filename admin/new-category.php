<?php

require '../includes/init.php';

Auth::requireLogin();

$category = new Category();

$message = null;

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (empty($_POST['category-name'])) {
        $error = 'Category name is required.';
    } else {
        try {
            $conn = require '../includes/db.php';
            Category::create($conn, $_POST['category-name']);
            $message = "Category added successfully.";
        } catch (PDOException $e) {
            if ($e->getCode() == 23000) {
                $error = "Category already exists. Please add a different one.";
            } else {
                $error = "An error occurred while adding new category. Please try again later.";
            }
        }
    }
}
?>

<?php require '../includes/header.php'; ?>

<h2>New category</h2>

<form method="post" id="formCategory">

    <div class="form-group">
        <label for="category-name">Category name</label>
        <input name="category-name" id="category-name" placeholder="Category name"
            class="form-control <?php echo isset($error) ? 'is-invalid' : ''; ?>" required>
        <div class="invalid-feedback">
            <?php echo isset($error) ? $error : ''; ?>
        </div>
    </div>

    <?php if (!empty($message)): ?>
        <p>
            <?= $message ?>
        </p>
    <?php endif; ?>
    <button type="submit" class="btn btn-primary">Add</button>
</form>

<?php require '../includes/footer.php'; ?>