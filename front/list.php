<ul class="vote-list list-group">
    <li class="list-group-item active">
        <div class="row vote-subject-title">
            <div class="col">序號</div>
            <div class="col">投票主題</div>
            <div class="col">功能</div>
        </div>
    </li>
    <?php
    //$sql="select * from `topics` where `close_time` >= '".date("Y-m-d H:i:s")."'";
    //$rows=$pdo->query($sql)->fetchAll();

    //$rows=all('topics');
    $rows = q("select * from `topics` where `close_time` >= '" . date("Y-m-d H:i:s") . "'");

    foreach ($rows as $idx => $row) {
    ?>
        <li class="fw-semibold fs-3 text-primary-emphasis list-group-item vote-subject">
            <div class="row">
                <div class="col"><?= $idx + 1; ?></div>
                <div class="col"><?= $row['subject']; ?></div>
                <div class="col">
                    <button class="btn btn-info rounded-pill">
                        <?php
                        switch ($row['type']) {
                            case 1:
                                echo "單選";
                                break;
                            case 2:
                                echo "多選";
                                break;
                        }
                        ?>
                    </button>
                    <?php
                    if ($row['login'] == 1) {
                        echo "<button class='btn btn-warning rounded-pill'>";
                        echo "會員";
                        if (!empty($_SESSION['login'])) {
                    ?>
                            <button onclick="location.href='?do=vote&id=<?= $row['id']; ?>'" class="fw-semibold fs-4 btn btn-link">我要投票</button>
                        <?php
                        } else {
                        ?>
                            <button onclick="location.href='?do=login ?>'" class="fw-semibold fs-4 btn btn-link ">我要投票</button>
                        <?php
                        }
                    } else {
                        echo "<button class='btn btn-success rounded-pill'>";
                        echo "公開";
                        ?>
                        <button onclick="location.href='?do=vote&id=<?= $row['id']; ?>'" class="fw-semibold fs-4 btn btn-link">我要投票</button>
                    <?php
                    }
                    ?>
                    </button>
                </div>
            </div>
        </li>
    <?php
    }
    ?>
</ul>