function ajax_get_random(){
       $.ajax({
              url: ajaxcalls.ajaxurl,
              type: 'post',
              data: {
                     action: 'ajax_get_random'
              },beforeSend: function(){
                     AnimateRotate();
              },
              success: function( result ) {
                     $(".ccetc_macht").html(result);
                     $( "#get_random" ).removeClass("busy");
              }
	});
}
                            function AnimateRotate() {
                                   $( "#get_random" ).addClass("busy");
                            }



function ajax_load_page(href,cat_id,id){
       $.ajax({
              url: ajaxcalls.ajaxurl,
              type: 'post',
              data: {
                     cat_id:cat_id,
                     id:id,
                     action: 'ajax_load_page'
              },beforeSend: function(){
                     //AnimateRotate();
              },
              success: function( result ) {
                     show_content(result);
                     window.history.pushState("", "", href);
              }
	});
}      
       function show_content(result){
              var container = $("#page_content_box");
              container.find("#page_content").html(result);
             
              container.css("display","block");
              
              container.animate({
                     opacity: 1,
                     height:container.find("#page_content").height()
                     }, 300, function() {

                     });
       };