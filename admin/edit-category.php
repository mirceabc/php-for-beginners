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

$categories = Category::getAll($conn);

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    try {
        Category::update($conn, $_POST['category-name'], $_GET['id']);
        Url::redirect("/admin/category.php?id={$category['id']}");
    } catch (PDOException $e) {
        $error = "An error occurred while updating category. Please try again later.";
    }
}

?>
<?php require '../includes/header.php'; ?>

<h2>Edit category</h2>

<form method="post" id="formCategory">

    <div class="form-group">
        <label for="category-name">Category
            <?= $category['name'] ?>
        </label>
        <input name="category-name" id="category-name" placeholder="Category name"
            value="<?php echo $category['name']; ?>"
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
    <button type="submit" class="btn btn-primary">Update</button>
</form>



<?php require '../includes/footer.php'; ?>