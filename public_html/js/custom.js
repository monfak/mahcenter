var owl = $('.owl-carousel');
$('#index-slider').owlCarousel({
    loop: true,
	rtl:true,
	 items: 1,
	 responsive: {
        0: {
          nav: false,
         dots: true
        },
        768: {
           nav: true,
         dots: false
		}
    }
})

var owl = $('#owl-moment');
owl.owlCarousel({
    loop: true,
    autoplay: true,
    dots: false,
    autoplayTimeout: 3000,
    touchDrag: false,
    pullDrag: false,
    responsive: {
        0: {
            items: 1
        },
        600: {
            items: 1
        },
        1000: {
            items: 1
        }
    }
})

var owl = $('.owl-carousel');
$('#owl-one').owlCarousel({
    rtl: true,
    margin: 10,
    nav: true,
    loop: true,
    dots: false,
    responsive: {
        0: {
            items: 1
        },
        600: {
            items: 3
        },
        1000: {
            items: 4
        }
    }
})

var owl = $('.owl-carousel');
$('#owl-two').owlCarousel({
    rtl: true,
    margin: 10,
    nav: true,
    loop: true,
    dots: false,
    responsive: {
        0: {
            items: 1
        },
        600: {
            items: 3
        },
        1000: {
            items: 4
        }
    }
})

var owl = $('.owl-carousel');
$('.owl-send').owlCarousel({
    rtl: true,
    margin: 10,

    dots: false,
    responsive: {
        0: {
            items: 1,
			dots:true
        },
        600: {
            items: 3,
			dots:true
        },
        1000: {
            items: 5
        }
    }
})

var owl = $('.owl-carousel');
$('.owl-special').owlCarousel({
    rtl: true,
    margin: 10,

    dots: false,
    responsive: {
        0: {
            items: 2,
			dots:true
        },
        600: {
            items: 3,
			dots:true
        },
        1000: {
            items: 4
        }
    }
})

var owl = $('.owl-carousel');
$('.owl-wonderfull').owlCarousel({
    nav: true,
	rtl:true,
	 items: 1
    
})
	
/**
 * Sets a downtime flip clock with the specific seconds.
 * 
 * @param clockId id of the div that display the downtime counter
 * @param time the remained second to finish the special offer.
 * @constructor
 */
function SetFlipClock(clockId, time) {
    var clock;
    clock = $('#'+clockId).FlipClock({
        clockFace: 'DailyCounter',
        autoStart: false,
	
        callbacks: {
            stop: function () {
                $('.message').html('The clock has stopped!')
            }
        }
    });
    clock.setTime(time);
    clock.setCountdown(true);
    clock.start();
}

/**
 * Sets the X-CSRF_TOKEN to use in ajax requests.
 */
$.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
});

/**
 * Updates quantity of a product in the cart using ajax.
 * 
 * @param product_id
 * @param quantity
 */
function updateCart(product_id, quantity) {
    if (quantity === undefined) {
        quantity = 1;
    }
    $.ajax({
        type: 'PATCH',
        url: "/cart/update/" + product_id,
        data: {
            'quantity': quantity,
            _method: "PATCH"
        },
        success: function(message) {
            // Set sth
            if(message.status == 'success') {
                iziToast.success({
                    message: message.body,
                    'position': 'topLeft'
                });
                $('.itemsInBasket').html(message.itemsInBasket);
            } else {
                iziToast.error({
                    message: message.body,
                    'position': 'topLeft'
                });
            }
        },
        error: function(e) {
            // Set sth
            iziToast.error({
                message: 'متاسفانه بروزرسانی سبد خرید شکست خورد.',
                'position': 'topLeft'
            });
        }
    });
}

/**
 * Deletes a product from the cart using ajax.
 * 
 * @param product_id
 */
