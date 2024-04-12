<div class="content_group">
    <div class="group_columns">
        <h1>Группа №421</h1>

        <ul class="about_group_list">
            <h3>Дисциплины группы:</h3>
            <a href="<?= app()->route->getUrl('/groups/group/evaluations') ?>" ><li>Математика, 2 курс, 2 семестр, 48часов, экзамен</li></a>
            <a href="<?= app()->route->getUrl('/groups/group/evaluations') ?>" ><li>sffvgfbfgb</li></a>
            <a href="<?= app()->route->getUrl('/groups/group/evaluations') ?>" ><li>sffvgfbfgb</li></a>
            <a href="<?= app()->route->getUrl('/groups/group/evaluations') ?>" ><li>sffvgfbfgb</li></a>
            <a href="<?= app()->route->getUrl('/groups/group/evaluations') ?>" ><li>sffvgfbfgb</li></a>
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
            <input class="discipline_add_in_group" type="number" name="hours" placeholder="Количество часов">
            <button class="button_add_discipline_in_group">Добавить</button>
        </form>
    </div>
</div>

