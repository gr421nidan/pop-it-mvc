<div class="content_group">
    <div class="group_columns">
        <ul class="about_group_list">
            <h3>Дисциплины группы №<?= $groupName ?>:</h3>
            <h4><a href="<?php echo app()->route->getUrl('/groups/group/addDiscipline?id='.$groupId); ?>">Добавить дисциплину к группе</a></h4>
            <?php if ($group->isNotEmpty()) : ?>
                <?php $i = 1; ?>
                <?php foreach ($group as $groups) : ?>
                    <?php
                    $discipline = $groups->discipline->name;
                    $control = $groups->control->name;
                    $hours = $groups->number_hours;
                    $course = $groups->course;
                    $semester = $groups->semester;
                    ?>
                    <li class="student_in_list">
                        <a href="<?php echo app()->route->getUrl('/groups/group/evaluations?id='.$groupId); ?>">
                            <span class="counter"><?php echo $i; ?></span>
                            <?php echo "$discipline вид контроля:$control курс:$course семестр: $semester количество часов:$hours"; ?>
                        </a>
                    </li>
                    <?php $i++; ?>
                <?php endforeach; ?>
            <?php else : ?>
                <p>Дисциплины отсутствуют</p>
            <?php endif; ?>
        </ul>
    </div>
    <div class="group_columns_two">
        <div class="discipline_filter_content">
            <form method="post" name="filter">
                <input name="csrf_token" type="hidden" value="<?= app()->auth::generateCSRF() ?>"/>
                <select name="course" class="discipline_filter">
                    <option value="">Курс</option>
                    <option>1</option>
                    <option>2</option>
                    <option>3</option>
                    <option>4</option>
                    <option>5</option>
                </select>
                <select name="semester" class="discipline_filter">
                    <option value="">Семестр</option>
                    <option>1</option>
                    <option>2</option>
                </select>
                <button type="submit" class="button_ok">Ок</button>
            </form>
        </div>
    </div>
</div>