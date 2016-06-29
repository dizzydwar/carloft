
function AnimateRotate() {
       $( "#get_random" ).addClass("busy");
}

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
