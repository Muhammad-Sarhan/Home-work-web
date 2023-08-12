
<?php
if (isset($_GET['id'])) {
    $id = $_GET['id'];
} else {
    $id = 1; // تعيين قيمة افتراضية للمتغير إذا لم يتم تمريره في الـ URL
}

//echo $id;
?>
<?php

include '../config.php';

session_start();

$user_id = $_SESSION['user_id'];

if (!isset($user_id)) {
  header('location:login.php');
}

?>

<?php
$select_profile = $conn->prepare("SELECT * FROM `users` WHERE id = ?");
$select_profile->execute([$user_id]);
$fetch_profile = $select_profile->fetch(PDO::FETCH_ASSOC);
?>

<?php


$servername = "localhost";
$username = "root";
$password = "";
$dbname = "homework";
$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
$sql = "SELECT * FROM users WHERE id = $id";
$result = $conn->query($sql);




while ($row = $result->fetch_assoc()) {
    $idem = $row["id"];
    $nameer = $row["name"];
    $emailee = $row["email"];
    $imageee = $row["image"];
};
// echo "welcome " . $name . " in profile " . $nameer;



?>

<?php
// Connect to your database
$host = 'localhost';
$username = 'root';
$password = '';
$dbname = 'homework';

$conn = mysqli_connect($host, $username, $password, $dbname);

// Check if there is a row in the database with the same specifications
$query = "SELECT COUNT(id) as count FROM `folwers` WHERE admin_id = '$id'";
$result = mysqli_query($conn, $query);

if ($result) {
  // Fetch the result as an associative array
  $row = mysqli_fetch_assoc($result);
  // Get the count of rows
  $numberfollow = $row['count'];
} else {
  // Handle the error if the query fails
  echo "Error: " . mysqli_error($conn);
}

// Close the database connection
mysqli_close($conn);
?>


<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Responsive Profile Page</title>
  <!-- Font Awesome -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css" />
  <!-- CSS -->
  <link rel="stylesheet" href="../css/cssprofile.css" />
</head>

<body>
  <div class="header__wrapper">
    <header></header>
    <div class="cols__container">
      <div class="left__col">
        <div class="img__container">
          <img src="../uploaded_img/<?= $fetch_profile['image']; ?>" alt="Anna Smith" />
          <span></span>
        </div>
        <h2><?= $fetch_profile['name']; ?></h2>


        <ul class="about">
          <li><span><?= $numberfollow; ?></span>Followers</li>
          <li><span><?= $numberfollow; ?></span>Following</li>
        </ul>

        <div class="content">
          <p>
            Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Aliquam
            erat volutpat. Morbi imperdiet, mauris ac auctor dictum, nisl
            ligula egestas nulla.
          </p>

          <ul>
            <li><i class="fab fa-twitter"></i></li>
            <i class="fab fa-pinterest"></i>
            <i class="fab fa-facebook"></i>
            <i class="fab fa-dribbble"></i>
          </ul>
        </div>
      </div>
      <div class="right__col">
        <nav>
          <ul>
            <li><a href="">posts</a></li>

          </ul>
          <?php include("follow.php"); ?>
          <a href="<?php echo $button_link; ?>">
            <button class="<?php echo $button_class; ?>">
              <span class="button-text"><?php echo $button_text; ?></span>
            </button></a>
        </nav>

        <div class="photos">
          
        </div>
      </div>
    </div>
  </div>
</body>

</html>