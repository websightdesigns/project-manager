$(document).ready(function() {

	// bootstrap popover
	$('a[rel=notifications]').popover({
		html: 'true',
		placement: 'bottom',
		trigger: 'click',
		content: function() {
			return $('#notifications').html();
		}
	});
	$('a[rel=popover]').popover({
		html: true,
		trigger: 'click'
	});
	$(':not(.popover)').on('click', function (e) {
		$('.popover-link').each(function () {
			//the 'is' for buttons that trigger popups
			//the 'has' for icons and other elements within a button that triggers a popup
			if (!$(this).is(e.target) && $(this).has(e.target).length === 0 && $('.popover').has(e.target).length === 0) {
				$(this).popover('hide');
				return;
			}
		});
	});

	// bootstrap alerts
	$("div.message").addClass("alert alert-success");
	$('.users div.alert').append('<button type="button" class="close" data-dismiss="alert">&times;</button>');

	// chosen
	$(".chosen").chosen();

	// show/hide add new project text input
	$("#TicketProjectId").on('change', function() {
		// console.log('this', $(this).val() );
		if($(this).val() == "0") {
			$('#TicketProjectTitleGroup').css('display', 'block');
		} else {
			$('#TicketProjectTitleGroup').css('display', 'none');
		}
	});

	// show/hide add new milestone text input
	$("#TicketMilestoneId").on('change', function() {
		// console.log('this', $(this).val() );
		if($(this).val() == "0") {
			$('#TicketMilestoneTitleGroup').css('display', 'block');
		} else {
			$('#TicketMilestoneTitleGroup').css('display', 'none');
		}
	});

	// projects list in sidebar
	var win = $(this); // this = window
	function collapseProjectsList(win){
		//console.log('win.width()', win.width());
		if(win.width() <= 991) {
			$('.projects-list .list-group-item-title').on('click.projects', function() {
				if($('.projects-list .list-group-item:not(.list-group-item-title)').is(':visible')) {
					// hide projects list
					$('.projects-list .list-group-item:not(.list-group-item-title)').css('display', 'none');
					$('.projects-list .list-group-item-title .fa').removeClass('fa-minus-square-o').addClass('fa-plus-square-o');
					$('.projects-list .list-group-item-title').css({
						'border-bottom-right-radius': '4px',
						'border-bottom-left-radius': '4px'
					});
				} else {
					// show projects list
					$('.projects-list .list-group-item:not(.list-group-item-title)').css('display', 'block');
					$('.projects-list .list-group-item-title .fa').removeClass('fa-plus-square-o').addClass('fa-minus-square-o');
					$('.projects-list .list-group-item-title').css({
						'border-bottom-right-radius': '0',
						'border-bottom-left-radius': '0'
					});
				}
				//console.log('click', true);
			});
			$('.projects-list .list-group-item:not(.list-group-item-title)').css('display', 'none');
			$('.projects-list .list-group-item-title').css({
				'border-bottom-right-radius': '4px',
				'border-bottom-left-radius': '4px'
			});
			//console.log('collapse', true);
		} else {
			$('.projects-list .list-group-item-title').unbind("click.projects");
			$('.projects-list .list-group-item:not(.list-group-item-title)').css('display', 'block');
			$('.projects-list .list-group-item-title').css({
				'border-bottom-right-radius': '0',
				'border-bottom-left-radius': '0'
			});
			//console.log('collapse', false);
		}
	}
	collapseProjectsList(win);
	$(window).on('orientationchange resize', function() {
		collapseProjectsList(win);
	});

	// disable text selection
	$('.noselect').attr('unselectable','on')
	     .css({'-moz-user-select':'-moz-none',
	           '-moz-user-select':'none',
	           '-o-user-select':'none',
	           '-khtml-user-select':'none', /* you could also put this in a class */
	           '-webkit-user-select':'none',/* and add the CSS class here instead */
	           '-ms-user-select':'none',
	           'user-select':'none'
	     }).bind('selectstart', function(){ return false; });

	// show/hide the cake debug log
	$("table.cake-sql-log caption").on('click', function() {
		if($("table.cake-sql-log tbody").is(":visible")){
			$("table.cake-sql-log thead, table.cake-sql-log tbody").css('display', 'none');
		} else {
			$("table.cake-sql-log thead, table.cake-sql-log tbody").css('display', 'block');
		}
	});

});