<?php
include "connection.php";
error_reporting(E_ERROR | E_WARNING | E_PARSE);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
</head>
<body>
<form action="connection.php" method="GET">
    <div>course_id<input type="text" name="course_id"></div>
    <div>course_name<input type="text" name="course_name"></div>
    <div>course_lecturer<input type="text" name="course_lecturer"></div>
    <div>course_duration<input type="text" name="course_duration"></div>
    <div>course_date<input type="text" name="course_date"></div>
<input type="submit" name="add" value="ADD">
<input type="submit" name="delete" value="delete">
<input type="submit" name="update" value="UPDATE">
</form>



<!-- create table -->


<table class="table">
  <thead class="thead-light">
    <tr>
      <th scope="col">course_id</th>
      <th scope="col">course_name</th>
      <th scope="col">course_lecturer</th>
      <th scope="col">course_duration</th>
      <th scope="col">course_date</th>
    </tr>
  </thead>
  <tbody>
    <?php
    $res = mysqli_query($connection,"select * from course");
    while($row = mysqli_fetch_array($res)){
        echo "<tr>";
        echo "<td>";echo $row["course_id"]; echo "</td>";
        echo "<td>";echo $row["course_name"]; echo "</td>";
        echo "<td>";echo $row["course_lecturer"]; echo "</td>";
        echo "<td>";echo $row["course_duration"]; echo "</td>";
        echo "<td>";echo $row["course_date"]; echo "</td>";
        echo "</tr>";
    }
    ?>
  </tbody>
</table>
</body>
</html>