(function($) {

'use strict';
	
	// HEADER PROFILE DROPDOWN
	var $profileBox   = $('.profileMenu');
	var $profilemenu  = $('.profileLinks');

	$(document).on('click','.profileImage', function(){
		$profilemenu.toggle();
	});

	$(document).click(function(e) {
		if (!$profileBox.is(e.target) && $profileBox.has(e.target).length === 0) {
			$profilemenu.hide();
		} 
	});

// LEAVE MESSAGE
$(document).on('click', '.msgLink', function(e) {
    e.preventDefault();
	
	var $main = $(this).closest('.leaveMessage');
	var $span = $(this).find('span');
	
    if ($main.hasClass('active')) {
        $span.text('Leave a message');
        $main.removeClass('active');
    } else {
       	$span.text('Hide Message');
        $main.addClass('active');
		$main.find('form').trigger('reset');
        $main.find('.alert').remove();
    }
});


$(document).click(function(e) {
    if (!$('.msgLink').is(e.target) && $('.leaveMessage').has(e.target).length === 0) {
        $('.msgLink').find('span').html('Leave a message');
		$('.leaveMessage').removeClass('active');
        $('.leaveMessage').find('form').trigger('reset');
        $('.leaveMessage').find('.alert').remove();
    }
});
	
	
})(jQuery);