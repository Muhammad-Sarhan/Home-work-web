<?php
if (isset($_GET['id'])) {
    $id = $_GET['id'];
} else {
    $id = 1; // Set a default value for the variable if it's not passed in the URL
}

// Connect to the database
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "homework";
$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Retrieve user data based on the ID
$sql = "SELECT * FROM users WHERE id = $id";
$result = $conn->query($sql);

// Extract user information from the query result
if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    $id_user = $row['id'];
    $name = $row['name'];
    $mail =  $row['email'];
    $img_usr = $row['image'];
} else {
    header("location: error.php");
}

// Get the uploaded file and its properties
$file = $_FILES['file'];
$fileName = $file['name'];
$fileTempName = $file['tmp_name'];
$fileSize = $file['size'];
$fileError = $file['error'];
$post_text = $_POST['post_text'];

// Check if the file type is valid
if (isset($fileName) && !empty($fileName)) {
    $fileExt = strtolower(pathinfo($fileName, PATHINFO_EXTENSION));
    if ($fileExt == "jpg" || $fileExt == "jpeg" || $fileExt == "png") {
        // Process image file
    } elseif ($fileExt == "mp4") {
        // Process video file
    } else {
        $fileName = NULL;
        $errorMsg = 'Invalid file type. Please upload an image (JPG, JPEG, PNG) or a video (MP4).';
    }
} else {
    $errorMsg = 'Please select a file to upload.';
}

// Display error message if there is any
if (!empty($errorMsg)) {
    echo '<p>' . $errorMsg . '</p>';
    exit();
}

// Generate a random file name to avoid conflicts
$randomName = uniqid('', true) . '.' . pathinfo($fileName, PATHINFO_EXTENSION);

// Check if the file was uploaded successfully
if ($fileError === UPLOAD_ERR_OK) {
    // Prepare the SQL statement
    $sql = "INSERT INTO `posts`(`id`, `username`, `image_user`, `id_user`, `post_date`, `post_text`) VALUES (NULL, ?, ?, ?, '$randomName', ?)";

    // Prepare the statement for execution
    $stmt = mysqli_prepare($conn, $sql);

    // Bind the parameters to the statement
    mysqli_stmt_bind_param($stmt, "ssss", $name, $img_usr, $id_user, $post_text);

    // Execute the statement
    mysqli_stmt_execute($stmt);

    // Close the statement
    mysqli_stmt_close($stmt);

    // Move the uploaded file to the desired location
    move_uploaded_file($fileTempName, "uploads/" . $randomName);

    header("location: Home.php");
} else {
    header("location: error.php");
}

// Close the database connection
mysqli_close($conn);
?>