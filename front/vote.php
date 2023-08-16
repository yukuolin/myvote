<div class="container">
    <h1>投票</h1>
    <?php
    $topic=find('topics', $_GET['id']);

    if($topic['login']==1){
        if(!isset($_SESSION['login'])){
            $_SESSION['position']="/index.php?do=vote&id={$_GET['id']}";
            ("index.php?do=login&msg=1");
        }
    }

    $options=all('options',['subject_id'=>$_GET['id']]);
    ?>

    <h2><?=$topic['subject'];?></h2>
    <?php
    if(!empty($topic['image'])){
        echo "<img src='./upload/{$topic['image']}' style='width:450px;height:300px'>";
    }
    ?>

    <form action="./api/vote.php" method="post">
        <ul class="list-group">
            <?php
            foreach($options as $idx => $opt){
                echo "<li class='list-group-item'>";
                switch($topic['type']){
                    case 1:
                        echo "<input type='radio' name='desc' value='{$opt['id']}'>";                
                        break;
                    case 2:        
                        echo "<input type='checkbox' name='desc[]' value='{$opt['id']}'>";
                        break;
                }
                
                echo "<span>".($idx+1).". </span>";
                echo "<span>{$opt['description']}</span>";
                echo "</li>";
            }
            ?>
        </ul>

        <div class="mb-3">
            <input type="hidden" name="subject_id" value="<?=$_GET['id'];?>">
            <input type="submit" value="投票" class="btn btn-primary">
            <input type="button" value="取消" class="btn btn-secondary">
        </div>

    </form>
</div>
