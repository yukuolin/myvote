<?php include_once "db.php";
$do = '';
if (isset($_GET['do'])) {
    $do = $_GET['do'];
} else {
    if (isset($_SESSION['pr'])) {
        $do = $_SESSION['pr'];
    } else {
        $do = "error";
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>管理後台</title>
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
</head>

<body>
    <header>
        <nav class="navbar navbar-expand-lg navbar-light bg-success">
            <a class="navbar-brand" href="index.php">網站首頁</a>
            <a class="navbar-brand" href="backend.php">管理首頁</a>
            <a class="navbar-brand" href="./api/logout.php">登出</a>
            <?php
            switch ($_SESSION['pr']) {
                case "super":

                    break;
                case "admin":
                    echo "<div class='collapse navbar-collapse' id='navbarNav'>";
                    echo "<ul class='navbar-nav'>";
                    echo "    <li class='nav-item'>";
                    echo "        <a class='nav-link' href='./backend.php?do=add_vote'>新增投票</a>";
                    echo "    </li>";
                    echo "    <li class='nav-item'>";
                    echo "        <a class='nav-link' href='./backend.php?do=query_vote'>投票明細管理</a>";
                    echo "    </li>";
                    echo "</ul>";
                    echo "</div>";
                    break;
                case "member":
                    echo "<div class='collapse navbar-collapse' id='navbarNav'>";
                    echo "<ul class='navbar-nav'>";
                    echo "    <li class='nav-item'>";
                    echo "        <a class='nav-link' href='./backend.php?do=edit_self'>修改個人資料</a>";
                    echo "    </li>";
                    echo "    <li class='nav-item'>";
                    echo "        <a class='nav-link' href='./backend.php?do=vote_history'>投票紀錄查詢</a>";
                    echo "    </li>";
                    echo "</ul>";
                    echo "</div>";
                    break;
            }
            ?>
        </nav>
    </header>
    <main>
        <?php
        $file = "./back/" . $do . ".php";
        if (file_exists($file)) {
            include $file;
        } else {
            include "./back/error.php";
        }
        ?>
    </main>
    <footer></footer>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"></script>
</body>

</html>
