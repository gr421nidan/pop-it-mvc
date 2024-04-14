<div class="content_discipline">
    <div class="grade_columns">
        <h1>Успеваемость студентов по группам и дисциплинам</h1>
        <ul class="discipline_list">
            <?php
            if($notEmpty):
                $i=1;
                foreach ($gradeList as $grade): ?>
                    <li><span class='counter_grade'><?=$i?></span><?= $grade['student'] ?> <?= $grade['group'] ?>гр. <?= $grade['discipline'] ?> <?= $grade['evaluation'] ?></li>
                    <?php $i++;
                endforeach; ?>
            <?php else : ?>
                <h5>Совпадений не найдено</h5>
            <?php endif; ?>
        </ul>
    </div>
    <div class="grade_columns_two">
        <form method="post">
            <input name="csrf_token" type="hidden" value="<?= app()->auth::generateCSRF() ?>"/>
            <select name="groups" class="discipline_filter">
                <option value="">Группы</option>
                <?php
                foreach ($groupsGrades as $groupsGrade){
                    echo "<option value=\"$groupsGrade->id\">$groupsGrade->name</option>";
                }
                ?>
            </select>
            <select name="disciplines" class="discipline_filter">
                <option value="">Дисциплины</option>
                <?php
                foreach ($disciplinesGrades as $disciplinesGrade){
                    echo "<option value=\"$disciplinesGrade->id\">$disciplinesGrade->name</option>";
                }
                ?>
            </select>
            <button class="button_ok">Применить</button>
            <button class="button_ok"><a href="<?php echo app()->route->getUrl('/gradeStudents'); ?>">Сбросить</a></button>
        </form>


    </div>
</div>