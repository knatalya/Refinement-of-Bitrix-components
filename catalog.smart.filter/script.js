$(document).ready(function () {
	$('.smart_filter form .fields .field').on('click', function (e) {
		//при клике на элемент внутри drop_down клик "поднимается", а нам здесь этого не нужно.
		var drop_down_selector = '.drop_down.active';
		if($(drop_down_selector).length && $(drop_down_selector)[0].contains(e.target))
			return true;
		//работаем
		$('.smart_filter form .fields .field').removeClass('active').find('.drop_down').not($(this).find('.drop_down')).removeClass('active');
		if(!$(this).find('.drop_down').hasClass('active'))
			$(this).addClass('active').find('.drop_down').addClass('active');
		else
			$(this).removeClass('active').find('.drop_down').removeClass('active');
	});
	$('.smart_filter form .fields .field .drop_down .checkboxes .value label input[type=checkbox]').on('change', function () {
		if(this.checked)
			$(this).closest('label').addClass('active');
		else
			$(this).closest('label').removeClass('active');
	});
	$('.smart_filter form .fields .field .drop_down .slider .slider_range').each(function (i, el) {
		var min = parseInt($(this).attr('data-min'));
		var max = parseInt($(this).attr('data-max'));
		$(el).slider({
			range: true,
			min: min,
			max: max,
			values: [min, max],
			slide: function (event, ui) {
				$(this).closest('.slider').find('input.min').val(ui.values[0]);
				$(this).closest('.slider').find('input.max').val(ui.values[1]);
			}
		});
	});
	$('.smart_filter form .fields .field .drop_down .slider input.min,' +
		'.smart_filter form .fields .field .drop_down .slider input.max').on('change', function () {
		var min = parseInt($(this).val());
		var max = parseInt($(this).next('input.max').val());
		$('.smart_filter form .fields .field .drop_down .slider .slider_range').slider("values", [min, max]);
	});
	$(document).on('click', function (e) {
		var drop_down_selector = '.drop_down.active';
		if($(drop_down_selector).length && !$('.smart_filter')[0].contains(e.target))
			$(drop_down_selector).removeClass('active').closest('.field').removeClass('active');
	})
});


document.querySelectorAll('.search_filter').forEach(element => {
	element.oninput = function(event) {
		let i = 0;
		let count = 0;
		document.querySelectorAll('.drop_down.active .checkboxes .value span').forEach(span => {
			if(span.innerText.toLowerCase().includes(event.target.value.toLowerCase())) {
				count++;
				document.querySelectorAll('.drop_down.active .checkboxes .value')[i].classList.remove('hide');
			} else {
				document.querySelectorAll('.drop_down.active .checkboxes .value')[i].classList.add('hide');
			}
			i++;
		});
		$('.search_container #count_number')[0].innerText = count;
	}
});