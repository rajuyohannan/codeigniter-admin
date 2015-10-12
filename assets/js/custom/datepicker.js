$(function () {
	
	var dates = [];

	for (var i = 0; i <= 7; i++) {
		var currentDate = new Date();
		currentDate.setDate(currentDate.getDate() + i);
		dates.push(currentDate);
	}
	
	//One Week from current date
	$('#datetimepicker-scheduled').datetimepicker({
		daysOfWeekDisabled: [0],
		format: 'MM/DD/YYYY HH:mm',
		enabledDates: dates,
	});

	//Future dates disabled
	$("#datetimepicker-received").datetimepicker({
		format: 'MM/DD/YYYY',
		maxDate: new Date(),
	});

	//20 years before current date
	$("#dob").datetimepicker({
		format: 'MM/DD/YYYY',
		maxDate: new Date(new Date().setYear(new Date().getFullYear() - 20)),
	});


});