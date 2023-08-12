<?php

include 'config.php';

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


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Facebook (lite)</title>
    <link rel="stylesheet" href="css/css-posts/owl.carousel.min.css">
    <link rel="stylesheet" href="css/css-posts/owl.theme.default.css">
    <link rel="stylesheet" href="css/css-posts/stylefacbook.css">
</head>

<body>
    <!--navbar-->
    <nav>
        <!--logo and search-->
        <div class="left-side">
            <div class="logo">
                <img src="image/icons/facebook.svg" alt="">
            </div>

            <form action="search.php" method="get">
                <div class="search">
                    <input type="text" placeholder="Search Facebook" name="query" id="">
                    <button type="submit">search</button>
                </div>
            </form>
        </div>

        <!--tab icons-->
        <div class="tabs">
            <div class="tab-icon active">
                <div class="icon">
                    <img src="image/icons/home.svg" alt="">
                </div>
            </div>
        </div>

        <!--right side-->
        <div class="right-side">
            <div class="user">
                <div class="profile">
                    <img src="uploaded_img/<?= $fetch_profile['image']; ?>" alt="">
                </div>
                <h4><?= $fetch_profile['name']; ?></h4>
            </div>

            <!--icons-->

        </div>
    </nav>


    <!--content-->
    <div class="wrapper">
        <div class="shortcuts">
            <div class="first-col">
                <div class="menu-item">


                    <div class="user">
                        <div class="profile">
                            <img src="uploaded_img/<?= $fetch_profile['image']; ?>" alt="">
                        </div>
                        <h4><?= $fetch_profile['name']; ?></h4>
                    </div>

                </div>



                <div class="menu-item">
                    <div class="item-row">
                        <div class="icon">
                            <img src="image/icons/colored-people.svg" alt="">
                        </div>
                        <h4>Friends </h4>
                    </div>
                </div>

            </div>

            <div class="menu-item">
                    <div class="item-row">
                        <div class="icon">
                            <img src="image/icons/colored-people.svg" alt="">
                        </div>
                        <h4>Chat</h4>
                    </div>
                </div>

        </div>



        <!--posts-->
        <div class="posts">


            <!--create post-->
            <div class="timeline">
                <div class="view create-post">
                    <form method="post" action="<?php echo "upload-post.php?id=" . $user_id ?>" enctype="multipart/form-data">
                        <div class="input">
                            <div class="user">
                                <div class="profile">
                                    <img src="uploaded_img/<?= $fetch_profile['image']; ?>" alt="">
                                </div>
                            </div>
                            <input type="text" placeholder="What on your mind, <?= $fetch_profile['name']; ?>?" name="post_text" id="post">
                            <button id="button-post" style="display:none; border-radius: 20px; width:50px; height: 40px; color: #fff; background: blue; border: none;"><img src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAADAAAAAwCAYAAABXAvmHAAAACXBIWXMAAAsTAAALEwEAmpwYAAACR0lEQVR4nO2YT2/SYBzHn6QvBFlZYa2ldF59G/oGlhijZnrbadqj70MUFQFtgQ6oMUr8c9G78coGK23nVS8/U9onPG1aAiPj4TH9JJ/LQtvP97T2QSgjI+P/Rhm4GnegA3enC9zdPnD33gN3/wNwDz4CdzgE7uHn0C+Bj74Sfgsl/oZ/h687HAb38u/p39t/hv+sAx0qA+/pevGmqyknLtAaoJy4UDady42QO1NN7jrgS2uAHD5f7qw4QjKmmtSeApbWAIlokNr2ciNE3X4i6jaQ0hogxjr8toXxQtO+XWqdQ1xaA0oJLcWmfSt9QGP8Q2hMIC6ihJDQIryZfE+9gK+P/xbqE4iLKFFIaOHrkz+pF/Avx5DkRqvX6cm/OIMkESXyq/bkno2GueopRB192mj1Fvewx42Bd9MXsci+5T3ety5AtS6gYnmL/wFtG6r1+0i1PFAHgZXA9d4sN4Xad4/CYKj0o5Z7Wz5C8eOJYKXn685d5/X4qlF6rpYYTGpit2yEMotfFOyCbIbv9pd9x78qyqZzvFRw14HrnZiGc0x/QNf9JS8b3HaiHyn69CfaRtKCEStIONqYKxosDTCCYFHHBp+EiBXEMHjvXVTECns4+q0NJULECiUcTX6Mt84ZGtAKgovNqIgVimGw0MDSPd1YGeIIBHYJESvs4uj6XJrHMyuDgwuvxxERKxTCYP5VVMQKPI6eHUSdwU4oYoUdHF2bm6+xNKAWBEdP1E7ZGZAPg689j4pYIVcdDWfR1cDsSDAjIwOl8Q+JKJ01lP3r8wAAAABJRU5ErkJggg==" style="width: 30px;"></button>
                            <script>
                                const inputField = document.querySelector('#post');
                                const myButton = document.querySelector('#button-post');

                                inputField.addEventListener('input', function() {
                                    if (inputField.value.length > 0) {
                                        myButton.style.display = 'block';
                                    } else {
                                        myButton.style.display = 'none';
                                    }
                                });
                            </script>
                        </div>
                        <div class="media">
                            <div class="category">


                                <div class="option">
                                    <div class="icon">
                                        <label for="file-upload">
                                            <img src="image/icons/photos.svg" alt="">
                                        </label>
                                        <input id="file-upload" name="file" type="file" style="opacity: 0; pointer-events: none;">
                                    </div>
                                    <span>photo/video</span>
                                </div>

                                <div class="option">
                                    <div class="icon">
                                        <img src="image/icons/smile.svg" alt="">
                                    </div>
                                    <span>feeling/activity</span>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>


                <!--post container-->
                <?php
                $servername = "localhost";
                $username = "root";
                $password = "";
                $dbname = "homework";
                $conn = new mysqli($servername, $username, $password, $dbname);
                if ($conn->connect_error) {
                    die("Connection failed: " . $conn->connect_error);
                }

                $sql = "SELECT * FROM posts ORDER BY id DESC"; // Order the posts by ID in descending order
                $result = $conn->query($sql);

                if ($result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {
                        $id_post = $row['id'];
                        $name_uploader = $row['username'];
                        $img_user = $row['image_user'];
                        $id_usr = $row['id_user'];
                        $postdate = $row['post_date'];
                        $post_text = $row['post_text'];



                ?>


                        <div class="view view-post-container smaller-margin">
                            <div class="view-post">
                                <div class="upper">
                                    <a href="<?= "profile-page/index.php?id=" .  $id_usr ?>">
                                        <div class="d-flex">
                                            <div class="user">
                                                <div class="profile">
                                                    <img src="uploaded_img/<?= $fetch_profile['image']; ?>" alt="">
                                                </div>
                                            </div>

                                            <div class="info">
                                                <h6 class="name">
                                                    <?= $name_uploader; ?>
                                                </h6>
                                                <span class="time">1 hour ago</span>
                                            </div>
                                        </div>
                                    </a>

                                    <div class="dots">
                                        <div class="dot"></div>
                                    </div>
                                </div>

                                <div class="desc">
                                    <p><?= $post_text; ?></p>
                                </div>

                                <div class="post-img">
                                    <img src="uploads/<?= $postdate; ?>" alt="">
                                </div>
                            </div>
                        </div>


                <?php
                    }
                } else {
                    header("location: error.php");
                }

                ?>





                <script src="js/jquery.min.js"></script>
                <script src="js/owl.carousel.min.js"></script>
                <script src="js/index.js"></script>
</body>

</html>