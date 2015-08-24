$(function(){
                    $('#dialog').load("/resources/form.html #form_content");
                    /* $( "body" ).on('focus','#noadr' ,function(){
                         //$(this).detach();
                         
                     });*/
       
                    // $('#list_tech1').clone(true).insertAfter('#list_tech1');
                 
                    $( "body" ).on('click','.zayavkistr', function() {
                    $( "#dialog" ).dialog( "open" );
                   // event.preventDefault();
                   $( "#tabs" ).tabs();
                   var ttt=$('#works').text();
        console.log(ttt);
                    });  
		$('body').on('click','#uform #tabs-2 #add_tech', function(){
                  var lch = $('body #uform #tabs-2 ul:last');
                    var str =  lch.attr('id');
                    var regexp_d = /[\d]/;
                    var matches_d = str.match(regexp_d);
                    var countattr=++matches_d[0];
                    var newul='<ul id="newul">\n\
                        \n\
<li><input name="g'+countattr+'" ><input name="p'+countattr+'" >\n\
</ul>';
  
  //-----------------------------------------------------------
  
  
  
  $('<input/>').attr({
    id:     'myinput-2',
    class:  'myinput',
    type: 	'text',
    name: 	'myinput-2',
    placeholder: 	'Поиск...'
}).appendTo(myform);
  
  
  
  
  
  
  //--------------------------------------------------------
  
  
                 //$('ul').attr('id','list_tech'+countattr).append('<li>11111</li>')
                   
              
//lch.clone().insertAfter(this);
//var top_100_list = [10,20,30]; // содержимое новых элементов
//var li_items = ""; // вставляемый html-текст
//var myl;
//myl = $('ul').attr('id','#mylist'); // необходимый список
//
//for (var i=0; i< top_100_list.length; i++)
//{li_items += '<li><input type="text" name="g'+countattr+'" /></li>';}
//myl.append(li_items);
//$('#res').innerHTML(myl);

                 



      /*  var sch=0;           
        while(sch<lt.length){console.log(lt[sch].name); 
            
            sch++;}*/
            
                    // $('#list_tech1').clone(true).insertAfter('#list_tech1');
              
                });
                $('body').on('submit','#uform',function(e){
                    e.preventDefault();
                });
                    $( "#dialog" ).dialog({
                    autoOpen: false,
                    width: 800,
                    modal:true,
                   
                    buttons: [
                    {
                            text: "Редакция",
                            click: function() {

                                    $( this ).dialog( "close" );
                            }
                    },
                    {
                            text: "Отмена",
                            click: function() {
                                    $( this ).dialog( "close" );
                            }
                    }
                    ],
                    title:'Редакция заявки'
                    });

                });
       