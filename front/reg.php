<div class="container">
    <?php
    if(isset($_GET['error'])){
        echo "<span style='color:red'>";
        echo "帳號或密碼不可為空";
        echo "</span>";
    }
    ?>
    <form action="./api/reg.php" method="post">
        <div class="mb-3">
            <label for="acc" class="form-label">帳號</label>
            <input type="text" name="acc" id="acc" class="form-control">
        </div>
        <div class="mb-3">
            <label for="pw" class="form-label">密碼</label>
            <input type="password" name="pw" id="pw" class="form-control">
        </div>
        <div class="mb-3">
            <label for="name" class="form-label">姓名</label>
            <input type="text" name="name" id="name" class="form-control">
        </div>
        <div class="mb-3">
            <label for="addr" class="form-label">地址</label>
            <input type="text" name="addr" id="addr" class="form-control">
        </div>
        <div class="mb-3">
            <label for="email" class="form-label">電子郵件</label>
            <input type="text" name="email" id="email" class="form-control">
        </div>
        <div class="mb-3">
            <input type="submit" value="註冊" class="btn btn-primary">
        </div>
    </form>
</div>
