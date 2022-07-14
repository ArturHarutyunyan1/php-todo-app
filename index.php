<?php
include './src/auth/auth.php';
require './src/db.php';

$author = $_SESSION['email'];
$sql = "SELECT * FROM `todos` WHERE author = '$author'";
$result = mysqli_query($con, $sql);
$rows = mysqli_num_rows($result);

?>
<!DOCTYPE html>
<html lang="en" data-theme="dark">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Todo</title>
    <link rel="shortcut icon" href="./assets/img/favicon-32x32.png" type="image/x-icon">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css" integrity="sha512-KfkfwYDsLkIlwQp6LFnl8zNdLGxu9YAA1QvwINks4PhcElQSvqcyVLLD9aMhXd13uQjoXtEKNosOWaZqXgel0g==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="./assets/css/style.css">
</head>
<body>
    <header></header>
    <div class="container">
        <div class="content">
            <div class="space-btw">
                <h1>TODO</h1>
                <div class="theme-switcher">
                    <label for="switcher">
                        <input type="checkbox" id="switcher">
                        <img src="./assets/img/icon-moon.svg" alt="Moon" class="dark">
                        <img src="./assets/img/icon-sun.svg" alt="Sun" class="light">
                    </label>
                </div>
            </div>
            <form class="input-bar form" method="post" action="./src/config.php">
                <button class="add-button" name="add">
                    <i class="fa-solid fa-plus"></i>
                </button>
                <input type="text" name="todo" class="input" placeholder="Create a new todo...">
            </form>
            <form class="todos" method="post" action="./src/config.php">
                <ul class="row">
                    <?php if($rows === 0) {?>
                        <div class="clear">
                        <i class="fa-solid fa-circle-check"></i>
                            <h1>You have completed all your tasks!</h1>
                        </div>
                    <?php }?>
                    <?php while($todos = mysqli_fetch_assoc($result)) {?>
                        <?php if($todos['status']) {?>
                            <li class="row-item">
                                <button class="check checked-button" name="check" value="<?php echo $todos['id']; ?>">
                                    <img src="./assets/img/icon-check.svg" alt="Check">
                                </button>
                                <p class="todo checked-text">
                                    <?php echo $todos['todo']; ?>
                                </p>
                                <button class="remove" name="remove" value="<?php echo $todos['id'] ?>">
                                    <img src="./assets/img/icon-cross.svg" alt="Cross">
                                </button>
                            </li>
                            <div class="line"></div>
                            <?php }else { ?>
                                <li class="row-item">
                                    <button class="check" name="check" value="<?php echo $todos['id']; ?>">
                                        <img src="./assets/img/icon-check.svg" alt="Check">
                                    </button>
                                    <p class="todo">
                                        <?php echo $todos['todo']; ?>
                                    </p>
                                    <button class="remove" name="remove" value="<?php echo $todos['id'] ?>">
                                        <img src="./assets/img/icon-cross.svg" alt="Cross">
                                    </button>
                                </li>
                                <div class="line"></div>
                            <?php }?>
                    <?php }?>
                    <div class="footer">
                          <h4>Challenge by <a href="https://frontendmentor.io" target="_blank">Frontend Mentor</a> Coded by <a href="https://github.com/ArturHarutyunyan1" target="_blank">Artur Harutyunyan</a></h4>
                    </div>
                </ul>
            </form>
        </div>
    </div>
    <div class="dropdown">
        <div class="drop-btn">
            <?php echo $author; ?>
        </div>
        <div class="dropdown-content">
            <a href="./src/auth/logout.php">Log Out</a>
        </div>
    </div>
    <script src="./assets/js/script.js"></script>
</body>
</html>