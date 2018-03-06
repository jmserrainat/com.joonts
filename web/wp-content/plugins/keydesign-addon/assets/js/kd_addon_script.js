jQuery(document).ready(function($) {

  (function($, win) {
    $.fn.inViewport = function(cb) {
      return this.each(function(i, el) {
        function visPx() {
          var H = $(this).height(),
            r = el.getBoundingClientRect(),
            t = r.top,
            b = r.bottom;
          return cb.call(el, Math.max(0, t > 0 ? H - t : (b < H ? b : H)));
        }
        visPx();
        $(win).on("resize scroll", visPx);
      });
    };
  }(jQuery, window));




  $(".kd-animated, .portfolio-item, .play-video, .toggle-map").inViewport(function(px) {
    if (px) $(this).addClass("kd-animate");
  });



  /* ------------------------------------------------------------------------
    COUNTDOWN
   ------------------------------------------------------------------------*/
$('.countdown').each(function (index, value){
 var text_days = $(this).attr( "data-text-days" );
 var text_hours = $(this).attr( "data-text-hours" );
 var text_minutes = $(this).attr( "data-text-minutes" );
 var text_seconds = $(this).attr( "data-text-seconds" );

 var count_year = $(this).attr( "data-count-year" );
 var count_month = $(this).attr( "data-count-month" );
 var count_day = $(this).attr( "data-count-day" );
 var count_date = count_year + '/' + count_month + '/' + count_day;
  $(this).countdown(count_date, function(event) {
    $(this).html(
      event.strftime('<span class="CountdownContent">%D<span class="CountdownLabel">'+text_days+'</span></span><span class="CountdownSeparator">:</span><span class="CountdownContent">%H <span class="CountdownLabel">'+text_hours+'</span></span><span class="CountdownSeparator">:</span><span class="CountdownContent">%M <span class="CountdownLabel">'+text_minutes+'</span></span><span class="CountdownSeparator">:</span><span class="CountdownContent">%S <span class="CountdownLabel">'+text_seconds+'</span></span>')
    );
  });
});


  /* ------------------------------------------------------------------------
    COUNTDOWN
   ------------------------------------------------------------------------*/

  jQuery(".kd_pie_chart .kd_chart").each(function (index, value){
    jQuery(this).appear(function() {
      jQuery(this).easyPieChart({
      easing: "easeInQuad",
      barColor: "#000",
      trackColor: "#e5e5e5",
      animate: 2000,
      size: "160",
      lineCap: 'square',
      lineWidth: "2",
      scaleColor: false,
      onStep: function(from, to, percent) {
        jQuery(this.el).find(".pc_percent").text(Math.round(percent));
      }
      });
    });
    var chart = window.chart = jQuery("kd_pie_chart .kd_chart").data("easyPieChart");
  });

  /* ------------------------------------------------------------------------
    GOOGLE MAP
   ------------------------------------------------------------------------*/

  $('.contact-map-container .toggle-map').click(function() {
    $('.contact-map-container').toggleClass('full-map');
  });

  /* ------------------------------------------------------------------------
      AUTO PLAY YOUTUBE VIDEO ELEMENT
   ------------------------------------------------------------------------*/

  function autoPlayYouTubeModal() {
    var trigger = $("body").find('[data-toggle="modal"]');
      trigger.click(function() {
      var theModal = $(this).data("target");
      videoSRC = $(theModal + ' iframe').attr('src');
      videoSRCauto = videoSRC + "?autoplay=1";
      $(theModal + ' iframe').attr('src', videoSRCauto);
      $(theModal + ' button.close').click(function() {
        $(theModal + ' iframe').attr('src', videoSRC);
      });
      $('.modal').click(function() {
        $(theModal + ' iframe').attr('src', videoSRC);
      });
    });
  }
  autoPlayYouTubeModal();

  /* ------------------------------------------------------------------------
    BOOK PREVIEW ELEMENT
   ------------------------------------------------------------------------*/

  if ($(".bp-content").length) {
    setInterval(function(){
      var pos = $(".bp-content").scrollTop();
      $(".bp-content").scrollTop(pos + 1);
  }, 30)
  }

  /* ------------------------------------------------------------------------
    TABS ELEMENT
   ------------------------------------------------------------------------*/

  $('.features-tabs li.tab').appendTo('.features-tabs .tabs');
  // var tabsnumber = $('.tabs > li.tab').length;
  // $('.tabs li.tab').css('width',100/tabsnumber + '%');

  if ($(".features-tabs").length) {
    $('.features-tabs').easytabs({
      updateHash: false,
      animationSpeed: 'fast',
      transitionIn: 'fadeIn'
    });
  }

  /* ------------------------------------------------------------------------
    FEATURED CONTENT ELEMENT
   ------------------------------------------------------------------------*/
  $('.featured_content_child').on('mouseenter', function() {
    $('.featured_content_child').removeClass('active-elem');
    $(this).addClass('active-elem');
  });

  /* ------------------------------------------------------------------------
    APP GALLERY ELEMENT
   ------------------------------------------------------------------------*/

  if ($(".app-gallery .ag-slider").length) {
    $(".app-gallery .ag-slider").owlCarousel({
      navigation: false,
      pagination: true,
      autoPlay: false,
      items: 1,
    });
  }

});


jQuery(window).load(function() {

  /* ------------------------------------------------------------------------
  MASONRY GALLERY ELEMENT
 ------------------------------------------------------------------------*/

  if (jQuery('#mg-gallery').length > 0) {
      var container = document.querySelector('#mg-gallery');
      var msnry = new Masonry(container, {
          itemSelector: '.mg-single-img',
          columnWidth: '.mg-sizer',
          percentPosition: true,
          gutter: 5
      });
  }

  /* ------------------------------------------------------------------------
  ALERT BOX ELEMENT
 ------------------------------------------------------------------------*/

   jQuery('.kd-alertbox .ab-close').on('click', function(e) {
     e.preventDefault();
     jQuery(this).closest('.kd-alertbox').hide(200);
   });

  /* ------------------------------------------------------------------------
  COLOR SWITCH
 ------------------------------------------------------------------------*/

  if (jQuery(".slider.color-swtich").length) {
    jQuery(".slider.color-swtich").owlCarousel({
      navigation: false,
      pagination: true,
      responsive: false,
      autoPlay: 5000,
      transitionStyle : "fade",
      items: 1,
    });
    var elem_count = 0;
    jQuery('.color-swtich .color-swtich-content').each(function (index, value){
       var elem_color = ( jQuery(this).attr("data-color") );
       jQuery('.color-swtich .owl-controls .owl-page span').eq(elem_count++).css( "background", elem_color );
    });

}

});
