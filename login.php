<?php
session_start();
require "database.php";
if ($_GET)$errorMessage = $_GET['errormessage'];
else$errorMessage = '';
if ($_POST) {
    $success = false;
    $username = $_POST['username'];
    $password = $_POST['password'];
    $password = MD5($password);
    $pdo = Database::connect();
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $sql = "SELECT * FROM customer WHERE email = '$username' AND password = '$password'LIMIT 1";
    $q = $pdo->prepare($sql);
    $q->execute(array());
    $data = $q->fetch(PDO::FETCH_ASSOC);
    // print_r($data); exit();
    if ($data) {
        $_SESSION["username"] = $username;
        header("Location: index.php");
    } else {
        header("Location: login.php?errorMessage='Invalid credentials'");
        exit();
    }
}
//else just show empty login form
?>
<h1>Log in</h1>

<form class="form-horizontal" action="login.php" method="post">

    <input name="username" type="text" placeholder="me@email.com" required>
    <input name="password" type="password" required>
    <button type="submit" class="btn btn-success">Sign in</button>
    <a href="logout.php">Log Out</a>
    <a href="join.php">Join</a>
    <p style='color: red;'><?php echo $errorMessage; ?></p>
</form>