(function (){
	$('#selfestimated').on('ifChecked', function(event){
	    $(".estimationRef").hide();
	    $(".add-more_container, p.addmore").removeClass("hidden");
	}).on('ifUnchecked', function(event){
	    $(".estimationRef").show(); 
	    $(".add-more_container").addClass("add-more_container hidden");
	   	$("p.addmore").addClass("addmore hidden text-right");

	    //Remove all added element from dom
	    $(".add-more_container").nextAll('div.row').remove();
	});

	$(".addmore a").on("click", function(e){
	  e.preventDefault();
	  var elementToAdd = $(".add-more_container .row:first").html();
	  var newElement   = $('<div />', {"class": 'row'}).html(elementToAdd);
	  $(".add-more_container").after(newElement);
	});

})();