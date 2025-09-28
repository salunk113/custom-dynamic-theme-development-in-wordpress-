(function ($) {
    $(document).on('submit', 'form.hero__track', function (e) {
      e.preventDefault();
  
      var $form = $(this);
      var $input = $form.find('input[name="tracking"]');
      var value = ($input.val() || '').trim();
      var pattern = new RegExp(ParcelTrack.pattern);
  
      if (!pattern.test(value)) {
        showPopup(ParcelTrack.messages.invalid, true);
        $input.focus();
        return;
      }
  
      $.ajax({
        url: ParcelTrack.ajaxUrl,
        method: 'POST',
        dataType: 'json',
        data: {
          action: 'submit_parcel_tracking',
          nonce: ParcelTrack.nonce,
          tracking: value
        }
      })
      .done(function (res) {
        if (res && res.success) {
          showPopup(ParcelTrack.messages.success, false);
          // Optionally redirect afterwards or clear field:
          // window.location.href = $form.attr('action') + '?tracking=' + encodeURIComponent(value);
          $input.val('');
        } else {
          showPopup((res && res.data && res.data.message) || ParcelTrack.messages.error, true);
        }
      })
      .fail(function (xhr) {
        var msg = (xhr.responseJSON && xhr.responseJSON.data && xhr.responseJSON.data.message) || ParcelTrack.messages.error;
        showPopup(msg, true);
      });
    });
  
    // Minimal popup
    function showPopup(message, isError) {
      var id = 'parcel-track-popup';
      var $old = $('#' + id);
      if ($old.length) $old.remove();
  
      var $popup = $('<div/>', { id: id, class: 'parcel-track-popup' }).append(
        $('<div/>', { class: 'parcel-track-popup__box' + (isError ? ' is-error' : ' is-success') }).append(
          $('<p/>', { text: message }),
          $('<button/>', { type: 'button', text: 'OK', class: 'parcel-track-popup__close', 'aria-label': 'Close' })
        )
      );
      $('body').append($popup);
  
      $popup.on('click', '.parcel-track-popup__close', function(){ $popup.remove(); });
      // Close when clicking backdrop
      $popup.on('click', function(e){ if (e.target.id === id) $popup.remove(); });
    }
  })(jQuery);
  