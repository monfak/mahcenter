  function initCategoryBar() {
    var $overlay = $(".js-menu-overlay"),
      $naviOverlay = $(".js-navi-overlay"),
      $megaMenuMain = $('.js-mega-menu-main-item'),
      $megaMenuOptionsContainer = $(".js-mega-menu-categories-options"),
      $hoverEffect = $(".js-navi-new-list-category-hover"),
      $headerLinks = $('.js-categories-bar-item'),
      $megaMenuCategory = $('.js-mega-menu-category'),
      $searchBar = $('.js-search'),
      $searchResults = $('.js-search-results');

    var moveHover = function (self) {
      var parent = self
        .parent()
        .parent()
        .parent();

      $hoverEffect
        .css("width", self.width())
        .css(
          "right",
          parent.width()
          - (self.offset().left + self.width())
          + parent.offset().left
        );
      $hoverEffect.css("transform", "scaleX(1)");
    };

    var removeHover = function () {
      $hoverEffect.css("transform", "scaleX(0)");
    };

    $headerLinks.hover(function () {
        moveHover.call(this, $(this));
      },
      function () {
        removeHover.call(this, $(this));
      });

    $megaMenuMain.on('click', function (e) {
      e.stopPropagation();
    });

    var hoverAction;
    $megaMenuMain.hover(
      function () {
        var $this = $(this);
        hoverAction = setTimeout(function () {
          $this.children(".js-mega-menu-categories-options").css('display', 'block');
          $naviOverlay.addClass("is-active");
          $searchResults.removeClass("is-active");
          $searchBar.removeClass("is-active");
        }, 200);
      },
      function () {
        hoverAction && clearTimeout(hoverAction);
        $naviOverlay.removeClass("is-active");
        $megaMenuOptionsContainer.hide()
      });

    $megaMenuCategory.hover(
      function () {


        $megaMenuOptionsContainer.find('.js-categories-ad').removeClass('ad-is-active');
        $megaMenuOptionsContainer.find('#categories-ad-' + $(this).data('index')).addClass('ad-is-active');


        $megaMenuOptionsContainer.find('.js-mega-menu-category-options').removeClass('is-active');
        $megaMenuCategory.removeClass('c-navi-new-list__inner-category--hovered');
        $(this).addClass('c-navi-new-list__inner-category--hovered');
        $megaMenuOptionsContainer.find('#categories-' + $(this).data('index')).addClass('is-active');
      },

      function () {}
    );

    $overlay.hover(function () {
      if (!$(this).is(".is-active")) return true;
    });

    $megaMenuCategory.hover(
      function () {


        $megaMenuOptionsContainer.find('.js-categories-ad').removeClass('ad-is-active');
        $megaMenuOptionsContainer.find('#categories-ad-' + $(this).data('index')).addClass('ad-is-active');


        $megaMenuOptionsContainer.find('.js-mega-menu-category-options').removeClass('is-active');
        $megaMenuCategory.removeClass('c-navi-new-list__inner-category--hovered');
        $(this).addClass('c-navi-new-list__inner-category--hovered');
        $megaMenuOptionsContainer.find('#categories-' + $(this).data('index')).addClass('is-active');
      },

      function () {}
    );

  };

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
          $(this)
            .attr("src", $(this).attr("data-src"))
            .removeAttr("data-src");
        });
    });

    var moveHover = function (self) {
      var parent = self
        .parent()
        .parent()
        .parent();

      $hoverEffect
        .css("width", self.width())
        .css(
          "right",
          parent.width()
          - (self.offset().left + self.width())
          + parent.offset().left
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
            created_at: Date.now()
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
        $(self)
          .find(".js-navi-new-list-category")
          .removeClass("can-show-menu");
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
  };
  $(document).ready(function () {
    initCategoryBar();
    initStatic();

  });

  if ($('.owl-slider').length) {
    $(document).ready(function () {
      var owl = $('.owl-slider');
      $('.owl-slider').owlCarousel({
        loop: true,
        
        margin: 0,
        dots: true,
        autoplay: true,
            autoplayTimeout:7000,
    autoplayHoverPause:true,
        animateOut: 'fadeOut',
        slideSpeed: 5000,
        items: 1,
        animateIn: "fadeIn",
        rtl: true,
		
        dots: true,
		   responsive: {
        0: {
         nav:false,  

        },

       768: {
        nav:true,  
        }

      }  
      });
    });

  }
  
//   if (matchMedia('only screen and (min-width: 992px)').matches) {
    // var heroSlider = $('.owl-wnd');
    // var owlCarouselTimeout = 3500;
    $('.owl-wnd').owlCarousel({
      autoplay: false,
      loop: true,
      //autoplayHoverPause: true,
      smartSpeed: 450,
      rtl: true,
      margin: 0,
      dots: false,
        autoplay: true,
            autoplayTimeout:4000,
    autoplayHoverPause:true,
      lazyLoad: true,
      responsive: {
        0: {
          items: 1,
          nav: false,
          stagePadding: 30

        },

        400: {
          items: 1,
          nav: false,
          stagePadding: 30
        },
        768: {
          items: 3,
          nav: false,

        },
        1200: {
          items: 4,
          nav: true,

        }
        ,
        1400: {
          items: 5,
          nav: true,

        }

      }
    });
//   }
//   if (matchMedia('only screen and (min-width: 992px)').matches) {
    // var heroSlider = $('.owl-newest');
    // var owlCarouselTimeout = 3500;
    $('.owl-newest').owlCarousel({
      autoplay: true,
      loop: true,
      autoplayHoverPause: true,
      smartSpeed: 450,
      rtl: true,
      margin: 0,
      dots: false,
              autoplay: true,
            autoplayTimeout:4000,
    autoplayHoverPause:true,
      margin: 20,
      lazyLoad: true,
      responsive: {
        0: {
          items: 1,
          nav: false,
          stagePadding: 30

        },

        400: {
          items: 1,
          nav: false,
          stagePadding: 30
        },
        768: {
          items: 3,
          nav: false,

        },
        1200: {
          items: 5,
          nav: true,

        }

      }
    });
//   }
  if (matchMedia('only screen and (min-width: 992px)').matches) {
    var heroSlider = $('.owl-best-saler');
    var owlCarouselTimeout = 3500;
    $('.owl-best-saler').owlCarousel({
      autoplay: true,
      loop: true,
      autoplayHoverPause: true,
      smartSpeed: 450,
      rtl: true,
      margin: 0,
      dots: false,
              autoplay: true,
            autoplayTimeout:4000,
    autoplayHoverPause:true,
      margin: 20,
      lazyLoad: true,
      responsive: {
        0: {
          items: 1,
          nav: false,
          stagePadding: 30

        },

        400: {
          items: 1,
          nav: false,
          stagePadding: 30
        },
        768: {
          items: 3,
          nav: false,

        },
        1200: {
          items: 5,
          nav: true,

        }

      }
    });
  }
  if (matchMedia('only screen and (min-width: 768px)').matches) {
    $('.owl-send').owlCarousel({
       autoplay: true,
      loop: true,
      rtl: true,
      nav: false,
      margin: 10,
              autoplay: true,
            autoplayTimeout:4000,
    autoplayHoverPause:true,
      navText: ["<i class='fas fa-angle-left'></i>", "<i class='fas fa-angle-right'></i>"],
      lazyLoad: true,
      responsive: {
        0: {
          items: 3,
          dots: true
        },
        500: {
          items: 3,
          dots: true
        },
        768: {
          items: 4,
          dots: true
        },
        1200: {
          items: 5,
          touchDrag: false,
          mouseDrag: false
        }

      }
    });

  }
  if (matchMedia('only screen and (min-width: 768px)').matches) {
    $('.owl-news').owlCarousel({
       autoplay: true,
      loop: true,
      rtl: true,
      nav: false,
      margin: 10,
              autoplay: true,
            autoplayTimeout:4000,
    autoplayHoverPause:true,
      navText: ["<i class='fas fa-angle-left'></i>", "<i class='fas fa-angle-right'></i>"],
      lazyLoad: true,
      responsive: {
        0: {
          items: 3,
          dots: true
        },
        500: {
          items: 3,
          dots: true
        },
        768: {
          items: 3,
          dots: true
        },
        1200: {
          items: 5
        }

      }
    });

  }
  $('.scrollup').click(function () {
    $("html,body").animate({
      scrollTop: 0
    }, 1000);
    return false;
  });
  $('.owl-logo').owlCarousel({
   autoplay: true,
		  loop: true,
		  smartSpeed:1000,
    rtl: true,
    nav: false,
        autoplay: true,
            autoplayTimeout:4000,
    autoplayHoverPause:true,
    dots: false,
    navText: ["<i class='fas fa-angle-left'></i>", "<i class='fas fa-angle-right'></i>"],
    lazyLoad: true,
    responsive: {
      0: {
        margin: 30,
        items: 3,
        dots: false
      },
      500: {
        items: 3,
        dots: false
      },
      768: {
        margin: 30,
        items: 3,
        dots: false
      },
      1200: {
        margin: 20,
        items: 7
      }

    }
  });
  if (matchMedia('only screen and (max-width: 767.99px)').matches) {
    $(".set > span").on("click", function () {
      if ($(this).hasClass('active')) {
        $(this).removeClass("active");
        $(this).siblings('.content').slideUp(200);
        $(".set > span i").removeClass("fas fa-chevron-up").addClass("fas fa-chevron-up");
      } else {
        $(".set > span i").removeClass("fas fa-chevron-up").addClass("fas fa-chevron-up");
        $(this).find("i").removeClass("fas fa-chevron-down").addClass("fas fa-chevron-up");
        $(".set > span").removeClass("active");
        $(this).addClass("active");
        $('.content').slideUp(200);
        $(this).siblings('.content').slideDown(200);
      }

    });
  }
  $('.menuTrigger').click(function () {
    $('.panel-menu').toggleClass('isOpen');

  });

  $('.openSubPanel').click(function () {
    $(this).next('.subPanel').addClass('isOpen');
  });

  $('.closeSubPanel').click(function () {
    $(this).closest(".subPanel").removeClass("isOpen");
  });

  $("#panel-menu").on("click", function (e) {
    var target = $(e.target);
    if (target.attr('id') == 'menu-toggle' || target.parents('#panel-menu').length > 0 || target.parents('.panel-menu').length > 0) {
      console.log('id: ' + target.attr('id') + 'contains: ' + $.contains(target, $('.panel-menu')));
    } else {
      if ($(".panel-menu").hasClass('isOpen'))
        $(".panel-menu").removeClass("isOpen");
      $('.subPanel').removeClass('isOpen');
    }

  });

  $('.closePanel').click(function () {
    $('.panel-menu').removeClass('isOpen');
    $('.subPanel').removeClass('isOpen');

  });


 
;
