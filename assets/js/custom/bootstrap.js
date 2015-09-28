$(function () {

	$("[data-toggle=tooltip]").tooltip();
	
	var actionUrl = "";
	$('#Modal').on('show.bs.modal', function (event) {
		var button = $(event.relatedTarget);
		var modal = $(this);
		
		modal.removeClass();
		modal.addClass('modal fade ' + button.data('class'));
		modal.find('.modal-title').text(button.data('title'));
		modal.find('.modal-body').text(button.data('body'));

		modal.find('.modal-footer button:last-child').text(button.data('button'));
		actionUrl = button.data('action');
	});

	$("#modal-submit").on('click', function(event){
		//@TODO AJAX request
		window.location = actionUrl;
	});
});
