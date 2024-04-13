<div class="content_group">
    <div class="group_columns">
        <ul class="about_group_list">
            <?php if ($group->isNotEmpty()) : ?>

                <h3>Дисциплины группы №<?= $groupName ?>:</h3>
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
                        <a href="<?php echo app()->route->getUrl('/groups/group/evaluations'); ?>">
                            <span class="counter"><?php echo $i; ?></span>
                            <?php echo "$discipline вид контроля:$control курс:$course семестр: $semester количество часов:$hours"; ?>
                        </a>
                    </li>
                    <?php $i++; ?>
                <?php endforeach; ?>
            <?php else : ?>

                <h3>Дисциплины группы №<?= $groupName ?>:</h3>
                <p>Дисциплины отсутствуют</p>
            <?php endif; ?>
        </ul>
    </div>
    <div class="discipline_filter_content">
        <select class="discipline_filter">
            <option value="">Курс</option>
            <option>1</option>
            <option>2</option>
            <option>3</option>
            <option>4</option>
            <option>5</option>
        </select>
        <select class="discipline_filter">
            <option value="">Семестр</option>
            <option>1</option>
            <option>2</option>
        </select>

        <button class="button_ok">Ок</button>
    </div>
    <div class="group_columns_two">
        <h2>Добавить дисциплину</h2>
        <form method="post" class="add_discipline_in_group">
            <input name="csrf_token" type="hidden" value="<?= app()->auth::generateCSRF() ?>"/>
            <?php if ($group->isNotEmpty()) : ?>
                <?php $id_group = $group[0]->info_group->id; ?>
                <input type="hidden" name="group_id" value="<?= $id_group ?>">
            <?php else : ?>
                <?php $id_group = $groupId; ?>
                <input type="hidden" name="group_id" value="<?= $id_group ?>">
            <?php endif; ?>
            <select name='discipline_names' class="discipline_add_in_group">
                <option value="">Название</option>
                <?php foreach ($discipline_name as $discipline_names) : ?>
                    <option><?= $discipline_names->name ?></option>
                <?php endforeach; ?>
            </select>
            <select name='semester' class="discipline_add_in_group">
                <option value="">Семестр</option>
                <option value="1">1</option>
                <option value="2">2</option>
            </select>
            <select name='course' class="discipline_add_in_group">
                <option value="">Курс</option>
                <option value="1">1</option>
                <option value="2">2</option>
                <option value="3">3</option>
                <option value="4">4</option>
                <option value="5">5</option>
            </select>

            <select name="control_names" class="discipline_add_in_group">
                <option value="">Вид контроля</option>
                <?php foreach ($control_name as $control_names) : ?>
                    <option><?= $control_names->name ?></option>
                <?php endforeach; ?>
            </select>
            <select name="num_hours" class="discipline_add_in_group">
                <option value="">Количество часов</option>
                <option value="48">48</option>
                <option value="56">56</option>
                <option value="82">86</option>
                <option value="93">93</option>
                <option value="112">112</option>
            </select>
            <button class="button_add_discipline_in_group">Добавить</button>
        </form>
    </div>
</div>
