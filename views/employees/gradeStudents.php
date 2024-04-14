<div class="content_discipline">
    <div class="discipline_columns">
        <h1>Успеваемость студентов по группам</h1>
        <select class="discipline_filter">
            <option value="">Группы</option>
            <?php
            foreach ($groupsGrades as $groupsGrade){
                echo "<option value=\"$groupsGrade->id\">$groupsGrade->name</option>";
            }
            ?>
        </select>
        <button class="button_ok">Ок</button>
        <ul class="discipline_list">
            <li>Никушкина Дарья Андреевна 421 Математика 4</li>
            <li>sffvgfbfgb</li>
            <li>sffvxdgbdg</li>
            <li>sffvdfbd</li>
            <li>sffvdfb</li>
            <li>sffvxdfb</li>
            <li>sffvxdfb</li>
            <li>sffvzdfb</li>
        </ul>
    </div>
    <div class="discipline_columns_two">
        <h1>Успеваемость студентов по дисциплинам</h1>
        <select class="discipline_filter">
            <option value="">Дисциплины</option>
            <?php
            foreach ($disciplinesGrades as $disciplinesGrade){
                echo "<option value=\"$disciplinesGrade->id\">$disciplinesGrade->name</option>";
            }
            ?>
        </select>
        <button class="button_ok">Ок</button>
        <ul class="discipline_list">
            <li>Никушкина Дарья Андреевна 421 Математика 4</li>
            <li>sffvgfbfgb</li>
            <li>sffvxdgbdg</li>
            <li>sffvdfbd</li>
            <li>sffvdfb</li>
            <li>sffvxdfb</li>
            <li>sffvxdfb</li>
            <li>sffvzdfb</li>
        </ul>
    </div>
</div>