function removeFromCart(product_id) {
    $.ajax({
        type: 'DELETE',
        url: "/cart/delete/" + product_id,
        data: {
            _method: "DELETE"
        },
        success: function(message) {
            // Set sth
            if(message.status == 'success') {
                iziToast.success({
                    message: message.body,
                    'position': 'topLeft'
                });
                $('.itemsInBasket').html(message.itemsInBasket);
            } else {
                iziToast.error({
                    message: message.body,
                    'position': 'topLeft'
                });
            }
        },
        error: function(e) {
            // Set sth
            iziToast.error({
                message: 'متاسفانه بروزرسانی سبد خرید شکست خورد.',
                'position': 'topLeft'
            });
        }
    });
}

/**
 * Adds a product to the wishlist using ajax.
 *
 * @param product_id
 */
function addToWishlist(product_id) {
    $.ajax({
        type: 'POST',
        url: "/wishlist/add/" + product_id,
        data: {
            _method: "POST"
        },
        success: function(message) {
            // Set sth
            if(message.status == 'success') {
                iziToast.success({
                    message: message.body,
                    'position': 'topLeft'
                });
                $('.itemsInWishlist').html(message.itemsInWishlist);
                $(window).scrollTop(0);
            } else {
                iziToast.error({
                    message: message.body,
                    'position': 'topLeft'
                });
            }
        },
        error: function(e) {
            // Set sth
            iziToast.error({
                message: 'متاسفانه مشکلی در افزودن محصول به علاقه‌مندی‌های شما پیش آمد.',
                'position': 'topLeft'
            });
        }
    });
}

/**
 * Adds a product to the compare list using ajax.
 *
 * @param product_id
 */
function addToCompare(product_id) {
    $.ajax({
        type: 'POST',
        url: "/compare/add/" + product_id,
        data: {
            _method: "POST"
        },
        success: function(message) {
            // Set sth
            if(message.status == 'success') {
                iziToast.success({
                    message: message.body,
                    'position': 'topLeft'
                });
                window.location.href = '/compare';
                $('.itemsInCompare').html(message.itemsInCompare);
            } else {
                iziToast.error({
                    message: message.body,
                    'position': 'topLeft'
                });
            }
        },
        error: function(e) {
            // Set sth
            iziToast.error({
                message: 'متاسفانه مشکلی در افزودن محصول به بخش مقایسه پیش آمد.',
                'position': 'topLeft'
            });
        }
    });
}

$(document).ready(function(){
   $('.addToNotifications').on('click', function() {
        var productId = $(this).find('.productId').val();
        var status = $(this).find('.nofity-status').val();
        addToNotifications(productId, status);
    });
});

function addToNotifications(product_id, status) {
    $.ajax({
        type: 'POST',
        url: "/notification/toggle/" + product_id,
        data: {
            _method: "POST"
        },
        success: function(message) {
            // Set sth
            if(message.status == 'success') {
                iziToast.success({
                    message: message.body,
                    'position': 'topLeft'
                });
                value = status == 'yes' ? 'no' : 'yes';
                type = status == 'yes' ? 'bell' : 'bell-slash';

                $('.nofity-status').val(value);
                if(status == 'yes'){
                    $('.addToNotifications').removeClass('red');
                }else{
                    $('.addToNotifications').addClass('red');
                }

                var  list=document.getElementById("bell").classList;
                var  list=document.getElementById("test").classList;

                if(list.value != "fa fa-" + type){
                    $('#bell').removeClass(list.value);
                    $('#bell').addClass("fa fa-" + type);
                    $('#test').removeClass(list.value);
                    $('#test').addClass("fa fa-" + type);
                    $('.notify_message').html("موجود شد اطلاع بده");
                }
                $(window).scrollTop(0);
            } else {
                iziToast.error({
                    message: message.body,
                    'position': 'topLeft'
                });
            }
        },
        error: function(e) {
            // Set sth
            iziToast.error({
                message: 'متاسفانه مشکلی پیش آمده است.',
                'position': 'topLeft'
            });
        }
    });
}



/**
 * Find productId inside a addToWishlist and add to the wishlist.
 */
$(document).ready(function () {
    $('.addToWishlist').on('click', function() {
        var productId = $(this).find('.productId').val();
        addToWishlist(productId);
    });
});

