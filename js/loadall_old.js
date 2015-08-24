    $(function(){
      setInterval(tr,3000);
      loadall();
                });
    function loadall(dc)
    {

        var request = $.ajax({
        url: "zayavki/allrecords?1435920624",
        type: "POST",
        cache:false,
        dataType: "json"
        
                            });
 
request.done(function(msg) {

$('.zayavkistr').detach();
console.log(msg);

       /* for(i=0;i<msg.length;i++)
           {
$('<tr>').append('<td><a href=\'updata/'+msg[i].id_z+'\'>'+msg[i].id_z+'</a></td>\n\
<td>'+msg[i].nasname+'</td>\n\
<td>'+msg[i].nazv+'</td>\n\
<td>'+msg[i].n_dom+'</td>\n\
<td>'+msg[i].noadr+'</td>\n\
<td>'+msg[i].start_data+'</td>\n\
<td>'+msg[i].w_type+'</td>\n\
<td>'+msg[i].tr_fio+'</td>\n\
<td>'+msg[i].res_fio+'</td>\n\
<td>'+msg[i].inv_n+'</td>').insertAfter('#zayavki_table thead');
$('#zayavki_table thead').next().addClass('zayavkistr');
           }*/

if(dc) raskraska(dc);

              
 //-----------------------------------------------
                                });
 
request.fail(function( jqXHR, textStatus ) {
     console.log( "Request failed: " + textStatus );
                                            });

      }
      
      
      function raskraska(dc){ 

        if(dc.length>0){

        var zvuk = document.getElementsByTagName("audio")[0];
        zvuk.loop='true';
        zvuk.play();
        //-----------------------------
        var i=0;

        while(i<dc.length){
        $(".zayavkistr>td:contains('"+ dc[i].id_z +"') ").parent().css('background','orange');              
                            i++;
                        }

        $('.zayavkistr').animate({
                backgroundColor:'*'}, 5500, 
                    function(){
                        $(this).removeAttr('style').removeClass('zayavkistr').addClass('zayavkistr');
                            zvuk.pause();
                            });
        }
    }