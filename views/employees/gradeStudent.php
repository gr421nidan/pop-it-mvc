<div class="content_discipline">
    <div class="discipline_columns">
        <?php if (!empty($studentGrade[0])) : ?>
            <?php
            ?>
            <h1>Успеваемость студента - <?=$studentName?></h1>
            <h4><a href="<?php echo app()->route->getUrl('/student/grade/evaluations?id='.$studentId); ?>">Поставить оценку</a></h4>
            <ul class="discipline_list">
                <?php $i = 1;
                foreach ($studentGrade as $studentGrades) :
                    $discipline = $studentGrades->disciplinesGroup->discipline->name;
                    $control = $studentGrades->disciplinesGroup->control->name;
                    $hours = $studentGrades->disciplinesGroup->number_hours;
                    $evaluations=$studentGrades->evaluations->evaluation;?>
                    <li class="student_in_list">
                        <span class="counter"><?php echo $i; ?></span>
                        <?php echo "$discipline - количество часов: $hours; вид контроля: $control; оценка: $evaluations;"; ?>
                    </li>
                    <?php $i++; ?>
                <?php endforeach; ?>
            </ul>
        <?php else : ?>
            <h1>Успеваемость студента - <?=$studentName?></h1>
            <h4>Отсутствует успеваемость</h4>
        <?php endif; ?>
    </div>
    <div class="discipline_columns_two">
        <form method="POST">
            <input name="csrf_token" type="hidden" value="<?= app()->auth::generateCSRF() ?>"/>
            <select name="control_id" class="discipline_filter">
                <option value="">Вид контроля</option>
                <?php foreach ($controls as $control): ?>
                    <option value="<?= $control->id_control ?>"><?= $control->name ?></option>
                <?php endforeach; ?>
            </select>
            <select name="hours" class="discipline_filter">
                <option value="">Количество часов</option>
                <option value="48">48</option>
                <option value="56">56</option>
                <option value="86">86</option>
                <option value="93">93</option>
                <option value="112">112</option>
            </select>
            <button type="submit" class="button_ok">Применить</button>
            <button class="button_ok"><a href="<?php echo app()->route->getUrl('/student/grade?id='.$studentId); ?>">Сбросить</a></button>
        </form>

    </div>
</div>