/**
 * Find productId inside a addToCompare and add to the compare list.
 */
$(document).ready(function () {
    $('.addToCompare').on('click', function() {
        var productId = $(this).find('.productId').val();
        addToCompare(productId);
    });
});

var tabCarousel = setInterval(function () {
    var tabs = $('#v-pills-tab > a'),
        active = tabs.filter('.active'),
        next = active.next('a'),
        toClick = next.length ? next : tabs.eq(0);
    toClick.trigger('click');
}, 7000);
/////////////////////////////////////
//Retains the current star rating
var starRating = 0;

$(".star-ratings .star").hover(
    function (e) {
        //Add yellow colour to current and previous stars
        var hoveredStars = $(this).nextAll().add(this);
        hoveredStars.addClass("hovered");

        //Remove yellow caused by rated stars so that the hovering shows the new potential rating
        var allStars = $(this).siblings().add(this);
        allStars.removeClass("rated-star");
    },
    function (e) {
        //Remove all yellow caused by hovering
        var allStars = $(this).siblings().add(this);
        allStars.removeClass("hovered unhovered");

        //Add back yellow caused by rated stars to the correct number of rated stars
        allStars.slice(0, starRating).addClass("rated-star");
    }
);

$(".star-ratings .star").on("click", function (e) {

    //Removes the rated-star class from all stars in case a rating was provided earlier
    var allStars = $(this).siblings().add(this);
    allStars.removeClass("rated-star");

    //Adds the the rated-star class to the stars corresponding with the clicked rating
    var hoveredStars = $(this).nextAll().add(this);
    hoveredStars.addClass("rated-star");

    //Update the starRating variable with the new rating
    starRating = hoveredStars.length;
});


$('.sim-thumb').on('click', function () {
    $('#main-product-image').attr('src', $(this).data('image'));
})



 $(".set > span").on("click", function(){
	if($(this).hasClass('active')){
	  $(this).removeClass("active");
	  $(this).siblings('.content').slideUp(200);
	  $(".set > span i").removeClass("fas fa-chevron-up").addClass("fas fa-chevron-up");
	}else{
	  $(".set > span i").removeClass("fas fa-chevron-up").addClass("fas fa-chevron-up");
	$(this).find("i").removeClass("fas fa-chevron-down").addClass("fas fa-chevron-up");
	$(".set > span").removeClass("active");
	$(this).addClass("active");
	$('.content').slideUp(200);
	$(this).siblings('.content').slideDown(200);
	}
                    
  });

	 
	
$('#close').click(function(){
    $('#modal-start').removeClass('show');
	$('#modal-start').addClass('hide');
    $('body').addClass('over');
})
	

$(' .more-info-pro a').click(function() {
	$('.more-info-pro i').toggleClass('chevron-up');
	$(this).text(function(i,old){
        return old=='نمایش بیشتر' ?  'نمایش کمتر' : 'نمایش بیشتر';
    }); 
});
$(".nav-item.dropdown").hover(function(){
    $('.overlay').addClass('is-active');   
    $('.nav.panel-tabs').addClass('hide-tab');
    $(this).addClass('show');
});
$( ".nav-item.dropdown" ).mouseleave(function() {
	$('.overlay').removeClass('is-active');
	$('.nav.panel-tabs').removeClass('hide-tab');  
	$(this).removeClass('show');
});
$('.serach-mob').click(function () {
    $('.search-input').toggleClass('show-search');
});

$('.menu-item').hover(function() {
    let id = $(this).attr('id');
    $('.lazymenu').each(function(){
        if(id == ('menu-item' + $(this).attr('data-menu'))) {
            $(this).attr("src", $(this).attr("data-original")).removeAttr("data-original");
        }
    }); 
});

