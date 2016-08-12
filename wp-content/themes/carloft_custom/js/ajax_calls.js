function ajax_load_page(href,id,slug){
       $.ajax({
              url: ajaxcalls.ajaxurl,
              type: 'post',
              data: {
                     id:id,
                     slug:slug,
                     action: 'ajax_load_page'
              },beforeSend: function(){
                     //loading animation
              },
              success: function( result ) {
                     show_content(result);
                     $('div.wpcf7 > form').attr("action","");
                     window.history.pushState("", "", href);
              }
	});
}      

       
       
       
       