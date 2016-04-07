<?php session_start(); ?>
<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8" />
    <title><?php echo $page_title;?></title>
    <?php ob_start(); ?>
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
      <button type="button" id="back" class="btn btn-default"><a href="logout.php">logOut</a></button>
      <button type="button" id="cms tools" class="btn btn-default"><a href="cms_tools.php">CMS Tools</a></button>
        <nav>
          <a href="#" id="menu-icon">☰</a>
          <ul>
            <li title="home"><a href="home.php">Home</a></li>
            <li title="about"><a href="about.php">About Us</a></li>
            <li title="register car"><a href="register_cars.php">Add Cars</a></li>
            <li title="view cars"><a href="view_cars.php">View Cars</a></li>
            <?php
            // connect to DB
            require('db.php');
            // collect page titles from DB
            $sql = "select * from pages";
            $cmd = $conn->prepare($sql);
            $cmd->execute();
            $titles = $cmd->fetchAll();
              // loop through a dynamic navigation based on the db created and display results on page
              foreach ($titles as $title) {
                  echo '<li><a href="default.php?page_id=' . $title["page_id"] . '">' . $title["page_title"] . '</a></li>';
              }
              $conn = null;
            ?>
        </nav>
  </header>
  <main class="app">
