<div class="content_discipline">
    <div class="discipline_columns">
        <h1>Дисциплины</h1>
        <form method="get" class="form_search">
            <input  class="input_search" type="text" name="search" placeholder="Поиск...">
            <button class="btn_search" type="submit">Искать</button>
            <button class="btn_search"><a class="a_search" href="<?php echo app()->route->getUrl('/disciplines'); ?>">Сбросить</a></button>
        </form>
        <ul class="discipline_list">
            <?= $message ?? '';?>
            <?php
            $i = 1;
            foreach ($disciplines as $discipline) {
                echo "<li class='discipline_in_list'><span class='counter_discipline'>$i</span>$discipline->name</li>";
                $i++;
            }
            ?>
        </ul>
    </div>
</div>
