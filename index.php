<?php
session_start();
// Change the variables below to your connection info.
$DATABASE_HOST = 'localhost';
$DATABASE_USER = 'root';
$DATABASE_PASS = '';
$DATABASE_NAME = 'shoppingcart';
// Try and connect using the info above.
try {
	$pdo = new PDO('mysql:host=' . $DATABASE_HOST . ';dbname=' . $DATABASE_NAME . ';charset=utf8', $DATABASE_USER, $DATABASE_PASS);
} catch (PDOException $exception) {
	// If there is an error with the connection, stop the script and display the error.
	die ('Failed to connect to database!');
}
// Add pages we only need for our shopping cart system, for example addtocart will include the addtocart.php file.
$pages = array('cart', 'home', 'product', 'products', 'placeorder', 'login', 'logout', 'profile', 'register');
// Page is set to home (home.php) by default, so when the visitor visits that will be the page they see.
$page = isset($_GET['page']) && in_array($_GET['page'], $pages) ? $_GET['page'] : 'home';
$num_items_in_cart = isset($_SESSION['cart']) ? count($_SESSION['cart']) : 0;
?>
<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<title>Savin RC</title>
		<link href="style.css" rel="stylesheet" type="text/css">
		<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.1/css/all.css">
	</head>
	<body>
        <header>
            <div class="content-wrapper">
                <h1>Savin RC</h1>
                <nav>
                    <a href="index.php">Home</a>
                    <a href="index.php?page=products">Products</a>  
                </nav>
                <div class="link-icons">
                    <?php if(isset($_SESSION['loggedin'])): ?>
                         welcome <?=$_SESSION['name']?>
                        <a href="index.php?page=profile"><i class="fas fa-user-circle"></i>Profile</a>
                        <a href="index.php?page=logout"><i class="fas fa-sign-out-alt"></i>Logout</a>
                    <?php else: ?>
                        <a href="index.php?page=login"><i class="fas fa-sign-out-alt"></i>Login</a>
                    <?php endif; ?>
                    <a href="index.php?page=cart">
                        <i class="fas fa-shopping-cart"></i>
                        <span><?=$num_items_in_cart?></span>
                    </a>
                </div>
            </div>
        </header>
        <main>
        <?php include $page . '.php'; ?>
        </main>
        <footer>
			<div class="content-wrapper">
            	<p>© <?=date('Y')?>, Savin RC</p>
			</div>
        </footer>
    </body>
</html>