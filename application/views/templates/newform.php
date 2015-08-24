<script src="/js/jquery.autocomplete.js"></script>
<script src="/js/moment.js"></script><!--depnedence for bootstrap-datetimepicker-->
<script src="/js/ru.js"></script><!--ru locale for bootstrap datepicker-->
<script src="/js/bootstrap-datetimepicker.min.js"></script>
<script src="/js/tech_list.js"></script>
<script src="/js/myvalidator.js"></script>
<link rel="stylesheet" href="/css/bootstrap-datetimepicker.min.css" >
<link rel="stylesheet" href="/css/autocomplete.css" >
<style type="text/css"> .addtech,.deltech, #n_adr, #n_water {display:none}; </style>
<script>
$(function(){
  
  $( "#w_adr" ).on('click',function(){ $(this).next().toggle( "slow" );});///show/hide fields without adres and water
  $( "#w_water" ).on('click',function(){ $(this).next().toggle( "slow" );});
   //----------------------------------------------------------------------------
   var streets=[];
   $('#nas').on('change',function(){
        if($(this).val()!==0 || $(this).val()!=99){
            $('#n_adr').text('адрес указан');
            $(this).parent().parent().next().find('#ul').val('').removeAttr('disabled');
            $(this).parent().parent().next().next().find('#nd').val('').removeAttr('disabled');
            //-----------
           $.ajax({
  dataType: "json",
  url: '../../getul/'+$(this).val(),
  method:'post',
  success: datasdone
});

function datasdone(datas){
          $.each(datas, function(idx, datas) {     //  get list of streets----------
            streets.push(datas); 
        });
    }
  }
  ///----------------------------------------------------------------------------
  if($(this).val()==99){
      $(this).parent().parent().next().find('#ul').removeAttr('disabled').val('БЕЗ ПРИВЯЗКИ');
      $(this).parent().parent().next().find('#hidul').val($(this).val());
      $(this).parent().parent().next().next().find('#nd').val('-');
         }
});
 
$('#ul').autocomplete({
 lookup:streets,
 lookupLimit:5,
 minChars:3,
 onSelect:function(suggestion){$('#hidul').val(suggestion.data);}
});
//-------------------------------------------------------------------------------

//-------------------------------------------------------------------------------
});
</script>
<div class="container">
 <ul class="nav nav-tabs">
    <li class="active"><a data-toggle="pill" href="#adr">О заявке</a></li>
    <li><a data-toggle="pill" href="#tech">Техника</a></li>
    
  </ul>

<div class="tab-content">
          <form role="form" method="post" id="newz" action="/newdata">
<div id="adr" class="tab-pane fade in active">

        <div class="row">
            <div class="col-sm-4">
                <div class="form-group">
                   <label for="nas">Насел.пункт:</label>
                    <select class="form-control" id="nas" name="nas">
                        <option value="0" selected="selected" readonly>Выберите насел.пункт</option>
                        <?php
                        $cc=0;
                        while($cc<count($nas_list)){
                            echo "<option value=".$nas_list[$cc]['nasid'].">".$nas_list[$cc]['nasname']."</option>";$cc++;
                            }
                        ?>
                    </select>
                </div>
            </div>
            <div class="col-sm-4">
                <div class="form-group">
                  <label for="ul">Улица:</label>
                  <input type="text" class="form-control" id="ul" data-toggle="ultooltip" data-placement="top" title="Поле обязательно! Только буквы"  disabled>
                        <input type="hidden" id="hidul" name="ul_id">
                </div>
            </div>
            <div class="col-sm-1">
            <div class="form-group">
                 <label for="nd">№ Дома:</label>
                 <input class="form-control" size="4" type="text" name="nd" id="nd" value="" disabled>
            </div>
            </div>
        </div>
        <hr>
        
        <div class="row">
            <div class="col-sm-12">
                <label for="n_adr">Без адреса</label><input type="checkbox" id="w_adr">
                <textarea class="form-control" id="n_adr" name="n_adr"></textarea>
            </div>
        </div>
        <hr>
        
         <div class="row">
            <div class="col-sm-12">
                <label for="n_water">Без воды остануться</label><input type="checkbox" id="w_water">
                <textarea class="form-control" id="n_water" name="n_water" >НЕТ АДРЕСОВ</textarea>
            </div>
        </div>
        <hr>
        
        <div class="row">
            <div class="col-sm-2">
                <label for="inv">Инв№:</label>
                <input class="form-control" size="3" type="text" id="inv" name="inv" placeholder="111111">
            </div>
            <div class="col-sm-2">
                <label for="tr_fio">Передал:</label>
                <input class="form-control" size="3" type="text" id="tr_fio" name="tr_fio" placeholder="фамилия">
            </div>
            <div class="col-sm-1">
               
                <label for="type_w">Т/р:</label>
                <select class="form-control" name='type_w' id="type_w">
                    <option value="0" selected="selected" readonly>-/-</option>
                    <?php
                    $c=0;
                    while($c<count($work_type_list)){
                        echo "<option value=".$work_type_list[$c]['id'].">".$work_type_list[$c]['w_type']."</option>";$c++;
                        }
                    ?>
                   
               </select>
            </div>
        </div>
         <hr>
        <div class="row">
            <div class="col-sm-12">
                <label for="works">Выполненные работы</label>
                <textarea class="form-control" id="works" name='works'>НЕ УКАЗАНЫ</textarea>
            </div>
        </div>
       
        
</div>
    <div id="tech" class="tab-pane fade">
        <div class="row">
            <input type="checkbox" id="use_transport">Использовать технику
        </div>
        <ul id="tech_list" class="list-group">
            <li id="item1" class="list-group-item itemtech">
                <div class='row'>
                        <div class="form-group col-sm-2">
                            <label for="gosn1">Гос.№:</label>
                            <input type="text" class="form-control chtech" name='gosn1' id="gosn1" placeholder="пример 111-11НА">
                        </div>

                        <div class="form-group col-sm-2">
                            <label for="pl1">П/лист:</label>
                            <input type="text" class="form-control chtech" name='pl1' id="pl1" placeholder="11111">
                        </div>

                        <div class="form-group col-sm-2">
                            <label for="timep1">Время приб.:</label>
                            <input type="text" class="form-control chtech" name='timep1' id="timep1" >
                        </div>

                        <div class="form-group col-sm-2">
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
    
    <hr>
     <button type="submit" name="editz" class="btn btn-default">Редактировать</button>
    
</form>
</div> 

</div>
<?php
//print_r($work_type_list);
?>