if ($(".owl-slider").length) {
  $(document).ready(function () {
    var owl = $(".owl-slider");
    $(".owl-slider").owlCarousel({
      loop: true,
      autoplay: true,
      autoplayTimeout: 5000,
      autoplayHoverPause: true,
      //animateIn: 'fadeIn',
      //animateOut: 'fadeOut',
      smartSpeed: 450,
      items: 1,
      navText: [""],
      rtl: true,
      responsive: {
        0: {
          dots: true,
          margin: 0,
          nav: false,
        },
        768: {
          dots: true,
          margin: 0,
          nav: true,
        },
      },
    });
  });
}
if ($(".owl-best-pro").length) {
  var heroSlider = $(".owl-best-pro");
  var owlCarouselTimeout = 3500;
  $(".owl-best-pro").owlCarousel({
    // autoplay: true,
    // loop: true,
    //autoplayHoverPause: true,
    smartSpeed: 450,
    rtl: true,
    margin: 0,
    dots: false,
    margin: 15,
    lazyLoad: true,
    responsive: {
      0: {
        nav: false,
        items: 1
      },
      400: {
        nav: false,
        items: 1
      },
      440: {
        nav: false,
        items: 2,
        stagePadding: 20,
      },
      768: {
        nav: false,
        items: 2,
        stagePadding: 30,
      },
      992: {
        nav: false,
        items: 4,
        stagePadding: 10,
      },
      1200: {
        nav: true,
        items: 4,
      },
    },
  });
}
//owl-wnd
if ($(".owl-wnd").length) {
  var heroSlider = $(".owl-wnd");
  var owlCarouselTimeout = 3500;
  $(".owl-wnd").owlCarousel({
    autoplay: true,
    // loop: true,
    //autoplayHoverPause: true,
    smartSpeed: 450,
    rtl: true,
    margin: 0,
    dots: false,
    margin: 5,
    lazyLoad: true,
    responsive: {
      0: {
        nav: false,
        items: 1,
        stagePadding: 10,
      },
      400: {
        nav: false,
        items: 1,
        stagePadding: 20,
      },
      440: {
        nav: false,
        items: 2,
        stagePadding: 20,
      },
      768: {
        nav: false,
        items: 2,
        stagePadding: 30,
      },
      992: {
        nav: false,
        items: 4,
        stagePadding: 10,
      },
      1200: {
        nav: true,
        stagePadding: 20,
        items: 5,
      },
    },
  });
}
if ($(".owl-category").length) {
  var heroSlider = $(".owl-category");
  var owlCarouselTimeout = 3500;
  $(".owl-category").owlCarousel({
    // autoplay: false,
    //loop: true,
    //autoplayHoverPause: true,
    smartSpeed: 450,
    rtl: true,
    margin: 0,
    margin: 10,
    lazyLoad: true,
    responsive: {
      0: {
        dots: false,
        items: 2,
        nav: false,
        stagePadding: 40,
      },

      400: {
        dots: false,
        items: 3,
        nav: false,
        stagePadding: 20,
      },
      500: {
        dots: false,
        items: 4,
        nav: false,
        stagePadding: 50,
      },
      768: {
        dots: false,
        items: 4,
        nav: false,
      },
      1200: {
        dots: false,
        items: 6,
        nav: true,
        touchDrag: false,
        mouseDrag: false,
      },
    },
  });
}
if ($(".owl-main-category").length) {
  var heroSlider = $(".owl-main-category");
  var owlCarouselTimeout = 3500;
  $(".owl-main-category").owlCarousel({
    autoplay: true,
    loop: true,
    autoplayHoverPause: true,
    autoplaySpeed: 200,
    smartSpeed: 200,
    rtl: true,
    margin: 0,
    margin: 10,
    lazyLoad: true,
    responsive: {
      0: {
        dots: false,
        items: 2,
        nav: false,
        stagePadding: 40,
      },

      400: {
        dots: false,
        items: 3,
        nav: false,
        stagePadding: 20,
      },
      500: {
        dots: false,
        items: 4,
        nav: false,
        stagePadding: 50,
      },
      768: {
        dots: false,
        items: 4,
        nav: false,
      },
      1200: {
        dots: false,
        items: 6,
        nav: true,
        touchDrag: false,
        mouseDrag: false,
      },
    },
  });
}
if (matchMedia("only screen and (max-width: 768px)").matches) {
  $(".set > span").on("click", function () {
    if ($(this).hasClass("active")) {
      $(this).removeClass("active");
      $(this).siblings(".content").slideUp(200);
      $(".set > span i")
        .removeClass("fas fa-chevron-up")
        .addClass("fas fa-chevron-up");
    } else {
      $(".set > span i")
        .removeClass("fas fa-chevron-up")
        .addClass("fas fa-chevron-up");
      $(this)
        .find("i")
        .removeClass("fas fa-chevron-down")
        .addClass("fas fa-chevron-up");
      $(".set > span").removeClass("active");
      $(this).addClass("active");
      $(".content").slideUp(200);
      $(this).siblings(".content").slideDown(200);
    }
  });
}
$(document).ready(function () {
  "use strict";
  var descMinHeight = 120;
  var desc = $(".c-desc");
  var descWrapper = $(".c-desc-wrapper");
  if (desc.height() > descWrapper.height()) {
    $(".c-more-info").show();
  }

  $(".c-more-info").click(function () {
    var fullHeight = $(".c-desc").height();

    if ($(this).hasClass("expand")) {
      // contract
      $(".c-desc-wrapper").animate({ height: descMinHeight }, "slow");
      $(".c-desc-wrapper").addClass("shaodow");
    } else {
      // expand
      $(".c-desc-wrapper")
        .css({ height: descMinHeight, "max-height": "none" })
        .animate({ height: fullHeight }, "slow");
      $(".c-desc-wrapper").removeClass("shaodow");
    }

    $(this).toggleClass("expand");
    return false;
  });
});
$(function () {
  $(".scroll-down-icon a").on("click", function (e) {
    e.preventDefault();
    $("html, body").animate(
      {
        scrollTop: $($(this).attr("href")).offset().top,
      },
      500,
      "linear"
    );
  });
});

