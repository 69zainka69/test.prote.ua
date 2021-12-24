$(document).ready(function() {
    let exclusionRoutes = ['/', '/ua/', '/ru/'];
    if(exclusionRoutes.indexOf(window.location.pathname) === -1) {
        let beInMenu = 0;
        const timerClose = false;
    $('.header__catalog').on('mouseenter', function() {
        if ($('html').hasClass('desktop')) {
          $("#menu-button").click();
        }
       
        
    });
    $('.header__catalog').on('mouseleave', function() {
        timerClose = setTimeout(() => {
            if(beInMenu === 0) {
                $("#menu-button").click();
            }
            clearTimeout(timerClose)
        }, 500);
});
    $('.general-menu__general-category').on('mouseenter', function(e) {
        beInMenu = 1;
    });
      $('#cssmenu').on('mouseleave', function() {
        beInMenu = 0;
          $("#menu-button").click();
      });
    }
  
    function bindclick(event) {
        $(".header__catalog").bind('click', function(e) {
            e.preventDefault();
            $("#menu-button").click();
        });
    }
  $.fn.menumaker = function(options) {
      var cssmenu = $(this),
          settings = $.extend({
              title: "Меню",
              format: "dropdown",
              sticky: false
          }, options);
      return this.each(function() {
          cssmenu.prepend('<div id="menu-button">' + settings.title + '</div>');
          $(this).find("#menu-button").on('click', function(e) {
              e.preventDefault();
              $(this).toggleClass('menu-opened');
              $(this).parent().toggleClass('opened');
              $(this).parent().parent().toggleClass('opened');
              var mainmenu = $(this).next('ul');
              if (mainmenu.hasClass('open')) {
                  mainmenu.hide().removeClass('open');
                  clk2 = false;
                  setTimeout(function() {
                      bindclick()
                  }, 100);
                  $('#cssmenu').find('.opens').removeClass('opens');
                  $('.action_box').css({
                      'opacity': 0,
                      'display': 'none'
                  });
              } else {
                  mainmenu.show().addClass('open');
                  $(".menu-catalog").unbind("click");
              }

          });
          multiTg = function() {
              cssmenu.find(".has-sub").prepend('<span class="submenu-button"></span>');
              cssmenu.find('.submenu-button + a').on('click', function() {
                  $(this).parent().parent().find('.submenu-opened').removeClass('submenu-opened');
                  $(this).prev().toggleClass('submenu-opened');
                  ul = $(this).next().find('ul').first();
                  if (ul.hasClass('open')) {
                      ul.removeClass('open').hide();
                  } else {
                      ul.addClass('open').show();
                  }
                  $(this).parent().parent().find('.opens').removeClass('opens');
                  div = $(this).next();
                  if (div.hasClass('opens')) {
                      div.removeClass('opens');
                  } else {
                      div.addClass('opens');
                  }
                  if ($('html').hasClass('desktop')) {
                      return true;
                  } else {
                      return false;
                  }
              });
          };
          if (settings.format === 'multitoggle') multiTg();
          else cssmenu.addClass('dropdown');

          if (settings.sticky === true) cssmenu.css('position', 'fixed');
          start_width = '';
          resizeFix = function() {
              if (start_width == $(window).width()) return;
              start_width = $(window).width();
              if ($(window).width() > 997 && $('body').hasClass('common-home')) {
                  cssmenu.find('ul').show();
              }
              if ($(window).width() <= 997 || !$('body').hasClass('common-home')) {
                  cssmenu.find('ul').hide().removeClass('open');
              }
          };
          resizeFix();
          return $(window).on('resize', resizeFix);
      });
  };
});

