// Sidebar
var sidebar_id;
var sidebar_size = "-320px";

function is_sidebar() {
	var side;
	var width = window.innerWidth || document.documentElement.clientWidth || document.body.clientWidth;
	if(width > 767) {
		side = 'right';
	} else {
		side = 'left';
	}
	return side;
}

function ani_sidebar(div, type, val) {
	if(type == "left") {
		div.animate({ left : val }); 
	} else {
		div.animate({ right : val }); 
	}
}

function sidebar_mask(opt) {
	var mask = $("#nt_sidebar_mask");
	if(opt == 'show') {
		mask.show();
		$('html, body').css({'overflow': 'hidden', 'height': '100%'});
	} else {
		mask.hide();
		$('html, body').css({'overflow': '', 'height': ''});
	}
}

function sidebar_open(id) {

	var div = $("#nt_sidebar");
	var side = is_sidebar();
	var is_div = div.css(side);
	var is_size;
	var is_open;
	var is_show;

	if(id == sidebar_id) {
		if(is_div === sidebar_size) {
			is_show = false;
			ani_sidebar(div, side, '0px'); 
			if(side == "left") {
				sidebar_mask('show');
			} else {
				sidebar_mask('hide');
			}
		} else {
			is_show = false;
			ani_sidebar(div, side, sidebar_size); 
			sidebar_mask('hide');
		}
	} else {
		if(is_div === sidebar_size) {
			is_show = true;
			ani_sidebar(div, side, '0px'); 
		} else {
			is_show = true;
		}

		if(side == "left") {
			sidebar_mask('show');
		} else {
			sidebar_mask('hide');
		}
	}

	// Show
	if(is_show) {
		$('#nt_sidebar').scrollTop(0);
	}

	// Save id
	sidebar_id = id;

	return false;
}

$(document).ready(function () {

	$(document).on('click', '#nt_sidebar_menu .tree-toggle', function () {
		var selfVisible = $(this).parent().children('ul.tree').is(':visible');
		$.map($(this).parent().parent().children('li.me-li'), val => {
			if($(val).children('ul.tree').is(':visible')){ 
				$(val).children('ul.tree').toggle(200); 
			}
		  });
		  if(!selfVisible) {$(this).parent().children('ul.tree').toggle(200);}
	});

	// Sidebar Close
	$(document).on('click', '.sidebar-close', function () {
		var div = $("#nt_sidebar");
		var side = is_sidebar();
		ani_sidebar(div, side, sidebar_size); 
		sidebar_mask('hide');
		return false;
    });
	
// sidebar Login
function sidebar_login(f) {
	if (f.mb_id.value == '') {
		alert('???????????? ????????? ?????????.');
		f.mb_id.focus();
		return false;
	}
	if (f.mb_password.value == '') {
		alert('??????????????? ????????? ?????????.');
		f.mb_password.focus();
		return false;
	}
	return true;
}
	// Sidebar Change
	$(window).resize(function() {
		var side = is_sidebar(); 
		if(side == 'left') {
			side = 'right';
		} else {
			side = 'left';
		}
		if($("#nt_sidebar").css(side) != '') {
			$("#nt_sidebar").css(side, '');
			sidebar_mask('hide');
		}
	});

	// Top & Bottom Button
	$(window).scroll(function(){
		if ($(this).scrollTop() > 250) {			
			$('#nt_bottom').fadeIn();
			$('#nt_top').fadeOut();
		} else {
			$('#nt_bottom').fadeOut();
			$('#nt_top').fadeIn();
			
		}
	});

	$('#nt_bottom .go-top').on('click', function () {
		$('html, body').animate({ scrollTop: '0px' }, 500);
		return false;
	});

	$('#nt_top .go-bottom').on('click', function () {
		$('html, body').animate({ scrollTop: $(document).height()-$(window).height()}, 500);
		return false;
	});

});
