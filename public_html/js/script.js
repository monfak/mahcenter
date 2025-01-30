//menu//


if (matchMedia('only screen and (min-width: 992px)').matches) {
 $(document).ready(function(){
		$(".menu .dropdown").hover(
			function() {
				
				 if(!$(this).hasClass('show')) {
				   $(this).addClass('show');
				 }  
			},
			function() {
			
				if($(this).hasClass('show')) {
					   $(this).removeClass('show');
				  } 
			}
		);
	});
$(".nav-item.dropdown").hover(function(){
       $('.overlay').addClass('is-active');   
});
$( ".nav-item.dropdown" ).mouseleave(function() {
	  $('.overlay').removeClass('is-active');  
 });
}


 //slider//

	var heroSlider = $('.owl-slider');
	var owlCarouselTimeout = 3000;
	heroSlider.owlCarousel({
	loop: true,
	items: 1,
	autoplay: true,
	smartSpeed:450,
	autoplayHoverPause: true,
	rtl:true,
	nav:true, 
	dots:true,
	 navText: ["",""],
	
});
heroSlider.on('mouseleave',function(){
	   heroSlider.trigger('stop.owl.autoplay');
	   heroSlider.trigger('play.owl.autoplay', [owlCarouselTimeout]);
	})
	
	

//scroller//
 function AutoScrollOff() {
        clearTimeout(autoScroll);
        content.removeClass("auto-scrolling-on").mCustomScrollbar("stop");
    }

    var content=$(".admin-content"),autoScrollTimer=8000,autoScrollTimerAdjust,autoScroll;
    content.mCustomScrollbar({
        scrollButtons:{enable:true},
        autoHideScrollbar:true,
        callbacks:{
            whileScrolling:function(){
                autoScrollTimerAdjust=autoScrollTimer*this.mcs.topPct/100;
            },
            onScroll:function(){
                if($(this).data("mCS").trigger==="internal"){AutoScrollOff();}
            }
        }
    });
	 function AutoScrollOff() {
        clearTimeout(autoScroll);
        content.removeClass("auto-scrolling-on").mCustomScrollbar("stop");
    }

    var content1=$("#vertical_navigation"),autoScrollTimer=8000,autoScrollTimerAdjust,autoScroll;
    content1.mCustomScrollbar({
        scrollButtons:{enable:true},
        autoHideScrollbar:true,
        callbacks:{
            whileScrolling:function(){
                autoScrollTimerAdjust=autoScrollTimer*this.mcs.topPct/100;
            },
            onScroll:function(){
                if($(this).data("mCS").trigger==="internal"){AutoScrollOff();}
            }
        }
    });
//shoar//
	
	$('.owl-icon').owlCarousel({
	  rtl:true,
	  margin:0,
	  nav: false,
	  navText: ["<i class='fas fa-angle-left'></i>","<i class='fas fa-angle-right'></i>"],
	  responsive:{
			0:{
				items:1,
			    autoplay: true,
				loop: true,
				dots:true
			},
			400:{
				items:2,
				autoplay: true,
				loop: true,
				dots:true
			},
			600:{
				items:2,
				autoplay: true,
				loop: true,
				 dots:true
			},
			1000:{
				items:2,
				autoplay: true,
				loop: true,
				 dots:true
			},
			1200:{
				items:3,
				 touchDrag: false,
                 mouseDrag: false
			}
			
		}
	});
	

	//menu-mob
		
		
	

       $(function () {
        $("[rel='tooltip']").tooltip();
    });