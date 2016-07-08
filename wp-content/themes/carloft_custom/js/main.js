var $ = jQuery.noConflict();

var w_height;
var w_width;
var scrolled =0;
var preview_box_width;
var preview_entry_height;
var at_the_top;
var ratio;

              
$(document).ready(function() {
       resize();
       click_handlers();
       setup_slideshow();
});

$( window ).resize(function() {
       resize();
});

$( window ).scroll(function() {
       scrolled = $("body").scrollTop();
       scroll_box_offset();
});

function resize(){
       get_dimensions();
       basic_scaling();
       scale_start_screen();
       apply_ratio();
       
       resize_thumb_area();
       justify_height();
       
       scale_slideshow();
}

function click_handlers(){
       get_random();
       load_page();
       toggle_menu();
       menu_click();
       
       big_box_hover();
}

// SCROLLING FUNCTIONS


function scroll_box_offset(){
       var dif = $(".big_box_sub_menu").outerHeight() - scrolled;
       if(dif >= 0){
              $("#big_box_row").css("marginTop",-dif);  
       }
}




// SCALING / RESIZING FUNCTIONS

function get_dimensions(){
       w_height = $(window).height();
       w_width = $(document).width();
}

function basic_scaling(){
       var set_margin = 35;
       
       var logo1_w = $("#logo1").width();
       var left_margin = set_margin + logo1_w;
       var right_margin = set_margin;
       
       var content_width = parseInt($(".site-inner").css("maxWidth"));
       var needed_width = content_width + left_margin + right_margin;
       
       if(w_width > 1025){
              if(w_width <= needed_width + logo1_w){
                     $(".site-inner").css("marginLeft",left_margin);
                     if(w_width <= needed_width){
                            $(".site-inner").css("marginRight",right_margin);
                     }else{
                            $(".site-inner").css("marginRight","auto");
                     }
              }else{
                     $(".site-inner").css("margin","auto");
              }   
       }else{
             $(".site-inner").css("margin","auto"); 
       }
       
};




function big_box_hover(){
       var id;
       var sub_row;
       
       //show sub menu
       var delay=200, setTimeoutConst;
       
       $('.big_box').hover(function() {
              
              var ele = $(this);
              setTimeoutConst = setTimeout(function(){
                     
                     ele.addClass("active");
                     id = ele.attr("id");

                     //z-index juggling to put the current row on top
                     $(".big_box_sub_menu").css("zIndex",9);
                     
                     sub_row = $(".big_box_sub_menu."+id);
                     sub_row.css("zIndex",10);

                     show_sub_menu(sub_row);
              
              }, delay);
       }, function(){
              clearTimeout(setTimeoutConst );
       });


       //hide sub menu
       var delay=200, setTimeoutConst2;
       
       $('#big_box_row').hover(function() {
              
              clearTimeout(setTimeoutConst2 );
              
       }, function(){
              
              setTimeoutConst2 = setTimeout(function(){
                     hide_sub_box();
              }, delay);
              
       });
       
       
}


function show_sub_menu(ele){
       var sub_box =$("#big_box_sub_row");
       
       if(sub_box.hasClass("active")=== false){
              show_sub_box(); 
       }
       
       ele.stop().animate({
              opacity: 1,
              bottom: 0
              }, 500, function() {
                     ele.addClass("active");
                     $(".big_box_sub_menu").not(ele).css("bottom","100%");
                     $(".big_box_sub_menu").not(ele).css("opacity",0);
              });
      
};

function show_sub_box(){
       
       var sub_box =$("#big_box_sub_row");
       
       if(sub_box.hasClass(".active") === false ){
              
              sub_box.css("display","block");
              var go_to_height = $(".big_box_sub_menu").outerHeight();
              
              
              sub_box.stop().animate({
                     height: go_to_height,
                     opacity: 1
                     }, 200, "easeInExpo", function() {
                            
                     }); 
                     
              if(scrolled === 0){
                     offset_big_box();
              }
       }
};

