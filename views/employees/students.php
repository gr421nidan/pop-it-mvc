<div class="students_content">
    <h1 class="students_title">Студенты</h1>
    <div>
        <ul class="list_students">
        <?php
        $i=1;
        foreach ($students as $student){
                $group = $student->group->name;
                echo "<a href=''><li class='student_in_list'> <span class='counter'>$i</span>$student->first_name $student->last_name $student->patronymic $group гр.</li></a>";
                $i++;
            }
        ?>
        </ul>
    </div>
</div>