//gap
$(".menuTrigger").click(function () {
  $(".panel-menu").toggleClass("isOpen");
});

$(".openSubPanel").click(function () {
  $(this).next(".subPanel").addClass("isOpen");
});

$(".closeSubPanel").click(function () {
  $(".subPanel").removeClass("isOpen");
});

$("#panel-menu").on("click", function (e) {
  var target = $(e.target);
  if (
    target.attr("id") == "menu-toggle" ||
    target.parents("#panel-menu").length > 0 ||
    target.parents(".panel-menu").length > 0
  ) {
    console.log(
      "id: " +
        target.attr("id") +
        "contains: " +
        $.contains(target, $(".panel-menu"))
    );
  } else {
    if ($(".panel-menu").hasClass("isOpen"))
      $(".panel-menu").removeClass("isOpen");
    $(".subPanel").removeClass("isOpen");
  }
});

$(".closePanel").click(function () {
  $(".panel-menu").removeClass("isOpen");
  $(".subPanel").removeClass("isOpen");
});
//gap

if ($(".owl-send").length) {
  $(".owl-send").owlCarousel({
    // autoplay: true,
    loop: false,
    rtl: true,
    nav: false,
    navText: [
      "<i class='fas fa-angle-left'></i>",
      "<i class='fas fa-angle-right'></i>",
    ],
    lazyLoad: true,
    responsive: {
      0: {
        margin: 5,
        items: 3,
        dots: true,
      },
      500: {
        margin: 10,
        items: 4,
        dots: false,
      },
      768: {
        margin: 10,
        items: 4,
        dots: true,
      },
      991: {
        margin: 10,
        items: 4,
        dots: true,
      },
      1200: {
        margin: 5,
        items: 5,
      },
    },
  });
}

if ($(".header").length) {
  $(document).ready(function () {
    $(window).scroll(function () {
      if ($(window).scrollTop() > 100) {
        $(".header").addClass("sticky-menu");
      } else {
        $(".header").removeClass("sticky-menu");
      }
    });
  });
}

