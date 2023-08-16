<div class="container">
    <h1>投票結果</h1>
    <?php
$id = $_GET['id'];
$options = $pdo->query("SELECT * FROM options WHERE subject_id = $id")->fetchAll(PDO::FETCH_ASSOC);
$subject = $pdo->query("SELECT * FROM topics WHERE id = $id")->fetch(PDO::FETCH_ASSOC);
?>
    <h2><?=$subject['subject'];?></h2>
    <ul class="vote-result list-group">
        <li class="list-group-item active">
            <div class="row vote-option-title">
                <div class="col">序號</div>
                <div class="col">項目</div>
                <div class="col">票數</div>
            </div>
        </li>
        
        <?php 
        foreach($options as $idx => $option){
        ?>
        <li class="list-group-item vote-option">
            <div class="row">
                <div class="col"><?=$idx+1;?>.</div>
                <div class="col"><?=$option['description'];?></div>
                <div class="col"><?=$option['total'];?></div>
            </div>
        </li>
        <?php
        }
        ?>
    </ul>
</div>