function offset_big_box(){
       
       $("#big_box_row").stop().animate({
              marginTop: -$(".big_box_sub_menu").outerHeight()
              }, 500, "easeOutExpo", function() {

              }); 
              
};

function hide_sub_box(){
       var sub_box =$("#big_box_sub_row");
       
       if(scrolled === 0){
              reset_big_box();
       }
       
       sub_box.stop().animate({
              height: 0,
              opacity:0
              }, 500, "easeOutExpo", function() {
                     sub_box.css("display","none");
                     $(".big_box_sub_menu").css("opacity",0);
              }); 
              
       
}

function reset_big_box(){
       
       $("#big_box_row").animate({
              marginTop: 0
              }, 500, "easeOutExpo", function() {

              }); 
              
};



/*
function collaps_start_screen(){
       var seperator_bot_position = $(".block_separator").offset().top;
}
*/


function apply_ratio(){
       $(".has_ratio").each(function(){
              var e = $(this);
              var ratio = e.attr("data-ratio");   

              if(e.width() !== 0){
                    var new_height = e.width()*ratio;
                    e.height(new_height);
              }else{
                    var new_width = e.height()/ratio;
                    e.width(new_width); 
                    if(e.hasClass("before")){                                   
                           e.css("marginLeft",-(new_width - 1));
                    }
              }
              max_w = e.parent("div").width();

              if(e.width() > max_w){
                     e.width("100%");
              }

       });
}

function scale_start_screen(){
       if ($('#start_screen').length > 0) {
              var top_ofs =$('#start_screen').position().top;
              
              $('#start_screen').height(w_height - top_ofs);  
              $('#main_quote').css("top",($('#start_screen').height() ) * 0.33 - $('#main_quote').height()/2);   
       }
}

function resize_thumb_area(){
       $(".thumb_area").each(function(){
              preview_box_width = $(".preview").width();
              ratio = $(this).attr("data-ratio");
              $(this).height(preview_box_width / ratio);
       });
}

function justify_height(){
       preview_entry_height = 0;
       
       $(".row.fixed_height .fixed_height").each(function(){
              console.log($(this).height());
              if($(this).find(".cont").height() > preview_entry_height){
                     preview_entry_height = $(this).find(".cont").height();
              }
       });
       $(".row.fixed_height .fixed_height").height(preview_entry_height);
}


       
function get_random(){
       $(document).on("click","#get_random, .ccetc_macht",function(){
              ajax_get_random();
       }); 
}





var dfd = $.Deferred();

var current;
var nav;
var current_width;
var nav_margin;
var menu_width;

function load_page(){
       $("#big_box_row a, .main-navigation a").on("click",function(e){
              
              e.preventDefault();
              var href= $(this).attr("href");
              
              var classes = $(this).closest("li").attr("class");      
              
              
              //look for cat_id
              var cat_id;
              
              //if has data-cat_id attr
              if( $(this).attr("data_cat_id") ){
                     
                     cat_id = $(this).attr("data_cat_id");
                     ajax_load_page(href,cat_id,0);
                     
              }
              //if cat_id is in class
              else if(classes.indexOf("menu-cat-") !== -1){
                     var s = classes.indexOf("menu-cat-");
                     var e = classes.indexOf(" ",s);
                     cat_id  = classes.substring(s + 9, e);
                     
                     
                     if(cat_id !== ""){
                            ajax_load_page(href,cat_id,0);
                     }
                     
              }
              // no cat -> get page/post id
              else{
                     var classes = $(this).closest("li").attr("class");
                     var s = classes.indexOf("menu-id-");
                     var e = classes.indexOf(" ",s);
                     
                     id  = classes.substring(s + 8,e);
                     
                     if(id !== ""){
                            ajax_load_page(href,0,id);
                     }
              }
              
       });
};