function initCategoryBar() {
  var $overlay = $(".js-menu-overlay"),
    $naviOverlay = $(".js-navi-overlay"),
    $megaMenuMain = $(".js-mega-menu-main-item"),
    $megaMenuOptionsContainer = $(".js-mega-menu-categories-options"),
    $hoverEffect = $(".js-navi-new-list-category-hover"),
    $headerLinks = $(".js-categories-bar-item"),
    $megaMenuCategory = $(".js-mega-menu-category"),
    $searchBar = $(".js-search"),
    $searchResults = $(".js-search-results");

  var moveHover = function (self) {
    var parent = self.parent().parent().parent();

    $hoverEffect
      .css("width", self.width())
      .css(
        "right",
        parent.width() -
          (self.offset().left + self.width()) +
          parent.offset().left
      );
    $hoverEffect.css("transform", "scaleX(1)");
  };

  var removeHover = function () {
    $hoverEffect.css("transform", "scaleX(0)");
  };

  $headerLinks.hover(
    function () {
      moveHover.call(this, $(this));
    },
    function () {
      removeHover.call(this, $(this));
    }
  );

  $megaMenuMain.on("click", function (e) {
    e.stopPropagation();
  });

  var hoverAction;
  $megaMenuMain.hover(
    function () {
      var $this = $(this);
      hoverAction = setTimeout(function () {
        $this
          .children(".js-mega-menu-categories-options")
          .css("display", "flex");
        $naviOverlay.addClass("is-active");
        $searchResults.removeClass("is-active");
        $searchBar.removeClass("is-active");
      }, 200);
    },
    function () {
      hoverAction && clearTimeout(hoverAction);
      $naviOverlay.removeClass("is-active");
      $megaMenuOptionsContainer.hide();
    }
  );

  $megaMenuCategory.hover(
    function () {
      $megaMenuOptionsContainer
        .find(".js-categories-ad")
        .removeClass("ad-is-active");
      $megaMenuOptionsContainer
        .find("#categories-ad-" + $(this).data("index"))
        .addClass("ad-is-active");

      $megaMenuOptionsContainer
        .find(".js-mega-menu-category-options")
        .removeClass("is-active");
      $megaMenuCategory.removeClass("c-navi-new-list__inner-category--hovered");
      $(this).addClass("c-navi-new-list__inner-category--hovered");
      $megaMenuOptionsContainer
        .find("#categories-" + $(this).data("index"))
        .addClass("is-active");
    },

    function () {}
  );

  $overlay.hover(function () {
    if (!$(this).is(".is-active")) return true;
  });

  $megaMenuCategory.hover(
    function () {
      $megaMenuOptionsContainer
        .find(".js-categories-ad")
        .removeClass("ad-is-active");
      $megaMenuOptionsContainer
        .find("#categories-ad-" + $(this).data("index"))
        .addClass("ad-is-active");

      $megaMenuOptionsContainer
        .find(".js-mega-menu-category-options")
        .removeClass("is-active");
      $megaMenuCategory.removeClass("c-navi-new-list__inner-category--hovered");
      $(this).addClass("c-navi-new-list__inner-category--hovered");
      $megaMenuOptionsContainer
        .find("#categories-" + $(this).data("index"))
        .addClass("is-active");
    },

    function () {}
  );
}

