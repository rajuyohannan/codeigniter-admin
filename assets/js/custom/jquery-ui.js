$(function () {

  /**
   * Sortable Jquery UI
   */
  
  	/* Fix for the table sorting */
	 var fixHelperModified = function(e, tr) {
	    var $originals = tr.children();
	    var $helper = tr.clone();
	    $helper.children().each(function(index)
	    {
	      $(this).width($originals.eq(index).width())
	    });
	    return $helper;
	};

	$("#sortable").sortable({
	    helper: fixHelperModified,
	    update: function( event, ui ) {
	    	console.log(ui);
	    }
	}).disableSelection();

});