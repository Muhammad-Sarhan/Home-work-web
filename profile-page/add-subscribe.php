<?php
if (isset($_GET['id'])) {
    $id = $_GET['id'];
} else {
    $id = 1; // تعيين قيمة افتراضية للمتغير إذا لم يتم تمريره في الـ URL
}
//echo $id;
?>


<?php
if (isset($_GET['admin_id'])) {
    $admin_id = $_GET['admin_id'];
} else {
    $admin_id = 1; // تعيين قيمة افتراضية للمتغير إذا لم يتم تمريره في الـ URL
}

//echo $admin_id;
?>

<?php

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "homework";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$sql = "INSERT INTO `folwers` (`id`, `flwer_id`, `admin_id`) VALUES (NULL, '$id', '$admin_id')";
$result = $conn->query($sql);

header('Location: index.php?id='. $admin_id);


?>
<!-- <footer><p>&copy; 2023 Social Fuse All rights reserved.</p></footer> -->
