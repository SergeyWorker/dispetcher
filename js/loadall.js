$(function(){ setInterval(tr,3000);
     $('.pag a').on('click',function(e){
         loadall($(this).text());
         e.preventDefault();
     });
    loadall(); 
   
});
function loadall(curr_val){
   
    $.ajax({
  url: 'zayavki/allrecords/'+curr_val,
  method:'post',
  dataType:'json',
  success:function(data){render(data);},
  statusCode: {
    404: function() {
     error_recive();
    }
  }
});
}

function error_recive(){console.log("error");}

function render(datas){
console.log(datas);
 $(".zayavkistr").detach();
     var tr=document.createElement("tr");
     tr.setAttribute("class", "zayavkistr");
    for(var c=0, cou=datas.length; c<cou; c++){
        
        tr.insertCell(0).innerHTML=datas[c].inv_n;        
        tr.insertCell(0).innerHTML=datas[c].res_fio;
        tr.insertCell(0).innerHTML=datas[c].tr_fio;
        tr.insertCell(0).innerHTML=datas[c].w_type;
        tr.insertCell(0).innerHTML=datas[c].start_d;
        tr.insertCell(0).innerHTML=datas[c].bez_v;
            var adr=document.createTextNode(datas[c].nazv+", "+datas[c].n_dom);
            tr.insertCell(0).appendChild(adr);
        tr.insertCell(0).innerHTML=datas[c].nasname;
        tr.insertCell(0).innerHTML="<a href='/updata/"+datas[c].id+"'>"+datas[c].id+"</a>";
        if(tr.childElementCount==9){
            document.getElementById("z_thead").appendChild(tr); 
            tr=document.createElement("tr"); tr.setAttribute("class", "zayavkistr");
        }
    }
   
}

 function raskraska(dc){ 

        if(dc.length>0){

        var zvuk = document.getElementsByTagName("audio")[0];
        zvuk.loop='true';
        zvuk.play();
        //-----------------------------
        var i=0;

        while(i<dc.length){
        $(".zayavkistr>td:contains('"+ dc[i].id +"') ").parent().css('background','orange');              
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

