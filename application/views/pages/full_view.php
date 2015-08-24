<table class="table table-bordered table-hover table-striped table-condensed">
    <thead>
    <th>№ заявки</th><th>Адрес</th><th>Тип работ</th><th>Инв №</th><th>ФИО диспетчера</th><th>Начало</th>
    <th>Конец</th><th>Ст</th>
    </thead>
    <? if (isset($full_d)):?>
    <?php
    for ($i=0, $c=count($full_d); $i<$c; $i++){
        echo "<tr class='zayavka_info'><td>".$full_d[$i]['id']."</td><td>".$full_d[$i]['nasname'].", ".$full_d[$i]['nazv'].",".$full_d[$i]['n_dom']."</td>"
                . "<td>".$full_d[$i]['w_type']."</td><td>".$full_d[$i]['inv_n']."</td>"
                . "<td>".$full_d[$i]['fam']."</td><td>".$full_d[$i]['start_d']."</td><td>".$full_d[$i]['finish_d']."</td>"
                . "<td>".$full_d[$i]['status']."</td></tr>";
    }
    ?>
    <?endif?>
</table>
<?="<p class='pag'>".$this->pagination->create_links()."</p>"; ?>


