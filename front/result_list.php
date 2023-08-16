<div class="container">
    <h1>選擇你想看的投票項目</h1>
    <ul class="vote-result list-group">
        <li class="list-group-item active">
            <div class="row vote-option-title">
                <div class="col">序號</div>
                <div class="col">主題</div>
                <div class="col">票數</div>
            </div>
        </li>
        <?php
        $totalVotes = $pdo->query("SELECT sum(total) FROM options")->fetchColumn();

        $subjects = $pdo->query("SELECT topics.id,
                                   topics.subject,
                                   sum(options.total) as '總計'
                            FROM topics, options 
                            WHERE topics.id = options.subject_id 
                            GROUP BY topics.id;")->fetchAll(PDO::FETCH_ASSOC);
        ?>
        <?php
        foreach ($subjects as $idx => $subject) {
        ?>
            <li class="fw-semibold fs-3 text-primary-emphasis list-group-item vote-option">
                <div class="row">
                    <div class="col"><?= $idx + 1; ?>.</div>
                    <div class="col">
                        <a href="index.php?do=result&id=<?= $subject['id']; ?>"><?= $subject['subject']; ?></a>
                    </div>
                    <div class="col"><?= $subject['總計']; ?></div>
                </div>
            </li>
        <?php
        }
        ?>
    </ul>
</div>