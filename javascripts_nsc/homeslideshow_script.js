// JavaScript Document
$(document).ready(function() {
													 
$('#gallery_home').cycle({
	fx: 'fade',
	timeout: 5000,
	speed: 500,
	delay: -2000,
     pager: '#pager',
	 next: '#next',
	prev: '#prev',
pagerAnchorBuilder: buildCaptions
});
$('#playControl').toggle(
		function() {
			$('#gallery_home').cycle('pause');
			$(this).html('<img src=\"images_ck/slidepager_play.jpg\" />');
		},
		function() {
			$('#gallery_home').cycle('resume');
			$(this).html('<img src=\"images_ck/slidepager_pause.jpg\" />');
		});
});

function buildCaptions(i, elem){
caption = $(elem).find('img').attr('alt');

html = '<a href="#">' + caption + '</a>';
return html

}