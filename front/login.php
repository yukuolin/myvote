<div class="container">
    <h1>會員登入</h1>
    <?php
    if(isset($_GET['error'])){
        echo "<span style='color:red'>";
        echo "帳號或密碼錯誤";
        echo "</span>";
    }
    if(isset($_GET['msg'])){
        echo "<span style='color:orange'>";
        echo $msg[$_GET['msg']];
        echo "</span>";
    }
    ?>
    <form action="./api/login.php" method="post">
        <div class="mb-3">
            <label for="acc" class="form-label">帳號</label>
            <input type="text" name="acc" id="acc" class="form-control">
        </div>
        <div class="mb-3">
            <label for="pw" class="form-label">密碼</label>
            <input type="password" name="pw" id="pw" class="form-control">
        </div>
        <div class="mb-3">
            <input type="submit" value="登入" class="btn btn-primary">
        </div>
    </form>
</div>
