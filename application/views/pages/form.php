<script>
$(function(){
$('#test').on('change',function(){

//--------------
alert("1");
/*var request = $.ajax({
url: "form/mtest",
type: "POST",
data: { v : 1 },
dataType: "text"
});
request.done(function( msg ) {
console.log( msg );
});
request.fail(function( jqXHR, textStatus ) {
alert( "Request failed: " + textStatus );
});*/

//---------------

});
</script>
<select name="nasel" id="test">
    <option value="1">11111111111111</option>
    <option value="2">22222222222222</option>
</select>
<div id="dialog">
      
            
     
            <div id="tabs">
                
                <ul>
		<li><a href="#tabs-1">Общее</a></li>
		<li><a href="#tabs-2">Техника</a></li>
                </ul>
                
                
            <form id="uform" method="post" action="" >
                
                <div>
                   <input type="text" name="" placeholder="Номер заявки" value="<?=$view_edit['id_z']?>" readonly="readonly" />
               </div>
            <div id="tabs-1"><!--id tabs1-->
                <fieldset>
                        <legend>Адресные данные</legend>
                <ul class="fields">
                    <li>
                        <label>Насел.пункт</label>
                        <div>
                            <select id="nas">
                                <option value="<?=$view_edit['id_z']?>" /><?=$view_edit['nasname']?></option>
                            </select>
                        </div>
                    </li>
                    
                    <li>
                        <label>Улица</label>
                        <div>
                            <input type="text" name="" placeholder="" value="<?=$view_edit['nazv']?>" />
                        </div>
                    </li>
                    
                    <li>
                        <label>№ Дома</label>
                        <div>
                            <input size="5" type="text" name="" placeholder="" value="<?=$view_edit['n_dom']?>" />
                        </div>
                    </li>

                     <li>
                        <label>Без адреса</label>
                        <div>
                            <textarea rows="1" cols="65" id="noadr" name="" placeholder="" ><?=$view_edit['noadr']?></textarea>
                        </div>
                    </li>
                </ul>
                </fieldset>
            
            <fieldset>
                <legend>О заявке</legend>
                <ul class="fields">
                    <li>
                    <label>Тип</label>
                        <div>
                            <select name="type_works" id="type_w">
                                <option value="<?=$view_edit['work_type']?>"><?=$view_edit['work_type']?></option>
                            </select>
                        </div>
                    </li>
                    <li>
                        <label>Статус</label>
                            <div>
                                <select name="status" id="status">
                                    <option value="a"><?=$view_edit['status']?></option>
                                    <option value="a">В работе</option>
                                    <option value="na">Выполнено</option>
                                </select>
                            </div>
                    </li>
                    <li>
                        <label>Передал ФИО</label>
                            <div>
                            <input type="text" name="" placeholder="передал ФИО" value="<?=$view_edit['tr_fio']?>" />
                            </div>
                    </li>

                    <li>
                        <label>Инвентарный №</label>
                            <div>
                            <input type="text" name="" placeholder="Инвентарный" value="<?=$view_edit['inv_n']?>" />
                            </div>
                    </li>
                </ul>

                </fieldset>               
            
                    <fieldset>
                            <legend>Исполнение</legend>
                    <ul>
                        <li>
                            <label>Исполнитель</label>
                                <div>
                                  <input type="text" name="" placeholder="Исполнитель" value="" />
                                </div>
                        </li>
                        <li>
                            <label>Без воды</label>
                                <div>
                                    <textarea name="" rows="1" cols="60"></textarea>
                                </div>
                        </li>
                        <li>
                            <label>Выполненные работы</label>
                                <div>
                                   <textarea id="works" name="" rows="1" cols="60">работы</textarea>
                                </div>
                        </li>
                    </ul>

                    </fieldset>
            </div><!--id tabs1-->    
            <div id="tabs-2"><!--id tabs2-->
                    
                    <fieldset>
                    <legend>Техника Прибытие/Убытие</legend>
                    <button id="add_tech">Добавить технику +</button> 
                <ul id="list_tech1" class="fields">
                    <li>
                    <label>Гос номер</label>
                    <div>
                    <input type="text" name="g1" placeholder="Гос номер" />
                    </div>                       
                    </li>


                    <li>
                    <label>Путевой лист</label>
                    <div>
                    <input type="text" name="p1" placeholder="Путевой лист" />
                    </div>                        
                    </li>

                    <li>
                    <fieldset>
                    <legend>Время Прибытия/Убытия</legend>
                    <div>
                    <input size="5" type="text" name="vp1" placeholder="Прибытие" />
                    <input size="5" type="text" name="vu1" placeholder="Убытие" />
                    </div>  
                    </fieldset>

                    </li>
                </ul>
                    
                    <div id="res"></div>
                    
                    </fieldset>      
                        
                </div><!--id tabs2-->
               <?=$subbut?>
                   </form>
            </div><!--id tabs-->
 
</div>
<script>
    $(function(){
        $( "#tabs" ).tabs();
        //-----------------
          $('body').on('submit','#uform',function(e){
                    e.preventDefault();
                });
             
        //-----------------
        $('#add_tech').on('click', function(){
            
                    var lch = $('#uform #tabs-2 fieldset ul:last');
                    var str =  lch.attr('id');
                    var regexp_d = /[\d]/;
                    var matches_d = str.match(regexp_d);
                    var countattr=++matches_d[0];
                    var newul='<ul class="fields" id="newul'+countattr+'">\n\
                        \n\
<li><input name="g'+countattr+'" ><input name="p'+countattr+'">\n\
<li><fieldset><legend>Время Прибытия/Убытия</legend>\n\
<div><input size="5" type="text" name="vp1" placeholder="Прибытие" />\n\
<input size="5" type="text" name="vu1" placeholder="Убытие" /></div></fieldset></li></ul>';
lch.append(newul);
});
     //---------------------
    });
</script>