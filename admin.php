<ul class="list-group">
  <li class="list-group-item">
    <div class="row">
      <div class="col-2"><strong>主題</strong></div>
      <div class="col-2"><strong>狀態</strong></div>
      <div class="col-2"><strong>期間</strong></div>
      <div class="col-2"><strong>投票數</strong></div>
      <div class="col-4"><strong>操作</strong></div>
    </div>
  </li>
  <?php
  $sql = "SELECT `topics`.*, sum(`options`.`total`) as '總計'
          FROM `topics`,`options` 
          WHERE `topics`.`id`=`options`.`subject_id` 
          GROUP BY `topics`.`id`;";
  $rows = $pdo->query($sql)->fetchAll(PDO::FETCH_ASSOC);
  foreach ($rows as $row) {
    ?>
    <li class="list-group-item">
      <div class="row">
        <div class="col-2"><?=$row['subject'];?></div>
        <div class="col-2">
          <?php
          $now = strtotime('now');
          $open = strtotime($row['open_time']);
          $close = strtotime($row['close_time']);
          if ($now < $open) {
            echo "<span class='badge bg-warning text-dark'>未開始</span>";
          } else if ($now >= $open && $now <= $close) {
            echo "<span class='badge bg-primary'>投票中</span>";
          } else {
            echo "<span class='badge bg-secondary'>己截止</span>";
          }
          ?>
        </div>
        <div class="col-2">
          <div><?=$row['open_time'];?></div>
          <div>至</div>
          <div><?=$row['close_time'];?></div>
        </div>
        <div class="col-2"><?=$row['總計'];?></div>
        <div class="col-4">
          <button class="btn btn-primary" onclick="location.href='./backend.php?do=edit_vote&id=<?=$row['id'];?>'">編輯</button>
          <button class="btn btn-danger" onclick="location.href='./back/del_vote.php?id=<?=$row['id'];?>'">刪除</button>
          <button class="btn btn-success" onclick="location.href='./back/open.php?id=<?=$row['id'];?>'">立即上線</button>
          <button class="btn btn-secondary" onclick="location.href='./back/close.php?id=<?=$row['id'];?>'">立即結束</button>
          <button class="btn btn-info" onclick="location.href='./backend.php?do=result&id=<?=$row['id'];?>'">投票結果</button>
        </div>
      </div>
    </li>
  <?php
  }
  ?>
</ul>  