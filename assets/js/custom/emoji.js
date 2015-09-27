$(function () {
	$('.emoji-show').click(function(){
		var EmojiList = $(this).parents('.form-group').find('.emoji-list');
		if (EmojiList.is(":visible")) {
			EmojiList.addClass('hidden');
		}
		else {
			EmojiList.removeClass('hidden');
		}
	});
});