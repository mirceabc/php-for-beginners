<?php 

require 'includes/init.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    if($_POST['password'] !== $_POST['confirm_password']) {
        $error = "Passwords do not match.";
    }
    else{
        try {
            $conn = require 'includes/db.php';
            User::create($conn, $_POST['username'], $_POST['password']);
            Url::redirect('/login.php');
        } catch (PDOException $e) {
            if ($e->getCode() == 23000) {
                $error = "Username already exists. Please choose a different one.";
            } else {
                $error = "An error occurred while registering. Please try again later.";
            }
        }
    }
}

?>
<?php require 'includes/header.php'; ?>

<h2>Sign in</h2>

<?php if (!empty($error)) : ?>
    <p><?= $error ?></p>
<?php endif; ?>

<form method="post">

    <div class="form-group">
        <label for="username">Username</label>
        <input name="username" id="username" class="form-control">
    </div>

    <div class="form-group">
        <label for="password">Password</label>
        <input type="password" name="password" id="password" class="form-control">
    </div>

    <div class="form-group">
    <label for="confirm_password">Confirm Password</label>
    <input type="password" name="confirm_password" id="confirm_password" class="form-control <?php echo isset($error) ? 'is-invalid' : ''; ?>">
    <div class="invalid-feedback">
        <?php echo isset($error) ? $error : ''; ?>
    </div>
</div>


    <button class="btn btn-primary mt-2">Register</button>

</form>

<?php require 'includes/footer.php'; ?>