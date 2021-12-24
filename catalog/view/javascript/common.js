function getURLVar(key) {
	var value = [];
	var query = String(document.location).split('?');
	if (query[1]) {
		var part = query[1].split('&');
		for (i = 0; i < part.length; i++) {
			var data = part[i].split('=');

			if (data[0] && data[1]) {
				value[data[0]] = data[1];
			}
		}
		if (value[key]) {
			return value[key];
		} else {
			return '';
		}
	} else {             // Изменения для seo_url от Русской сборки OpenCart 2x
        var query = String(document.location.pathname).split('/');
        
        if (query[query.length - 2] == 'cart') value['route'] = 'checkout/cart';
        if (query[query.length - 2] == 'checkout') value['route'] = 'checkout/checkout';
       
        if (value[key]) {
            return value[key];
        } else {
            return '';
        }
    }
}

/* Agree to Terms */
$(document).delegate('.agree', 'click', function(e) {
	e.preventDefault();
	$('#modal-agree').remove();
	var element = this;
	$.ajax({
		url: $(element).attr('href'),
		type: 'get',
		dataType: 'html',
		success: function(data) {
			html  = '<div id="modal-agree" class="modal modal-form modal-cart">';
			html += '    <div class="body">';
			html += '      <div class="modal-overlay"></div>';
			html += '      <div class="modal-body">';
			html += '        <div class="modal-close" onclick="$(\'#modal-agree\').popup(\'hide\');"></div>';//
			html += '        <div class="modal__title">' + $(element).text() + '</div>';
			html += '        <div class="form">' + data + '</div>';
			html += '      </div>';
			html += '    </div>';
			html += '</div>';
			$('body').append(html);
			$('#modal-agree').modal('show');
		}
	});
});
