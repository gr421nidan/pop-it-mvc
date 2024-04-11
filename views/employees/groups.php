<div class="groups_content">
    <h1 class="groups_title">Группы</h1>
    <div class="wrapper">
        <div class="list_groups">
            <?php
            foreach ($groups as $group){
                echo "<div class='group_block'><a href=''>$group->name гр.</a></div>";
            }
            ?>
        </div>
    </div>
</div>