function menu_click(){
       $("#menu-primary a").click(function(e, callback){
              e.preventDefault();
              var link = $(this).attr("href");
              var name = $(this).html();
              $("#current_page").html(name);
              
              dfd.done(function(){
                     window.location.href = link;       
              });
       });
}

function toggle_menu(){
              
       current = $("#current_page");
       nav = $("#site-navigation");
       current_width = current.width();      
       nav_margin = parseInt(nav.find("a").css("paddingLeft"));     
       menu_width = nav.width();
       
       
       // status bei pageload setzten
       
       if($('body').hasClass("home")){
              current.css("right",- (current_width + nav_margin));
              
              nav.css("right", - current_width);
              nav.css("opacity",1);
       }else{
              current.css("right",0);
              current.css("opacity",1);
              
              nav.css("right", - (menu_width + current_width + nav_margin));
              nav.addClass("collapsed");
       }
       
       
       $("#my_menu_toggle, #current_page").mouseover(function(){
              // menu öffnen
              if(nav.hasClass("collapsed") === true){
                     show_menu();
              }  
       });
       
       $("#my_menu_toggle, #menu-primary a").click(function(){
              // menu öffnen
              if(nav.hasClass("collapsed") === true){
                     show_menu();
              }  
              // menu schließen
              else{ 
                     hide_menu();
              }
       });
       
}

function hide_menu(){
       nav.animate({
              right:- (menu_width + nav_margin),
              opacity: 0
              }, 150, function() {
                     
              nav.addClass("collapsed");

              current.animate({
                     right:0,
                     opacity: 1
              }, 300, function() {
                     current.removeClass("collapsed");
                     dfd.resolve();
              });
       });
}

function show_menu(){
       current.animate({
              right:- current_width,
              opacity: 0
              }, 150, function() {

              current.addClass("collapsed");

              nav.animate({
                     right: - current_width,
                     opacity: 1
              }, 300, function() {
                     nav.removeClass("collapsed");  

              });
       });
}







// GALLERY

var img_ratio = 0.5;
var imgWidth = 0;
var img_height = 0;
var num_img_shown = 1;
var stored_img_height = 0;
var slide_height = 0;

function set_slide_height(){
       var wh = $(window).innerHeight();
       var big_box_height = $("#big_box_row").innerHeight();
       var admin_bar_height = 0;
       
       if($("#wpadminbar").length >= 1){
              admin_bar_height = $("#wpadminbar").innerHeight();
       }
       slide_height = wh - big_box_height - admin_bar_height;
}

