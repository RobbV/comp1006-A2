<?php ob_start();
// header and auth
$page_title = 'Saving....';
require_once ('header.php');
require_once ('auth.php');
    // store the form inputs in variables
    $make = $_POST['make'];
    $model = $_POST['model'];
    $engine = $_POST['engine'];
    $fuel = $_POST['fuel'];
    $rating = $_POST['rating'];
    $car_id = $_POST['car_id'];
    // validate our inputs individually
    $ok = true;
 try {
    if (empty($make)) {
        echo 'Make is required<br />';
        $ok = false;
    }
    if (empty($model)) {
        echo 'Model is required<br />';
        $ok = false;
    }
    if (empty($engine)) {
        echo 'engine is required<br />';
        $ok = false;
    }
    if (empty($fuel)) {
        echo 'fuel is required<br />';
        $ok = false;
    }
    if (empty($rating)) {
        echo 'rating is required<br />';
        $ok = false;
    }
    // validate and process photo upload if we have one
    if (!empty($_FILES['image']['make'])) {
        $logo = $_FILES['image']['make'];
        // get and check type
        $type = $_FILES['image']['type'];
        if (($type == 'image/png') || ($type == 'image/jpeg')) {
            // save the file - valid type
            $final_name = session_id() . "-" . $image;
            $tmp_name = $_FILES['image']['tmp_name'];
            move_uploaded_file($tmp_name, "image/$final_name");
        }
        else {
            echo 'Logo must be a JPG or PNG<br >';
            $ok = false;
        }
    }
    else {

        if (!empty($_POST['current_image'])) {
            $final_name = $_POST['current_image'];
        }
    }
    // check if the form is ok to save or not
    if ($ok == true) {
        // connect to the db
        require('db.php');
        // set up the SQL command to save the data
        if (empty($car_id)) {
            $sql = "INSERT INTO cars (make, model, engine, fuel, rating, image)
          VALUES (:make, :model, :engine, :fuel, :rating, :image)";
        } else {
            $sql = "UPDATE cars SET make = :make, model = :model,
          engine = :engine, fuel = :fuel, rating = :rating, image = :image
           WHERE car_id = :car_id";
        }
        // create a command object
        $cmd = $conn->prepare($sql);
        // put each input value into the proper field
        $cmd->bindParam(':make', $make, PDO::PARAM_STR);
        $cmd->bindParam(':model', $model, PDO::PARAM_INT);
        $cmd->bindParam(':engine', $engine, PDO::PARAM_BOOL);
        $cmd->bindParam(':fuel', $fuel, PDO::PARAM_BOOL);
        $cmd->bindParam(':rating', $rating, PDO::PARAM_INT);
        $cmd->bindParam(':image', $final_name, PDO::PARAM_STR, 255);
        if (!empty($car_id)) {
            $cmd->bindParam(':car_id', $car_id, PDO::PARAM_INT);
        }
        // execute the save
        $cmd->execute();
        // disconnect
        $conn = null;

        // redirect
    }
 }
 catch (Exception $e) {
     mail('rob.vdg.14@gmail.com', 'Beer Store Error', $e);
     header('location:error.php');
}
?>
</body>
</html>

<?php ob_flush(); ?>
