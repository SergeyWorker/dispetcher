$(function(){
$("[data-toggle='schettooltip']").tooltip('show');
//------------------------------------------------------------------------------
$('#newz').on('submit',function(){
    console.log($(this).find("#type_w").val());
    if($(this).find("#nas").val()==0 && $(this).find("#n_adr").text()==''){console.log("noadr"); return false;}
    if( emptyval($(this).find("#ul").val()) ){console.log("ul empty"); return false;}
    if( emptyval($(this).find("#nd").val()) ){console.log("n_dom empty"); return false;}
    if( emptyval($(this).find("#inv").val()) || emptyval($(this).find("#tr_fio").val())  ){console.log("tr fio empty"); return false;}
    if( emptyval($(this).find("#type_w").val()) ){console.log("n_dom empty"); return false;}
    var cht=$('.chtech');
    for(var c=0, coun=cht.length; c<coun; c++){
        console.log(c);
    }
    //if( emptyval($(this).find("#inv").val()) || emptyval($(this).find("#tr_fio").val()) || emptyval($(this).find("#type_w").val())){console.log("tr fio empty"); return false;}

    return true;
});

//-------------------------------------

});

function emptyval(emval){
        
    if(emval=='' || emval==false){return true;}
     return false;
}