function setup_slideshow(){
       set_slide_height();
       
       $(".slideshow").each(function(index){
              
              var container = $(this).find(".slide_container");

              // set imageWidth
              imgWidth = $(this).find(".slide_content").width() / num_img_shown;
              $(this).find(".slide").width(imgWidth);
              
              // if slide_height is NOT defined 
              if(slide_height  === 0 && slide_height === undefined){
                     stored_img_height = 0;
                     img_height = imgWidth * img_ratio;
                     
                     //find highest image
                     if(stored_img_height < img_height){
                            stored_img_height = img_height;
                     }
              
                     slide_height = stored_img_height;
              }
              

              // set img and container height
              $(this).find(".slide").height(slide_height);                      
              $(this).find(".slide_content").height(slide_height);

              // if more than one image
              if($(this).find(".slide").length > 1){
                     
                     $(this).prepend('<p class="gallery_button prev ir">prev</p>');
                     $(this).prepend('<p class="gallery_button next ir">next</p>');

                     // depending on how many images are shown at once...
                     // clone the last images and put them at the front
                     for(i = 1; i <= num_img_shown; i++){
                            container.children('.slide:nth-last-child('+i+')').clone().addClass("clone").prependTo(container);              
                     }
                     // clone the first REAL images 
                     for(i = 1; i <= num_img_shown; i++){
                            var j = i + num_img_shown; // skip added the clones
                            container.children('.slide:nth-child('+j+')').clone().addClass("clone").appendTo(container);
                     }

                     // mark the first and last REAL image - no clones
                     // and set current image
                     container.children('.slide').not(".clone").first().addClass("first current");
                     container.children('.slide').not(".clone").last().addClass("last");


                     var imgCount = container.children('.slide').length;//count the images
                     container.width(imgWidth * (imgCount));//set the width of the container to the number of images - plus 2 to account for the cloned images

                     var position = $(this).find(".slide.current").index();
                     var offset = position * imgWidth;

                     container.css({'left':-offset+'px'});//reset the slider so the first image is still visible              

              }
              
              scale_buttons();
              
       });
       
      

       // slideshow buttons
       var prev = function(button){
              var imgWidth = button.closest(".slideshow").find(".slide").width();
              var container = button.closest(".slideshow").find(".slide_container");
              var imgCount = container.find('.slide').length;

              container.stop(true,true); //complete any animation still running  

              var newLeft = container.position().left+(imgWidth);//calculate the new position which is the current position plus the width of one image

              container.stop().animate({'left':newLeft+'px'},500,"easeInOutQuint",function(){//slide to the new position
                     if(container.children('.slide:nth-child(2)').hasClass("current")){
                            container.css({'left':- (imgCount - (num_img_shown * 2))*imgWidth+'px'});

                            container.children(".current").removeClass("current");
                            container.children('.slide:nth-last-child('+(num_img_shown * 2)+')').addClass("current");
                     }else{
                            var new_current = container.children(".current").prev("li, div, img");
                            container.children(".current").removeClass("current");
                            new_current.addClass("current");
                     }
              });
              return false;
       };


       $('body').delegate(".prev","click",function(){
              prev($(this));
       });


       var next = function(button){

              var imgWidth = button.closest(".slideshow").find(".slide").width();
              var container = button.closest(".slideshow").find(".slide_container");

              container.stop(true,true); //complete any animation still running - in case anyone's a bit click happy... 

              var newLeft = container.position().left-(imgWidth);//calculate the new position which is the current position minus the width of one image

              container.stop().animate({'left':newLeft+'px'},500,"easeInOutQuint",function(){//slide to the new position...

                     if(container.children(".last").hasClass("current")){
                            container.css({'left':- num_img_shown*imgWidth+'px'});

                            container.children(".first").not("clone").addClass("current");
                            container.children(".last").removeClass("current");
                     }else{
                            var new_current = container.children(".current").next("li, div, img");
                            container.children(".current").removeClass("current");
                            new_current.addClass("current");
                     }
              });
              return false;
       };

       $('body').delegate(".next","click",function(){
              next($(this));
       });

       //smooth_load();
}


function scale_slideshow(){
       set_slide_height();
       $(".slideshow").each(function(index){
              container = $(this).find(".slide_container");

              // set imageWidth
              imgWidth = $(".slide_content").width() / num_img_shown;
              $(this).find(".slide").width(imgWidth);
              
              // if slide_height is NOT defined 
              if(slide_height  === 0 && slide_height === undefined){
                     stored_img_height = 0;
                     img_height = imgWidth * img_ratio;
                     
                     //find highest image
                     if(stored_img_height < img_height){
                            stored_img_height = img_height;
                     }
              
                     slide_height = stored_img_height;
              }
              
              // set all images and container to this height
              $(this).find(".slide").height(slide_height);                      
              $(this).find(".slide_content").height(slide_height);
              
              if($(this).find(".slide").length > 1){
                     //reset the slider so the first image is still visible          
                     var position = $(this).find(".slide.current").index();
                     var offset = position * imgWidth;
                     container.css({'left':-offset+'px'});
              }
              //scale buttons
              scale_buttons();
       });
};

function scale_buttons(){
       var s_height = $(".gallery_button").closest(".slideshow").find(".slide").height();
       $(".gallery_button").each(function(){
             $(this).height(s_height); 
       });
}