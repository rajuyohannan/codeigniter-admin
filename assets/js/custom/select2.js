$(function () {

    $("#skills").select2({
    	tags: true
    });

    $("#assignTo").select2({
      ajax: {
        url: baseurl + 'user/get',
        dataType: 'json',
        delay: 250,
        data: function (params) {
          return {
            q: params.term, 
          };
        },
        processResults: function (data, page) {
          return {
            results: data
          };
        },
        cache: true
      },
      escapeMarkup: function (markup) { return markup; }, 
      minimumInputLength: 1,
      templateResult: formatRepo, 
      templateSelection: formatRepoSelection 
    });

});


 function formatRepo (user) {
    if (user.loading) return user.text;

    var markup = '<div class="clearfix">' +
    '<div class="col-sm-1">' +
    '<img src="' + 'http://localhost/codeigniter-admin/assets/images/default-male.jpg' + '" style="max-width: 100%" />' +
    '</div>' +
    '<div clas="col-sm-11">' + user.name + '</div>' +
    '</div>';

    return markup;
  }

  function formatRepoSelection (user) {
    return user.name || user.text;
  }