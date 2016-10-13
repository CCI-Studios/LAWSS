(function($) {
	
  $(function () 
  { 
  	  var img = $('#block-imageblock-1 .block-image img').attr('src');
  	  $('#block-imageblock-1 .block-image img').remove();
  	  $('#block-imageblock-1').css('background-image','url('+img+')');

      $('#mobile-menu').click(function(){

        $('.region-navigation').slideToggle();

      });

      $('.file a').attr('target','_blank');
  });
	
})(jQuery);

