// 高亮当前导航点
function slidenavHighlight($next){
	$('#slidenav span').removeClass('cur');
	var currentNum = $('#slideshow div').index($next);
	var $highlightNav = $('#slidenav span:first');
	for( i = 0; i <= currentNum; i++){
		if( i == currentNum )
			$highlightNav.addClass('cur');
		else
			$highlightNav = $highlightNav.next(); 
	}
}

// 默认幻灯播放
function slideSwitch() {
	var $current = $('#slideshow div.current');
	if ( $current.length == 0 ) $current = $('#slideshow div:last');
	var $next =  $current.next().length ? $current.next() : $('#slideshow div:first');
	$current.addClass('prev');
	$next.css({opacity: 0.0}).addClass('current').animate({opacity: 1.0}, 800, function() {
	$current.removeClass('current prev');
		});
	slidenavHighlight($next);
}

// 向左播放幻灯
function slideSwitchleft(){
	var $current = $('#slideshow div.current');
	if ( $current.length == 0 ) $current = $('#slideshow div:first');
	var $next = ( $current.prev().attr('class') != 'rightImg' ) ? $current.prev() : $('#slideshow div:last');
	$current.addClass('prev');
	$next.css({opacity: 0.0}).addClass('current').animate({opacity: 1.0}, 800, function() {
	$current.removeClass('current prev');
		});
	slidenavHighlight($next);
}

function slideSwitchto() {
	var $current = $('#slideshow div.current');
	if ( $current.length == 0 ) $current = $('#slideshow div:last');
	var $next =  $current.next().length ? $current.next() : $('#slideshow div:first');
	$current.addClass('prev');
	$next.css({opacity: 0.0}).addClass('current').animate({opacity: 1.0}, 0, function() {
	$current.removeClass('current prev');
		});
	slidenavHighlight($next);
}

function slideSwitchleftto(){
	var $current = $('#slideshow div.current');
	if ( $current.length == 0 ) $current = $('#slideshow div:first');
	var $next = ( $current.prev().attr('class') != 'rightImg' ) ? $current.prev() : $('#slideshow div:last');
	$current.addClass('prev');
	$next.css({opacity: 0.0}).addClass('current').animate({opacity: 1.0}, 0, function() {
	$current.removeClass('current prev');
		});
	slidenavHighlight($next);
}

function slideSwitchtowhat(slideindex){
	var $current = $('#slideshow div.current');
	var $slideNum = slideindex - $('#slideshow div').index($current);
	if( $slideNum < 0 ){
		for( i = 0; i < 0 - ($slideNum) ; i++ )
			setTimeout('slideSwitchleftto()',0);
	} else if( $slideNum > 0 ){
		for( i = 0; i < $slideNum; i++ )
			setTimeout('slideSwitchto()',0);
	}
}

$(function() {
	$('#slideshow div:first').addClass('current');
	$('#slideshow span').css('opacity','0.7');
	$('.current').css('opacity','1.0');
	
	// 设定时间为3秒
   autoSlide = setInterval( 'slideSwitch()', 3000 ); 

   // 鼠标悬停时停止换图
	$('#slideshow').mouseenter(function(){
		clearInterval(autoSlide)
	});
	$('#slideshow').mouseleave(function(){
		autoSlide = setInterval( 'slideSwitch()', 3000 );
	});

	// 换图
	$('a.leftImg').bind('click',function(){
		if( !($('.current').is(':animated')))
			slideSwitchleft();
		return false;
	});
	
	$('a.rightImg').bind('click',function(){
		if( !($('.current').is(':animated')))
			slideSwitch();
		return false;
	});

	// 导航
	var $imgNum = $('#slideshow div').length;
	for( i = 0; i < $imgNum; i++ ){
		$('.slidenavcon').append('<span>&#149;</span>');
	}
	$('.slidenavcon').width($imgNum * 15);
	$('#slidenav span:first').addClass('cur');	
	
	$('#slidenav span').bind('click',function(){
		clearInterval(autoSlide);
		var slideindex = $('#slidenav span').index(this);
		if( !($('.current').is(':animated')))	
			slideSwitchtowhat(slideindex);
		autoSlide = setInterval( 'slideSwitch()', 3000 );
		return false;
	});
 
});