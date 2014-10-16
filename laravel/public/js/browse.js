function update_listings(query, token) {
  var data = {
    "_token": token
  };

  if (query !== null)
    data["query"] = query;

  $.get(
    '/company', data,
    function (response) {
      var digits = response['count'];
      var html = response['html'];
      $('#listings-count-digits').html(digits);
      $('#listings-list').html(html);
    }
  );
}

$(function() {
  $('#search-banner-textbox-real input').keyup(function() {
    $(this).closest('form').submit();
  });
  $('#search-banner-textbox-real form').on('submit', function() {
    var form = $(this);
    var query = form.find('input[name=query]').val();

    if (query == "")
      query = null;

    update_listings(query, form.find('input[name=_token]').val());

    return false;
  });

  var form = $('#search-banner-textbox-real form');
  var token = form.find('input[name=_token]').val();
  update_listings(null, token);
});
