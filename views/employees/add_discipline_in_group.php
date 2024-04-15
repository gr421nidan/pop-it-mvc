<?= $message ?? '';?>
<div class="content_add_discipline_in_group">
    <h2>Добавить дисциплину</h2>
    <form method="post" class="add_discipline_in_group">
        <input name="csrf_token" type="hidden" value="<?= app()->auth::generateCSRF() ?>"/>
        <input type="hidden" name="group_id" value="<?= $groupId ?>">
        <select name='discipline_names' class="discipline_add_in_group">
            <option value="">Название</option>
            <?php foreach ($discipline_name as $discipline) : ?>
                <option><?= $discipline->name ?></option>
            <?php endforeach; ?>
        </select>
        <select name='semester' class="discipline_add_in_group">
            <option value="">Семестр</option>
            <option value="1">1</option>
            <option value="2">2</option>
        </select>
        <select name='course' class="discipline_add_in_group">
            <option value="">Курс</option>
            <option value="1">1</option>
            <option value="2">2</option>
            <option value="3">3</option>
            <option value="4">4</option>
            <option value="5">5</option>
        </select>

        <select name="control_names" class="discipline_add_in_group">
            <option value="">Вид контроля</option>
            <?php foreach ($control_name as $control) : ?>
                <option><?= $control->name ?></option>
            <?php endforeach; ?>
        </select>
        <select name="num_hours" class="discipline_add_in_group">
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