<script src="/js/jquery.autocomplete.js"></script>
<script src="/js/moment.js"></script><!--depnedence for bootstrap-datetimepicker-->
<script src="/js/ru.js"></script><!--ru locale for bootstrap datepicker-->
<script src="/js/bootstrap-datetimepicker.min.js"></script>
<script src="/js/tech_list.js"></script>
<link rel="stylesheet" href="/css/bootstrap-datetimepicker.min.css" >
<link rel="stylesheet" href="/css/autocomplete.css" >
<style type="text/css"> .addtech,.deltech{display:none}</style>

<div class="container">
 <ul class="nav nav-tabs">
    <li class="active"><a data-toggle="pill" href="#adr">О заявке</a></li>
    <li><a data-toggle="pill" href="#tech">Техника</a></li>
    
  </ul>

<div class="tab-content">
<div id="adr" class="tab-pane fade in active">
   
    <form role="form" method="post" action="/editdata">
        <div class="row">
            <div class="col-sm-2">
                <div class="form-group">
                    <label for="nz">Номер заявки:</label>
                    <input class="form-control" size="3" type="text" id="nz" name="nz" value="<?=$view_edit['id']?>" readonly>
                </div>
            </div>
            <div class="col-sm-2">
                <div class="form-group">
                    <label for="nz">Статус:</label>
                    <select class="form-control" name="status">
                        <option selected="selected" value="1">Открыта</option>
                        <option value="0">Закрыть</option>
                    </select>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-sm-3">
                <div class="form-group">
                   <label for="nach">Начало:</label>
                    <input class="form-control" size="5" type="text" id="nach" value="<?=$view_edit['start_d']?>" disabled>
                </div>
            </div>
            <div class="col-sm-2">
                <div class="form-group">
                   <label for="nas">Насел.пункт:</label>
                    <input class="form-control" size="3" type="text" id="nas" value="<?=$view_edit['nasname']?>" disabled>
                </div>
            </div>
            <div class="col-sm-4">
                <div class="form-group">
                  <label for="ul">Улица:</label>
                    <input class="form-control" size="3" type="text" id="ul" value="<?=$view_edit['nazv']?>" disabled>
                </div>
            </div>
            <div class="col-sm-1">
            <div class="form-group">
                 <label for="nd">№ Дома:</label>
               <input class="form-control" size="3" type="text" id="nd" value="<?=$view_edit['n_dom']?>" disabled>
            </div>
            </div>
        </div>
        <hr>
        
        <div class="row">
            <div class="col-sm-12">
                <label for="nadr">Без адреса</label>
                <textarea class="form-control" id="nadr" name="n_adr"><?=$view_edit['noadr']?></textarea>
            </div>
        </div>
        <hr>
       
         <div class="row">
            <div class="col-sm-12">
                <label for="nadr">Без воды останутся</label>
                <textarea class="form-control" id="n_water" name="n_water"><?=$view_edit['bez_v']?></textarea>
            </div>
        </div>
        <hr>
        
        <div class="row">
            <div class="col-sm-2">
                <label for="inv">Инв№:</label>
                <input class="form-control" size="3" type="text" id="inv" name="inv" value="<?=$view_edit['inv_n']?>" >
            </div>
            <div class="col-sm-2">
                <label for="tr_fio">Передал:</label>
                <input class="form-control" size="3" type="text" id="tr_fio" value="<?=$view_edit['tr_fio']?>" disabled >
            </div>
            <div class="col-sm-2">
                <label for="res_fio">Принял:</label>
                <input class="form-control" size="3" type="text" id="res_fio" value="<?=$view_edit['res_fio']?>" disabled >
            </div>
            <div class="col-sm-1">
                <label for="type_w">Т/р:</label>
                <select class="form-control" name='type_w'>
                    <option selected value="<?=$view_edit['wtid']?>"><?=$view_edit['w_type']?></option>
                    <?php
                        $c=0;
                        while ($c<count($work_type_list))
                            {
                                if($work_type_list[$c]['id']!=$view_edit['wtid']){
                                    echo "<option value='".$work_type_list[$c]['id']."'>".$work_type_list[$c]['w_type']."</option>"; 
                                                                                  }$c++;
                            }
                    ?>
               </select>
            </div>
        </div>
         <hr>
        <div class="row">
            <div class="col-sm-12">
                <label for="works">Выполненные работы</label>
                <textarea class="form-control" id="works" name='works'><?=$view_edit['works']?></textarea>
            </div>
        </div>
        <hr>
        
</div>
    <div id="tech" class="tab-pane fade">
        <ul id="tech_list" class="list-group">
            <li id="item1" class="list-group-item itemtech">
                <div class='row'>
                        <div class="col-sm-2">
                            <label for="gosn1">Гос.№:</label>
                            <input type="text" class="form-control chtech" name='gosn1' id="gosn1" placeholder="пример 111-11НА">
                        </div>

                        <div class="col-sm-2">
                            <label for="pl1">П/лист:</label>
                            <input type="text" class="form-control chtech" name='pl1' id="pl1" placeholder="11111">
                        </div>

                        <div class="col-sm-2">
                            <label for="timep1">Время приб.:</label>
                            <input type="text" class="form-control chtech" name='timep1' id="timep1" >
                        </div>

                        <div class="col-sm-2">
                            <label for="timeu1">Время убыт:</label>
                            <input type="text" class="form-control chtech" name='timeu1' id="timeu1" >
                        </div>
                        
                        <div class="col-sm-2">
                            <button class="addtech btn btn-default">+</button>
                            <button class="deltech btn btn-default">-</button>
                        </div>
                </div>
            </li>
            
        </ul>
    </div>
    
   
     <button type="submit" name="editz" class="btn btn-default">Редактировать</button>
    
</form>
</div> 

</div>