function initStatic() {
  var $overlay = $(".js-menu-overlay"),
    $naviOverlay = $(".js-navi-overlay"),
    $newCategories = $(".js-navi-new-list-categories"),
    $newCategoryItem = $(".js-navi-new-list-category"),
    $hoverEffect = $(".js-navi-new-list-category-hover"),
    allCategoriesButton = $(".js-navi-new-list__all-links"),
    sentBanners = [];

  this.openCategories = false;
  var mainJs = this;

  $(".js-navi").hover(function () {
    $(this)
      .find("img[data-src]")
      .each(function () {
        $(this).attr("src", $(this).attr("data-src")).removeAttr("data-src");
      });
  });

  var moveHover = function (self) {
    var parent = self.parent().parent().parent();

    $hoverEffect
      .css("width", self.width())
      .css(
        "right",
        parent.width() -
          (self.offset().left + self.width()) +
          parent.offset().left
      );
    if ($(this).hasClass("is-fmcg")) {
      $hoverEffect.addClass("is-fmcg");
    } else {
      $hoverEffect.removeClass("is-fmcg");
    }
    $hoverEffect.css("transform", "scaleX(1)");
  };

  var removeHover = function () {
    $hoverEffect.css("transform", "scaleX(0)");
  };

  var handlerHover = function () {
    clearTimeout(this.closeTimer);
    var self = $(this);

    this.timer = setTimeout(function () {
      $("body").click();
      $naviOverlay.addClass("is-active");
      self.addClass("can-show-menu");
      self.siblings(".js-navi-new-list-category").addClass("can-show-menu");
      self.find(".js-navi-new-list-category").addClass("can-show-menu");
      mainJs.openCategories = true;
      var id = self.find(".c-adplacement__item").data("id");

      if (id && sentBanners.indexOf(id) < 0) {
        snt("dkBannerViewed", {
          bannerId: id,
          created_at: Date.now(),
        });
        sentBanners.push(id);
      }
      $(".js-search-results").removeClass("is-active");
    }, 200);
    if (self.hasClass("js-navi-new-list-category")) {
      moveHover.call(this, self);
    }
  };
  var handlerOut = function () {
    clearTimeout(this.timer);
    var self = this;

    this.closeTimer = setTimeout(function () {
      if ($(".js-search-results").hasClass("is-active")) return;
      $(self).hasClass("js-navi-new-list-categories")
        ? $naviOverlay.removeClass("is-active")
        : "";
      $(self).find(".js-navi-new-list-category").removeClass("can-show-menu");
      $(self).hasClass("can-show-menu")
        ? $(self).removeClass("can-show-menu")
        : "";
      mainJs.openCategories = false;
    }, 200);
    removeHover();
  };

  // $('.js-navi-list-promotion-item').hover(function () {
  //     moveHover.call(this, $(this));
  // }, removeHover);

  var $w = $(window),
    lastY = $w.scrollTop();

  $(window).scroll(function () {
    var currentPosition = $w.scrollTop();

    if (!mainJs.openCategories) {
      return (lastY = currentPosition);
    }
    if (currentPosition - lastY < -5) {
      var e = jQuery.Event("mouseout");

      $newCategories.trigger(e);

      $newCategoryItem.trigger(e);
    }
    lastY = currentPosition;
  });

  $newCategories.hover(handlerHover, handlerOut);
  $newCategoryItem.hover(handlerHover, handlerOut);
  allCategoriesButton.hover(function (e) {
    e.stopPropagation();
    e.preventDefault();
    $naviOverlay.removeClass("is-active");
  });
  $overlay.hover(function () {
    if (!$(this).is(".is-active")) return true;
  });

  $(".js-expert-article-button").on("click", function (e) {
    var $this = $(this),
      $article = $this.closest(".js-expert-article");

    if ($article.hasClass("is-active")) {
      $article.removeClass("is-active");
    } else {
      $article.addClass("is-active");
    }

    e.preventDefault();

    window.dispatchEvent(new Event("scroll"));
  });

  var $deliveryLabels = $(".js-delivery-label");

  $deliveryLabels.click(function () {
    var $this = $(this);

    if ($this.hasClass("is-read-only")) {
      return;
    }

    $deliveryLabels.removeClass("is-selected");
    $this.addClass("is-selected");
  });

  $deliveryLabels.each(function () {
    var $this = $(this);
    var $radio = $this.find('input[type="radio"]');

    if ($radio.is(":checked")) {
      $this.addClass("is-selected");
    }
  });
}
$(document).ready(function () {
  initCategoryBar();
  initStatic();
});

$(".back-to-top").click(function () {
  $("html,body").animate(
    {
      scrollTop: 0,
    },
    1000
  );
  return false;
});

