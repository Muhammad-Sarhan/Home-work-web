<?php
$host = 'localhost';
$dbname = 'facebook-clone';
$username = 'root';
$password = '';

$connection = mysqli_connect($host, $username, $password, $dbname);

if (!$connection) {
    die("Connection failed: " . mysqli_connect_error());
}

?>

<?php
if (isset($_GET['query'])) {
    $search_term = mysqli_real_escape_string($connection, $_GET['query']);

    $query = "SELECT * FROM posts WHERE post_text LIKE '%$search_term%' OR username LIKE '%$search_term%' OR post_text LIKE '%$search_term% %' OR username LIKE '%$search_term% %'";

    $result = mysqli_query($connection, $query);

    if (mysqli_num_rows($result) > 0) {
        while ($row = mysqli_fetch_assoc($result)) {
            
        }
    } else {
        echo "No results found.";
    }
}
?>