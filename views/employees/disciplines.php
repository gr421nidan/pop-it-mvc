<div class="content_discipline">
    <div class="discipline_columns">
        <h1>Дисциплины</h1>
        <ul class="discipline_list">
            <?php
            $i=1;
            foreach ($disciplines as $discipline){
                echo "<li class='discipline_in_list'> <span class='counter_discipline'>$i</span>$discipline->name </li>";
                $i++;
            }
            ?>
        </ul>
    </div>
</div>

