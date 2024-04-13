<div class="content_group">
    <div class="group_columns">
        <ul class="about_group_list">
            <h3>Дисциплины группы №<?= $group[0]->info_group->name ?>:</h3>
            <?php $i = 1;
            foreach ($group as $groups) :
                $discipline = $groups->discipline->name;
                $control = $groups->control->name;
                $hours = $groups->number_hours;
                $course = $groups->course;
                $semester = $groups->semester; ?>
                <li class="student_in_list">
                    <a href="<?php echo app()->route->getUrl('/groups/group/evaluations'); ?>">
                        <span class="counter"><?php echo $i; ?></span>
                        <?php echo "$discipline вид контроля:$control курс:$course семестр: $semester количество часов:$hours"; ?>
                    </a>
                </li>
                <?php $i++; ?>
            <?php endforeach; ?>
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
            <select class="discipline_add_in_group">
                <option value="">Название</option>
                <option value="math">Математика</option>
                <option value="history">История</option>
            </select>
            <select class="discipline_add_in_group">
                <option value="">Семестр</option>
                <option value="1">1</option>
                <option value="2">2</option>
            </select>
            <select class="discipline_add_in_group">
                <option value="">Курс</option>
                <option value="1">1</option>
                <option value="2">2</option>
                <option value="3">3</option>
                <option value="4">4</option>
                <option value="5">5</option>
            </select>
            <select class="discipline_add_in_group">
                <option value="">Вид контроля</option>
                <option value="1">Экзамен</option>
                <option value="2">Практика</option>
                <option value="3">Семинар</option>
                <option value="4">Коллоквиум</option>
            </select>
            <select class="discipline_add_in_group">
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

