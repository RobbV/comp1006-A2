<?php require('auth.php');
      $page_title = "Home";
      require('header.php');
// connect
require ('db.php');
//prepare the query
$sql = "SELECT * FROM cars";
$cmd = $conn -> prepare($sql);
// run the query and store the results
$cmd -> execute();
$cars = $cmd -> fetchAll();
//start the grid with html
echo '<table class="table table-striped"><thead><th>Car ID</th><th>Make</th><th>Model</th><th>Engine Type</th><th>Fuel Type</th><th>Rating</th><th>Image</th><th>Edit</th><th>Delete</th></thead><tbody>';

foreach ($cars as $car) {
    echo '<tr><td>' . $car['car_id'] . '</td>
  <td>' . $car['make'] . '</td>
  <td>' . $car['model'] . '</td>
  <td>' . $car['engine'] . '</td>
  <td>' . $car['fuel'] . '</td>
  <td>' . $car['rating'] . '</td>
  <td>' . $car['image'] . '</td>
  <td><a href="register_cars.php?car_id=' . $car['car_id'] . '" title="Edit">Edit</a></td>
  <td><a href="delete-car.php?car_id=' . $car['car_id'] . '"
    title="Delete" class="confirmation">Delete</a></td>
</tr>';
}
// close the html grid
echo '</tbody></table>';
$conn = null;
require('footer.php'); ?>
