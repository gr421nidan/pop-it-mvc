<div class="content_discipline">
    <div class="discipline_columns">
        <?php if (!empty($studentGrade[0])) : ?>
            <?php
            $student_surname =$studentGrade[0]->student->last_name;
            $student_name=$studentGrade[0]->student->first_name;
            $student_patronymic=$studentGrade[0]->student->patronymic;
            ?>
            <h1>Успеваемость студента - <?=$student_surname, $student_name, $student_patronymic?></h1>
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
            <h1>У данного студента отсутствует успеваемость</h1>
        <?php endif; ?>
    </div>
    <div class="discipline_columns_two">
        <select  class="discipline_filter">
            <option value="">Вид контроля</option>
            <?php
            foreach ($controls as $control){
                echo "<option value='$control->id_control'> $control->name </option>";
            }
            ?>
        </select>
        <select class="discipline_filter">
            <option value="">Количество часов</option>
            <option value="48">48</option>
            <option value="56">56</option>
            <option value="86">86</option>
            <option value="93">93</option>
            <option value="112">112</option>
        </select>
        <button class="button_ok">Ок</button>
    </div>
</div>

