<?php require ('auth.php');
if ((!empty($_GET['page_id'])) && (is_numeric($_GET['page_id']))) {

    $page_id = $_GET['page_id'];
    //connect
    require('db.php');
    // fetch the data for the database
 $sql = "SELECT * FROM pages WHERE page_id = :page_id";
$cmd = $conn->prepare($sql);
$cmd->bindParam(':page_id', $page_id, PDO::PARAM_INT);
$cmd->execute();
$pages = $cmd->fetchAll();
//disconnect
$conn = null;
// store values in to variable to be used my the page
//store each value from the database into a variable
foreach ($pages as $page) {
  $page_title = $page['page_title'];
  $page_image = $page['page_image'];
  $page_content = $page['page_content'];

}
} ?>
<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title>Login | Register</title>
    <!-- link css docs -->
    <link rel="stylesheet" href="css/bootstrap.min.css" />
    <link rel="stylesheet" href="css/bootstrap-theme.css" />
    <link rel="stylesheet" href="css/normalize.css" media="screen" />
    <link rel="stylesheet" href="css/main.css" media="screen" />
  </head>
  <body>
    <a href="reg-log.php"><img src="images/logo.svg" alt="logo" height="130" width="130" /></a>
    <button type="button" id="back" class="btn btn-warning"><a href="home.php">back to app</a></button>
    <main>
      <h1>Welcome!</h1>
      <h4>To the CMS Panel</h4>
      <!-- selector buttons -->
      <section class="buttons">
        <button type="button" id="pages" class="btn btn-success">Pages</button>
        <button type="button" id="add-page" class="btn btn-success">Add Page</button>
        <button type="button" id="users" class="btn btn-success">Users</button>
      </section>
      <!-- log in section -->
      <section class="pages">
        <div id="pages">
        <?php
        // connect
        require ('db.php');
        //prepare the query
        $sql = "SELECT * FROM pages";
        $cmd = $conn -> prepare($sql);
        // run the query and store the results
        $cmd -> execute();
        $pages = $cmd -> fetchAll();
        //start the grid with html
        echo '<table class="table table-striped"><thead><th>Page title</th><th>Page image</th><th>Page content</th><th>Edit</th><th>Delete</th></thead><tbody>';

        foreach ($pages as $page) {
            echo '<tr><td>' . $page['page_title'] . '</td>
        	<td>' . $page['page_image'] . '</td>
        	<td>' . $page['page_content'] . '</td>
          <td><a href="cms_tools.php?page_id=' . $page['page_id'] . '" title="Edit">Edit</a></td>
          <td><a href="delete-page.php?page_id=' . $page['page_id'] . '"
          title="Delete" class="confirmation">Delete</a></td>
          </tr>';
        }
        // close the html grid
        echo '</tbody></table>';
        $conn = null;
        ?>
      </div>
      </section>
      <!-- register form -->
      <section class="add-page">
        <div id="add-page">
        <h2>User Registration</h1>
          <form class="add-page" action="save-page.php" method="post">
            <!-- username input -->
            <div class="">
              <label for="page_title">page title:</label>
              <input class="form-control" type="page_title" name="page_title" placeholder="page title" value="<?php echo $page_title; ?>" />
            </div><!-- close email div -->
            <div class="">
              <label for="page_image" class="col-sm-2">content:</label>
              <input type="file" name="page_image" id="page_image" />
            </div><!-- close email div -->
            <div class="">
              <label for="page_content">content:</label>
              <textarea name="page_content"class="form-control" rows="10" ><?php echo $page_content; ?></textarea>
            </div><!-- close email div -->
            <!-- submit -->
            <div class="">
                  <input type="submit" value="submit" class="btn btn-primary" />
              </div>
          </form>
        </div> <!-- register closing div -->
      </section>
      <section class="users">
        <div id="users">
        <?php
        // connect
        require ('db.php');
        //prepare the query
        $sql = "SELECT * FROM users_db";
        $cmd = $conn -> prepare($sql);
        // run the query and store the results
        $cmd -> execute();
        $users = $cmd -> fetchAll();
        //start the grid with html
        echo '<table class="table table-striped"><thead><th>User ID</th><th>User Name</th><th>full name</th><th>Email</th><th>Edit</th><th>Delete</th></thead><tbody>';

        foreach ($users as $user) {
            echo '<tr><td>' . $user['user_id'] . '</td>
        	<td>' . $user['user_name'] . '</td>
          <td>' . $user['full_name'] . '</td>
          <td>' . $user['email'] . '</td>
          <td><a href="reg-log.php?user_id=' . $user['user_id'] . '" title="Edit">Edit</a></td>
          <td><a href="delete-user.php?user_id=' . $user['user_id'] . '"
          title="Delete" class="confirmation">Delete</a></td>
          </tr>';
        }
        // close the html grid
        echo '</tbody></table>';
        $conn = null;
        ?>
      </div>
      </section>
    </main>
    <!-- jguery and app link -->
    <script src="scripts/lib/jquery-2.2.0.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
    <script src="scripts/app.js"></script>
  </body>
</html>
