(function (){
	$('#selfestimated').on('ifChecked', function(event){
	    $(".estimationRef").addClass('form-group estimationRef hidden');
	    $(".add-more_container, p.addmore").removeClass("hidden");
	}).on('ifUnchecked', function(event){
	    $(".estimationRef").removeClass('hidden'); 
	    $(".add-more_container").addClass("add-more_container hidden");
	   	$("p.addmore").addClass("addmore hidden text-right");

	    //Remove all added element from dom
	    $(".add-more_container").nextAll('div.row').remove();
	});

	$(".addmore a").on("click", function(e){
	  e.preventDefault();
	  // var elementToAdd = $(".add-more_container .row:first").html();
	  
	  // //Remove the values from html
	  // elementToAdd.replace(/value=\"([^+])\"/g, '');

	  var elementToAdd = '
          <div class="col-md-7">
            <div class="form-group  ">
              <input name="department[]" value="" class="form-control" placeholder="Tasks" maxlength="255" type="text">
            </div>
          </div>
          <div class="col-md-4 form-group ">
            <div class="input-group">
              <input name="effort[]" value="" class="form-control" placeholder="Estimated efforts" maxlength="255" type="text">
            <span class="input-group-addon">Hours</span> 
            </div>
          </div>
          <div class="col-md-1">
            <span class="remove-rows label label-danger"><i class="fa fa-trash"></i></span>
          </div>';
                  

	  var newElement   = $('<div />', {"class": 'row'}).html(elementToAdd);
	  $(".add-more_container").after(newElement);
	});


	$("#existingclient").on('ifChecked', function(event){
		$(".newClientBlock").addClass('newClientBlock hidden');
		$(".existingClientBlock").removeClass('hidden');
	}).on('ifUnchecked', function(event){
		$(".newClientBlock").removeClass('hidden');
		$(".existingClientBlock").addClass('existingClientBlock hidden');
	});

	$("#EstimationRefernce").on("change", function(){
		if ($(this).val() == 'self') {
			$(this).val('-1');
			$('#selfestimated').iCheck('check');
		}
	});

	$("#clientId").on("change", function(){
		if ($(this).val() == 'add-client') {
			$(this).val('-1');
			$('#existingclient').iCheck('uncheck');
		}
	});


	$(".panel-body").on('click', 'span.remove-rows', function(){
		$(this).parents('.row').remove();
	});


	var $technologySelect = $("#projectTech");
	$technologySelect.on("select2:select", function (e) { 
		var selId = e.params.data.id;
		var selTitle = e.params.data.text;

		if ($(".distribution-tech").hasClass('hidden')) {
			$(".distribution-tech").removeClass('hidden');
		}

		$(".row-" + selId).show();

	});
	$technologySelect.on("select2:unselect", function (e) { 
		var selId = e.params.data.id;
		var selTitle = e.params.data.text;
		var count = $("#projectTech :selected").length;

		if (count == 0) {
			$(".distribution-tech").addClass('distribution-tech hidden');
		}

		$(".row-" + selId).hide();

	});

})();