 $(function(){
         $("#tech_list").on('focus',"input[name*='time']",function(){$(this).datetimepicker({
                 locale: 'ru',
                 format:'YYYY.MM.DD H:mm:ss'
             })
         ;}); //setup for datepicker locale
    //-----------------------------------------------------------------------------------------------------------
        $( "#tech_list" ).on('mouseover',".itemtech",function(){$(this).find(".addtech,.deltech").css('display','inline-block');}); //show +-
        $( "#tech_list" ).on('mouseout',".itemtech",function(){$(this).find(".addtech,.deltech").css('display','none');}); //hide +-
   //------------------------------------------------------------------------------------------------------------
        $('#tech_list').on('click','.deltech',function(e){
            if($( "#tech_list li" ).length>1){
             $("#tech_list li:last-child").detach();//-------button "-" delete item of list
             }
             e.preventDefault();
        });
    //-----------------------------------------------------------------------------------------------------------
        $('body').on('click','.addtech',function(e){
            $("#tech_list li:last-child").clone().appendTo("#tech_list");
            var items_c=$("#tech_list li").length;
		var last_item=$("#tech_list li:last-child").find(".chtech");//---button "+" add item list
                $.each(last_item,function() {
			var sl=$( this ).attr('id').split(/(\d)/);
			$( this ).attr('id',sl[0]+items_c).attr('name',sl[0]+items_c);
			});
                $("#tech_list li:last-child").attr('id','item'+items_c).find(".addtech,.deltech").css('display','none' );
             e.preventDefault();
        });
      
//--------------------------------------------------------------------------------------------------------------------
//localStorage.clear();
if(localStorage.length===0){
    $.get("get_tech",function(data){
  
      var obj = jQuery.parseJSON( data );
           $.each(obj, function(idx, obj) {     //  add list of tech in localStorage----------
           localStorage.setItem(idx, obj.gosn);       
        });
    });
}
var avtonums=[];
 $.each(localStorage, function(idx, obj) {avtonums.push(localStorage.getItem(idx));   }); // get list of tech in Array from localStorage
//----------------------------------------------------------------------------
$('body').on('keypress','input[name*="gosn"]',function(){
         $(this).autocomplete({
             lookup: avtonums,
             minChars:3,    // autocomplete for fields with gosn
             lookupLimit:5             
            });
});
//----------------------------------------------------------------------------
    });