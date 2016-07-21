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
                     //$('div.wpcf7 > form').wpcf7InitForm();
                     $('#page_content').append('<script src="http://carloft.ccetc.de/wp-content/plugins/contact-form-7/includes/js/jquery.form.js"></script>');
                     $('#page_content').append('<script src="http://carloft.ccetc.de/wp-content/plugins/contact-form-7/includes/js/scripts.js"></script>');
                     window.history.pushState("", "", href);
              }
	});
}      

       
       
       
       