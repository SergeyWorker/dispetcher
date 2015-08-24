function tr()
{ 
     var refr= $.ajax({
       
        url:"getrec",
        type:"post",
        cache:false,
        data:{ids:$('.zayavkistr:first td:first>a').text()},
        dataType:"json"
                       });
    
    refr.done (function(dc){
       
       if(dc.length>0){
          
           loadall(dc); 
           raskraska(dc);
                       }
               });
    
    refr.fail(function( jqXHR, textStatus ) {
     console.log(jqXHR,textStatus);
                                            });
}
    