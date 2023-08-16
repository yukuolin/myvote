<?php include_once "db.php"; ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>投票所</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- <link rel="stylesheet" href="./css/style.css"> -->
    <style>
    .topnav {
     background-color: #333;
     overflow: hidden;
     position: fixed;
     margin-left: 500px;
     width: 1024px;
     z-index: 10;
     top: 0;
     border-radius: 0 0 20px 20px;
     box-shadow: 2px 2px 5px #555;
        }
    * {
      margin: 0;
      padding: 0;
    }

    .tab {
      width: 590px;
      height: 340px;
      margin: 20px;
      border: 1px solid #e4e4e4;
    }

    .tab-nav {
      width: 100%;
      height: 60px;
      line-height: 60px;
      display: flex;
      justify-content: space-between;
    }

    .tab-nav h3 {
      font-size: 24px;
      font-weight: normal;
      margin-left: 20px;
    }

    .tab-nav ul {
      list-style: none;
      display: flex;
      justify-content: flex-end;
    }

    .tab-nav ul li {
      margin: 0 20px;
      font-size: 14px;
    }

    .tab-nav ul li a {
      text-decoration: none;
      border-bottom: 2px solid transparent;
      color: #333;
    }

    .tab-nav ul li a.active {
      border-color: #e1251b;
      color: #e1251b;
    }

    .tab-content {
      padding: 0 16px;
    }

    .tab-content .item {
      display: none;
      /* width: 300px;
      height: 300px; */
    }

    .tab-content .item.active {
      display: block;
      /* width: 300px;
      height: 300px; */
    }

    .tab-content .item.active img {
      display: block;
      width: 550px;
      height: 250px;
    }

    .countdown {
      width: 240px;
      height: 305px;
      text-align: center;
      line-height: 1;
      color: #fff;
      background-color: brown;
      /* background-size: 240px; */
      /* float: left; */
      overflow: hidden;
      margin: 50px 0px 50px 825px
    }

    .countdown .next {
      font-size: 16px;
      margin: 25px 0 14px;
    }

    .countdown .title {
      font-size: 33px;
    }

    .countdown .tips {
      margin-top: 80px;
      font-size: 23px;
    }

    .countdown small {
      font-size: 17px;
    }

    .countdown .clock {
      width: 142px;
      margin: 18px auto 0;
      overflow: hidden;
    }

    .countdown .clock span,
    .countdown .clock i {
      display: block;
      text-align: center;
      line-height: 34px;
      font-size: 23px;
      float: left;
    }

    .countdown .clock span {
      width: 34px;
      height: 34px;
      border-radius: 2px;
      background-color: #303430;
    }

    .countdown .clock i {
      width: 20px;
      font-style: normal;
    }
    </style>
</head>

<body>
    <header class="topnav navbar navbar-expand-lg navbar-light bg-light">
        <div class="container">
            <a class="navbar-brand" href="index.php">投好壯壯投票所</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a class="nav-link" href="index.php">首頁</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="index.php?do=result_list">結果</a>
                    </li>
                </ul>
                <?php if (!isset($_SESSION['login'])) : ?>
                    <ul class="navbar-nav ms-auto">
                        <li class="nav-item">
                            <a class="nav-link" href="index.php?do=login">登入</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="index.php?do=reg">註冊</a>
                        </li>
                    </ul>
                <?php else : ?>
                    <ul class="navbar-nav ms-auto">
                        <li class="nav-item">
                            <a class="nav-link" href="./api/logout.php">登出</a>
                        </li>
                        <?php switch ($_SESSION['pr']):
                            case "super": ?>
                                <li class="nav-item">
                                    <a class="nav-link" href="backend.php?do=super">系統管理</a>
                                </li>
                            <?php break;
                            case "member": ?>
                                <li class="nav-item">
                                    <a class="nav-link" href="backend.php?do=member">會員中心</a>
                                </li>
                            <?php break;
                            case "admin": ?>
                                <li class="nav-item">
                                    <a class="nav-link" href="backend.php?do=admin">管理</a>
                                </li>
                        <?php break;
                        endswitch; ?>
                    </ul>
                <?php endif; ?>
            </div>
        </div>
    </header>
    <main class="container" style="margin-top:100px">
        <?php
        $do = $_GET['do'] ?? 'list';
        $file = "./front/" . $do . ".php";
        if (file_exists($file)) {
            include $file;
        } else {
            include "./front/list.php";
        }
        ?>
    </main>
    <div class="countdown">
    <p class="next">把握機會</p>
    <p class="title">投票倒數</p>
    <p class="clock">
      <span id="hour">00</span>
      <i>:</i>
      <span id="minutes">25</span>
      <i>:</i>
      <span id="scond">20</span>
    </p>
    <p class="tips">結束時間-> 18:30</p>
  </div>
  <script>
    //倒計時器
    function getRandomColor(flag = true) {
      if (flag) {
        let str = '#'
        let arr = ['0', '1', '2', '3', '4', '5', '6', '7', '8', '9', 'a', 'b', 'c', 'd', 'e', 'f']
        for (let i = 1; i <= 6; i++) {
          let random = Math.floor(Math.random() * arr.length)
          str += arr[random]
        }
        return str

      } else {
        let r = Math.floor(Math.random() * 256)  // 55
        let g = Math.floor(Math.random() * 256)  // 89
        let b = Math.floor(Math.random() * 256)  // 255
        return `rgb(${r},${g},${b})`
      }

    }

    const countdown = document.querySelector('.countdown')
    countdown.style.backgroundColor = getRandomColor()
    function getCountTime() {
      const now = +new Date()
      const last = +new Date('2223-12-1 18:30:00')
      const count = (last - now) / 1000
      let h = parseInt(count / 60 / 60 % 24)
      h = h < 10 ? '0' + h : h
      let m = parseInt(count / 60 % 60)
      m = m < 10 ? '0' + m : m
      let s = parseInt(count % 60)
      s = s < 10 ? '0' + s : s
      console.log(h, m, s)

      document.querySelector('#hour').innerHTML = h
      document.querySelector('#minutes').innerHTML = m
      document.querySelector('#scond').innerHTML = s
    }
    getCountTime()

    setInterval(getCountTime, 1000)

  </script>

    <footer class="footer mt-auto py-3 bg-light" style="text-align:center">
        copyright yukuolin in 職訓局
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>