var $ = jQuery.noConflict();

var w_height;
var w_width;
var scrolled =0;
var preview_box_width;
var preview_entry_height;
var at_the_top;
var ratio;

              
$(document).ready(function() {
       get_content_from_url();
       click_handlers();
});

$(window).load(function(){
       resize();
       
       set_main_slideshow_height();
       setup_slideshow();
       
       fade_in_page();
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
       apply_ratio();
       
       fix_header();
       
       scale_slideshow();
       set_main_slideshow_height();
}

function click_handlers(){
       load_page();
       big_box_hover();
}



function fade_in_page(){
       var page = $("#page");
       
       page.animate({
              opacity: 1
              }, 500, function() {
                     
                     }
              );
}



// SCROLLING FUNCTIONS


function scroll_box_offset(){
       if($(".big_box_sub_menu").hasClass("open")){
              $("#big_box_row").css("marginTop",0);  
       }else{
              var dif = $(".big_box_sub_menu").outerHeight() - scrolled;
              
              if(dif >= 0){
                     $("#big_box_row").css("marginTop",-dif);  
              }
       }     
}




// SCALING / RESIZING FUNCTIONS

function get_dimensions(){
       w_height = $(window).height();
       w_width = $(document).width();
}

function basic_scaling(){
       var set_margin = 35;
       
       var logo1_w = $(".logo1").width();
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




// big_box functionality
var sub_box =$("#big_box_sub_row");

function big_box_hover(){
       
       var id;
       var sub_row;
       var ele;
       
       //SHOW
       //show sub menu
       var delay=200, setTimeoutConst;
       
       $('.big_box').hover(function() {
              ele = $(this);
              
              setTimeoutConst = setTimeout(function(){
                     
                     id = ele.attr("id");
                     sub_row = $(".big_box_sub_menu."+id);
                     show_sub_menu(sub_row);
              
              }, delay);
       }, function(){
              // reset delay
              clearTimeout(setTimeoutConst );
       });


       //HIDE
       // big_box_row includes the sub_row
       var delay=200, setTimeoutConst2;
       
       $('#big_box_row').hover(function() {
              // reset delay
              clearTimeout(setTimeoutConst2 );
              
       }, function(){
              // mouseout big_box
              setTimeoutConst2 = setTimeout(function(){
                     $(".big_box_sub_menu").removeClass("active");
                     
                     // if sub_menu has class .open 
                     if($(".big_box_sub_menu").hasClass("open") === true){
                            //show this submenu on mouseout
                            sub_row = $(".big_box_sub_menu.open");
                            show_sub_menu(sub_row);
                            
                     }else{
                            hide_sub_box();       
                     }
              }, delay);
              
       });
       
       
}

function show_sub_menu(ele){
       // if container is not open already > open container
       if(sub_box.hasClass("active") === false){
              show_sub_box(); 
       }
       //z-index juggling to put the current row on top
       $(".big_box_sub_menu").css("zIndex",9);
       ele.css("zIndex",10);
       // slide in
       ele.stop().animate({
              opacity: 1,
              bottom: 0
              }, 500, function() {
                     ele.addClass("active");
                     
                     // reset all other sub rows
                     $(".big_box_sub_menu").not(ele).css("bottom","100%")
                     .css("opacity",0)
                     .removeClass("active");      
       });
      
};

function show_sub_box(){
       
       sub_box.css("display","block");
       var go_to_height = $(".big_box_sub_menu").outerHeight();


       sub_box.stop().animate({
              height: go_to_height,
              opacity: 1
              }, 200, "easeInExpo", function() {
                     if(scrolled === 0){
                            offset_big_box();
                     }
              }); 
};

function offset_big_box(){
       // only on homepage big_box is not collapsed
       if($("#big_box_row").hasClass("collapsed") === false){
              // if its not already open / offset
              if($(".big_box_sub_menu").hasClass("open") === false){
                     
                     $("#big_box_row").stop().animate({
                            marginTop: -$(".big_box_sub_menu").outerHeight()
                            }, 500, "easeOutExpo", function() {

                            }); 
              }  
       }   
};

function hide_sub_box(){
       
       if(scrolled === 0){
              reset_big_box();
       }
       
       sub_box.stop().animate({
              height: 0,
              opacity:0
              }, 500, "easeOutExpo", function() {
                     sub_box.css("display","none");
                     
                     $(".big_box_sub_menu").css("opacity",0).removeClass("active");
              }); 
                   
}

function reset_big_box(){
       
       $("#big_box_row").animate({
              marginTop: 0
              }, 500, "easeOutExpo", function() {

              }); 
              
};

// load content on pagerefresh
function get_content_from_url(){
       var url = window.location.pathname;
       path_arr = url.split("/");
       
       var page = path_arr[1];
       var anchor = path_arr[2];
       
       
       
       if(anchor !== undefined){
              if(page === "news" || page === "projekte"){
                     var path = anchor;
              }else{
                    var path = page; 
              }
       }else{
              var path = page;
       } 
       
       if(page){
              ajax_load_page("","",path);  
              var ele = $(".big_box_sub_menu."+page);
              show_sub_menu(ele);
              ele.addClass("open");
       }
       
}

// load_page gets cat/page id and fires ajax_load_page > located in ajax_calls.js

var dfd = $.Deferred();

var current;
var nav;
var current_width;
var nav_margin;
var menu_width;

function load_page(){
       // #page > excludes links in wp admin bar
       // [target!="new"] > not for external links
       // and not for the logos > these will completely reload the page
       $("#page a[target!='new']").not(".logo1").not(".logo2").on("click",function(e){
              e.preventDefault();
              
              $(".big_box_sub_menu").removeClass("open");
              $(".big_box_sub_menu.active").addClass("open");
              
              var cat_id;
              var href= $(this).attr("href");
              var classes = $(this).closest("li, h2").attr("class"); 
              
              //BIG_BOX 
              if( $(this).attr("data_cat_id") ){
                     cat_id = $(this).attr("data_cat_id");
                     ajax_load_page(href,cat_id,"");
              }
              
              
              //MENU
              //if cat_id is in class
              else if(classes.indexOf("menu-cat-") !== -1){
                     var s = classes.indexOf("menu-cat-");
                     var e = classes.indexOf(" ",s);
                     cat_id  = classes.substring(s + 9, e);
                     
                     if(cat_id !== ""){
                            //show sub row
                            var sub_row = $(".big_box_sub_menu.cat_id_"+cat_id);
                            show_sub_menu(sub_row);
                            // add "open" class manually since it has no "active" class from hovering
                            sub_row.addClass("open");
                            
                            ajax_load_page(href,cat_id,"");
                     }
                     
              }
              // no cat_id class -> get page/post id
              else if(classes.indexOf("menu-id-") !== -1){
                     
                     var s = classes.indexOf("menu-id-");
                     var e = classes.indexOf(" ",s);
                     
                     id  = classes.substring(s + 8,e);
                     
                     if(id !== ""){
                            //ajax_load_page(href,id,slug);
                            ajax_load_page(href,id,"");
                     }
              }
              
       });
};

function show_content(result){
       var container = $("#page_content_box");
       container.find("#page_content").html(result);
       container.css("display","block");   
       
       
       container.animate({
              height:container.find("#page_content").innerHeight()
              }, 500, "easeOutQuint", function() {
                     //$('div.wpcf7 > form').wpcf7InitForm();
                     collapes_slideshow();
                     scroll_to_top();
                     collapse_big_box();
                     collapse_menu();
                     //articlefade();
              });

};

function articlefade(){
     $("#page_content_box").find("article").animate({
              opacity:1
              }, 500, "easeOutQuint", function() {
                     
              });
}

function scroll_to_top(){
       $('html,body').animate({
              scrollTop:0
       },1000, "easeOutCirc",function(){
              
       });
}  

function collapes_slideshow(){
       $(".slideshow.main").animate({
              height:0
              },1000, "easeOutCirc", function() {
                     $(this).css("display","none");
              });
}

function collapse_big_box(){
       $("#big_box_row").addClass("collapsed");
       $("#page_content_box").addClass("fixed");
       
       var margin = parseInt($(".logo1").height());
       var bb_h = $("#big_box_row").height();
       
       if(w_width > 600){
              $("#page_content_box").css("marginTop",margin + bb_h);   
       }else{
              $("#page_content_box").css("marginTop",0);   
       }
       
       reset_big_box();
}

function collapse_menu(){
       $("#masthead").addClass("collapsed");
       $("#site-header-menu").removeClass("toggled-on");
       $("#site-header-menu").addClass("search_visible");
       
       fix_header();
}

function fix_header(){
       // check if has class "collapsed"
       // so it works with page refresh as well
       if($("#masthead").hasClass("collapsed")){
              var content_width = $(".container-fluid").width();
              $("#masthead").width(content_width);
              $("#big_box_row").width(content_width);
       }
}


// GALLERY

var img_ratio = 0.5;
var imgWidth = 0;
var img_height = 0;
var num_img_shown = 1;
var stored_img_height = 0;
var slide_height = 0;




function set_main_slideshow_height(){
       if($("#masthead").hasClass("collapsed") === false){
              var wh = $(window).innerHeight();
              var big_box_height = $("#big_box_row").height();
              var admin_bar_height = 0; 
              
              if($("#wpadminbar").length >= 1){
                     admin_bar_height = $("#wpadminbar").outerHeight();
              }
              
              container_height = wh - big_box_height - admin_bar_height;
              $(".slideshow.main").height(container_height);
       }
}

function setup_slideshow(){
       
       $(".slideshow").each(function(index){
              
              var container = $(this).find(".slide_container");

              // set imageWidth
              imgWidth = $(this).find(".slide_content").width() / num_img_shown;
              $(this).find(".slide").width(imgWidth);

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
}


function scale_slideshow(){
       $(".slideshow").each(function(index){
              container = $(this).find(".slide_container");

              // set imageWidth
              imgWidth = $(".slide_content").width() / num_img_shown;
              $(this).find(".slide").width(imgWidth);
              
              if($(this).find(".slide").length > 1){
                     //reset the slider so the first image is still visible          
                     var position = $(this).find(".slide.current").index();
                     var offset = position * imgWidth;
                     container.css({'left':-offset+'px'});
              }
              
       });
};


