browse_query = null;
browse_token = null;
browse_limit = 10000;
browse_current_count = null;
browse_offset = 0;

function display_company(company_id) {
  $.get(
    '/company/' + company_id, null,
    function (response) {
      $('#company-container').html(response);
    }
  );
}

function update_listings() {
  var data = {
    "_token": browse_token,
    "offset": browse_offset
  };

  var query = browse_query;
  var limit = browse_limit;

  if (query !== null)
    data["query"] = query;

  if (limit !== null)
    data["limit"] = limit;

  $.get(
    '/company', data,
    function (response) {
      var digits = response['count'];
      var html = response['html'];
      browse_current_count = digits;
      $('#listings-count-digits').html(digits);
      $('#listings-list').html(html);
    }
  );
}

function adjust_offset(amount) {
  browse_offset += amount;

  browse_offset = Math.max(0, browse_offset);
  browse_offset = Math.min(browse_offset, browse_current_count);

  update_listings();
}

$(function() {
  $('#listings-arrows-up').click(function() {
    adjust_offset(-1);
  });

  $('#listings-arrows-down').click(function() {
    adjust_offset(1);
  });

  $('#search-banner-textbox-real input').keyup(function() {
    $(this).closest('form').submit();
  });

  $('#search-banner-textbox-real form').on('submit', function() {
    var form = $(this);
    browse_query = form.find('input[name=query]').val();
    browse_offset = 0;

    if (browse_query == "")
      browse_query = null;

    browse_token = form.find('input[name=_token]').val()

    update_listings();

    return false;
  });

  var form = $('#search-banner-textbox-real form');
  var token = form.find('input[name=_token]').val();
  update_listings(null, token);

  window.onload = function() {
        try {
          TagCanvas.Start('myCanvas', '', { weight: true, textFont: 'League Gothic', textColour: 'white' });
          TagCanvas.Start('myCanvas2', '', { weight: true, textFont: 'League Gothic', textColour: 'white' });
        } catch(e) {
                // something went wrong, hide the canvas container
                document.getElementById('myCanvasContainer').style.display = 'none';
        }
  };
});
