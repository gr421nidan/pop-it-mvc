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
    <div class="discipline_columns_two">
        <select class="discipline_filter">
            <option value="">Фильтры</option>
            <optgroup label="Курс">
                <option>1</option>
                <option>2</option>
                <option>3</option>
                <option>4</option>
                <option>5</option>
            </optgroup>
            <optgroup label="Семестр">
                <option>1</option>
                <option>2</option>
            </optgroup>
        </select>
        <button class="button_ok">Ок</button>
    </div>
</div>