$(document).ready(function() {
  $("#cssmenu .m").menumaker({
      title: "Меню",
      format: "multitoggle"
  });

  $(".header__menu-icon").bind('click', function(e) {
      if ($(window).width() > 997 && $('body').hasClass('common-home')) return false;
      e.preventDefault();
      $("#menu-button").click();
      $(".header__menu-icon").unbind("click");
  });
  $("#cssmenu").on("mouseenter", function() {}).on('mouseleave', function() {
      $('#cssmenu').find('.hoverr').removeClass('hoverr');
      $('#cssmenu').find('.opens').removeClass('opens');
      $('.action_box').css({
          'opacity': 0,
          'display': 'none'
      });
  });
  $("#cssmenu li").on("mouseenter", function() {
      $(this).parent().find('.opens').removeClass('opens');
      div = $(this).find('div').first();
      div = $(this);
      if (div.hasClass('opens')) {
          div.removeClass('opens');
      } else {
          div.addClass('opens');
      }
      $(this).find('ul').css('display', 'block');
      width = 240;
      $("#cssmenu li:hover > div > ul").each(function() {
          w = $(this).width();
          width += w;
      });
      action_box_w = $(".action_box").width();
      delta_w = $("#cssmenu").width() - (width + action_box_w);
      if (delta_w < 0) {
          if ((delta_w * -1) > action_box_w / 2) {
              $(".action_box .item").hide();
          } else {
              $(".action_box .item:first").hide();
          }
      }
  }).on('mouseleave', function() {
      $(".action_box .item").show();
  });
});

$(function() {
  let darkLayer = $('.dark-layer'),
      headerMobile = $('.header-m'),
      headerMColoseBtn = $('.header-m__close'),
      lang = $('.header-m__lang'),
      catalog = $('.header-m__catalog'),
      loginModal = $('.login-modal'),
      generalMenu = $('.header-m__general-menu'),
      hamburgerBtn = $('.header-m__hamburger'),
      hamburgerTitle = $('.header-m__hamburger-title')
  logo = $('.header-m__logo'),
      loginFormBlock = $('.header-m__login-form'),
      loginForm = $('.header-m__content .login-form');
  loginFormModal = loginModal.find('.login-form');
  darkLayer.click(() => {
      if (loginModal.css('display') === 'flex') {
          loginModal.hide();
          darkLayer.css('z-index', 2);
      } else {
          headerMobile.hide();
          darkLayer.hide();
          hideCatalog();
      }
  });

  $('.top-panel__menu-icon').click(() => {
      headerMobile.show();
      darkLayer.show();
  });
  headerMColoseBtn.click(() => {
      headerMobile.hide();
      darkLayer.hide();
  });

  if ($(window).width() <= '720') {

      $('.m-menu__link--catalog').click((e) => {
          e.preventDefault();
          catalog.show();
          headerMColoseBtn.show();
          lang.hide();
          catalog.css('display', 'flex');
          generalMenu.hide();
          hamburgerBtn.css('display', 'flex');
          logo.hide();
          hamburgerTitle.show();
          loginFormBlock.hide();
      });

      $('.m-menu__link--signin').click((e) => {
          loginFormBlock.show();
          headerMColoseBtn.show();
          lang.hide();
          generalMenu.hide();
          hamburgerBtn.css('display', 'flex');
          hamburgerTitle.hide();
          loginForm.removeClass('login-form--hide');
          loginForm.css('position', 'inherit');
          loginFormBlock.css('padding', 0);
      });

      headerMColoseBtn.click(() => {
          hideCatalog();
          loginFormBlock.hide();
      });

      hamburgerBtn.click(() => {
          hideCatalog();
          loginFormBlock.hide();
      });

      function hideCatalog() {
          catalog.hide();
          headerMColoseBtn.hide();
          lang.show();
          generalMenu.show();
          hamburgerBtn.hide();
          logo.show();
      }
  }

  if ($(window).width() > '720') {

      $('.m-menu__link--signin').click((e) => {
          let loginModalClose = $('.login-modal__close');
          loginModal.css('display', 'flex');
          loginFormModal.removeClass('login-form--hide');
          loginFormModal.addClass('login-modal__center')
          darkLayer.css('z-index', 3);
          loginModalClose.click((e) => {
              loginModal.hide();
              darkLayer.css('z-index', 2);
          });
      });
  }
})();