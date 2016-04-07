<?php ob_start();
// set title and show header
$page_title = 'View Cars';
require('header.php');
// auth
require('auth.php');
// setting default values
$make = null;
$model = null;
$engine = null;
$fuel = null;
$rating = null;
$image = null;
// check for car id
if ((!empty($_GET['car_id'])) && (is_numeric($_GET['car_id']))) {

    $car_id = $_GET['car_id'];
    //connect
    require('db.php');
    // fetch the data for the database
    $sql = "SELECT * FROM cars WHERE car_id = :car_id";
    $cmd = $conn->prepare($sql);
    $cmd->bindParam(':car_id', $car_id, PDO::PARAM_INT);
    $cmd->execute();
    $cars = $cmd->fetchAll();
    //disconnect
    $conn = null;
    //store each value from the database into a variable
    foreach ($cars as $car) {
        $make = $car['make'];
        $model = $car['model'];
        $engine = $car['engine'];
        $fuel = $car['fuel'];
        $rating = $car['rating'];
        $image = $car['image'];
    }
}
?>  <h1>Car Information</h1>

  <form class="" action="save-car.php" method="post">
      <fieldset>
          <label for="make" class="col-sm-2">make</label>
          <input name="make" id="make" required placeholder="make" value="<?php echo $make; ?>" />
      </fieldset>
      <fieldset>
          <label for="model" class="col-sm-2">model</label>
          <input name="model" id="model" required placeholder="model" value="<?php echo $model; ?>" />
      </fieldset>
      <fieldset>
          <label for="engine" class="col-sm-2">Engine type:</label>
          <input name="engine" id="engine" required placeholder="engine type" value="<?php echo $engine; ?>" />
      </fieldset>
      <fieldset>
          <label for="fuel" class="col-sm-2">Fuel Type:</label>
          <input name="fuel" id="fuel" required placeholder="fuel type" value="<?php echo $fuel; ?>" />
      </fieldset>
      <fieldset>
        <label for="rating" class="col-sm-2">Rating</label>
        <input name="rating" id="rating" required placeholder="rating 1 to 5" value="<?php echo $rating; ?>" />
    </fieldset>
    <fieldset>
        <label for="image" class="col-sm-2">Logo:</label>
        <input type="file" name="image" id="image" />
    </fieldset>
      <?php if (!empty($image)) {
      echo '<div class="col-sm-offset-2">
              <img title="Add Picture" src="images/' . $image . '" class="img-circle" />
          </div>';
      }
      ?>
      <input type="hidden" name="car_id" id="car_id" value="<?php echo $car_id; ?>" />
    <input type="hidden" name="current_image" id="current_image" value="<?php echo $image; ?>" />
    <button class="btn btn-primary col-sm-offset-2">Save</button>
</form>
<?php require('footer.php'); ?>