$(document).ready(function () {
  var tooltipTriggerList = [].slice.call(
    document.querySelectorAll('[data-bs-toggle="tooltip"]')
  );
  var tooltipList = tooltipTriggerList.map(function (tooltipTriggerEl) {
    return new bootstrap.Tooltip(tooltipTriggerEl);
  });
});

var heroSlider = $(".owl-news");
var owlCarouselTimeout = 3500;
$(".owl-news").owlCarousel({
  //autoplay: true,
  //loop: true,

  autoplayHoverPause: true,
  smartSpeed: 450,
  rtl: true,

  navText: [""],
  lazyLoad: true,
  responsive: {
    0: {
       margin: 10,   
      dots: false,
      nav: false,
      stagePadding: 20,
      items: 1,
    },
    500: {
       margin: 10,   
      dots: false,
      nav: false,
      items: 2,
    },
    768: {
        margin: 20,  
      dots: false,
      nav: true,
      items: 2,
    },
    1200: {
          margin: 20,
      dots: false,
      nav: true,
      items: 4,
    },
  },
});

function resize() {
  var calculatePadding = parseInt($(".header").css("height"));
  $(".body-content").css({
    "padding-top": calculatePadding,
  });
}
$(document).ready(function () {
  resize();
});

$(document).ready(function () {
  $(".wa__btn_popup_icon").on("click", function (e) {
    $(".wa__popup_chat_box").toggleClass("show");
    $(this).toggleClass("active");
  });
});

$(document).ready(function () {
  var heroSlider = $(".owl-logo");
  var interval = 0;
  $(".owl-logo").owlCarousel({
    autoplayHoverPause: true,
    autoplay: true,
    loop: true,
    margin: 10,
    autoplaySpeed: 5000,

    rtl: true,
    navText: [""],
    lazyLoad: true,
    responsive: {
      0: {
        slideBy: 3,
        items: 3,
      },
      500: {
        slideBy: 4,
        items: 4,
      },
      768: {
        slideBy: 5,
        items: 5,
      },
      1200: {
        slideBy: 8,
        items: 8,
        dots: false,
        nav: false,
      },
    },
  });
});

//setup before functions
var typingTimer; //timer identifier
var doneTypingInterval = 10; //time in ms, 5 second for example
var $input = $("#phrase");
var $category = $("#frm-cat-id");
$input.on("focus", function () {
  if ($input.val() == "") {
    $("#result-show").css("display", "block");
    $(".example").addClass("dark");
  } else {
    $("#result-show").css("display", "none");
    $(".example").removeClass("dark");
  }
});
$input.on("keyup", function () {
  clearTimeout(typingTimer);
  typingTimer = setTimeout(doneTyping, doneTypingInterval);
});
$category.change(function () {
  clearTimeout(typingTimer);
  typingTimer = setTimeout(doneTyping, doneTypingInterval);
});

/**
 * Change shipping address using ajax.
 * 
 * @param address_id
 */
function changeAddress(address) {
    $.ajax({
        type: 'POST',
        url: "/details",
        data: {
            address: address,
            _method: "POST"
        },
        success: function(respond) {
            if(respond.status == 'success') {
                iziToast.success({
                    message: respond.body,
                    'position': 'topLeft'
                });
            } else {
                iziToast.error({
                    message: respond.body,
                    'position': 'topLeft'
                });
            }
        },
        error: function(e) {
            iziToast.error({
                message: 'متاسفانه مشکلی در تغییر آدرس محصول پیش آمد.',
                'position': 'topLeft'
            });
        }
    });
}

/**
 * Change address.
 */
$(document).ready(function () {
    $('.shipping_address').on('click', function() {
        var address = this.value;
        changeAddress(address);
    });
    let isProcessing = false;

    $(document).on('click', '.cat-filter', function (event) {
        if (isProcessing) return;
        isProcessing = true;
    
        if ($(this).hasClass('close')) {
            $(this).addClass('open').removeClass('close');
        } else if ($(this).hasClass('open')) {
            $(this).addClass('close').removeClass('open');
        }
    
        setTimeout(() => {
            isProcessing = false;
        }, 500);
    });
});
