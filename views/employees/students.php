<div class="students_content">
    <h1 class="students_title">Студенты</h1>
    <div>
        <ul class="list_students">
            <?php
            $i=1;
            foreach ($students as $student){
                $group = $student->group->name;
                echo "<a href='".app()->route->getUrl('/student/grade?id='.$student->id)."'><li class='student_in_list'> <span class='counter'>$i</span>$student->last_name $student->first_name  $student->patronymic $group гр.</li></a>";
                $i++;
            }
            ?>
        </ul>
    </div>
</div>
