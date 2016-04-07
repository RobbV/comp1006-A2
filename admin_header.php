<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8" />
    <title><?php echo $page_title;?></title>
    <?php     require('auth.php');
              ob_start(); ?>
    <!-- link css docs -->
    <link rel="stylesheet" href="css/bootstrap.min.css" />
    <link rel="stylesheet" href="css/bootstrap-theme.css" />
    <link rel="stylesheet" href="css/normalize.css" media="screen" />
    <link rel="stylesheet" href="css/main.css" media="screen" />
  </head>
  <body>
    <!-- Global Public Nav -->
    <header>
      <img src="images/logo.svg" alt="logo" height="100" width="100"/>
        <nav><?php
          session_start();
    if (!empty($_SESSION['user_id'])) {
        // private links
        echo '<li><a href="beer.php" title="Add">Add Beer</a></li>
            <li><a href="beers.php" title="List">Beer Listings</a></li>
            <li><a href="logout.php" title="Logout">Logout</a></li>';
    }
    else {
        // public links
        echo '<li><a href="register.php" title="Register">Register</a></li>
            <li><a href="login.php" title="Login">Login</a></li>';
    }
    ?>
          <a href="#" id="menu-icon">☰</a>
          <ul>
            <li title="home"><a href="home.php">Home</a></li>
            <li title="about"><a href="add-page.php">About Us</a></li>
            <li title="register car"><a href="view-pages.php">Add Cars</a></li>
            <li title="view cars"><a href="view-users.php">View Cars</a></li>
        </nav>
  </header>
  <main class="app">
