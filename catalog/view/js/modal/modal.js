$(function() {
   //modal
    // disable scrolling
    $('body').bind('mousewheel touchmove', lockScroll);

    // enable scrolling
    $('body').unbind('mousewheel touchmove', lockScroll);

    // lock window scrolling
    function lockScroll(e) {
        e.preventDefault();
    }
    // $('body').bind('mousewheel touchmove', lockScroll);



    var overlayModal = $(".overlay--modal");
    //$('body').on('click','.btn-modal',function() {
    $(".btn-modal").click(function() {
        //console.log('click');
        var modalName = $(this).data("modal");
        // $(".parallax-mirror").css("opacity", "0");
        // overlayModal.addClass("active");
        // $("body").addClass("no-scroll");

        if ($(document).height() > $(window).height()) {
            var scrollTop = ($('html').scrollTop()) ? $('html').scrollTop() : $('body').scrollTop(); // Works for Chrome, Firefox, IE...
            $('html').addClass('no-scroll').css('top',-scrollTop);
            var pm =  $(".parallax-mirror:eq(1)").css("top");
            $(window).resize();
        }
        $("." + modalName + "").addClass("show").fadeIn(200);

        setTimeout(function() {
            modalFlex();
        }, 100);
        $(".modal-overlay").click(function() {
            // $("body").removeClass("no-scroll");
            // $(".parallax-mirror").css("opacity", "1");
            var scrollTop = parseInt($('html').css('top'));
            $('html').removeClass('no-scroll');
            $('html,body').scrollTop(-scrollTop);
            $(window).resize();
            // $('body').unbind('mousewheel touchmove', lockScroll);

            // $(".modal").removeClass("show");
            $(this).closest(".modal").removeClass("show");
            $(this).closest(".modal").fadeOut(200);
            // setTimeout(function() {
                // overlayModal.removeClass("active");
            // }, 300);
        });
        $(document).keydown(function(eventObject){
            if (eventObject.which == 27)
                $(".modal-close").click();
        });
    });
    $(".modal-close").click(function() {
        // $("body").removeClass("no-scroll");
        var scrollTop = parseInt($('html').css('top'));
        $('html').removeClass('no-scroll');
        $('html,body').scrollTop(-scrollTop);
        $(window).resize();
        $(this).closest(".modal").removeClass("show");
        $(this).closest(".modal").fadeOut(200);
        // setTimeout(function() {
        //     overlayModal.removeClass("active");
        // }, 300);
    });

    

    $(".btn-modalka").click(function() {
       $(".modal-call").fadeIn();
    });
    modalFlex();
    $(window).resize(function() {
        modalFlex();
    });

    function modalFlex () {
        if ( $(window).height() < $(".modal.show").find(".modal-body").height() + 30 ) {
            $(".modal.show").find(".body").css("align-items", "flex-start");
        }else{
            $(".modal.show").find(".body").removeAttr("style");
        }
    }

});

$(document).ready(function(){
    $(this).keydown(function(eventObject){
        if (eventObject.which == 27){
                $(".modal-close").click();
                //console.log('123');
            }
    });
});
