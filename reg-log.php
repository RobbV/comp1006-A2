<?php
if ((!empty($_GET['user_id'])) && (is_numeric($_GET['user_id']))) {

    $user_id = $_GET['user_id'];
    //connect
    require('db.php');
    // fetch the data for the database
 $sql = "SELECT * FROM users_db WHERE user_id = :user_id";
$cmd = $conn->prepare($sql);
$cmd->bindParam(':user_id', $user_id, PDO::PARAM_INT);
$cmd->execute();
$users = $cmd->fetchAll();
//disconnect
$conn = null;
// store values in to variable to be used my the page
//store each value from the database into a variable
foreach ($users as $user) {
  $user_name = $user['user_name'];
  $full_name = $user['full_name'];
  $email = $user['email'];

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
    <main>
      <h1>Welcome!</h1>
      <h4>Please Login or register to use the app</h4>
      <!-- selector buttons -->
      <section class="buttons">
        <button type="button" id="login" class="btn btn-success">LogIn</button>
        <button type="button" id="register" class="btn btn-success">Register</button>
      </section>
      <!-- log in section -->
      <section class="login">
        <div id="login">
        <h2>Log In</h2>
        <form class="login" action="validate.php" method="post">
          <div class="form-group">
              <label for="user_name" class="col-sm-2">Username:</label>
              <input class="form-control" type="user_name" name="user_name" />
          </div>
          <div class="form-group">
              <label for="password" class="col-sm-2">Password:</label>
              <input class="form-control" type="password" name="password" />
          </div>
          <div class="col-sm-offset-2">
              <input type="submit" value="Login" class="btn btn-primary" />
          </div>
      </form>
      </div><!-- login closing div -->
      </section>
      <!-- register form -->
      <section class="register">
        <h2>User Registration</h1>
          <form class="reg" action="save-user.php" method="post">
            <!-- username input -->
            <div class="">
              <label for="user_name">Username:</label>
              <input class="form-control" type="user_name" name="user_name" placeholder="user_name" value="<?php echo $user_name; ?>" />
            </div><!-- close email div -->
            <div class="">
              <label for="full_name">Full name:</label>
              <input class="form-control" type="full_name" name="full_name" placeholder="full_name" value="<?php echo $full_name; ?>" />
            </div><!-- close email div -->
            <div class="">
              <label for="email">email:</label>
              <input class="form-control" type="email" name="email" placeholder="email" value="<?php echo $email; ?>" />
            </div><!-- close email div -->
            <!-- password input -->
            <div class="">
              <label for="password">Password:</label>
              <input class="form-control" type="password" name="password" placeholder="password"/>
            </div><!-- close password div -->
            <!-- confirm password input -->
            <div class="">
              <label for="confirm">Confirm Password</label>
              <input class="form-control" type="password" name="confirm" placeholder="password" />
            </div><!-- close confirm password div -->
            <!-- submit -->
            <div class="">
                  <input type="submit" value="Register" class="btn btn-primary" />
              </div>
          </form>
        </div> <!-- register closing div -->
      </section>
    </main>
    <!-- jguery and app link -->
    <script src="scripts/lib/jquery-2.2.0.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
    <script src="scripts/app.js"></script>
  </body>
</html>
