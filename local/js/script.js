$(document).on('click', '.city_del', function(e) {
	e.preventDefault();
	
	if (confirm('Удалить?')) {
		var id = $(this).data('id');
		
		$.ajax({
			url: '/local/ajax/delete-city.php',
			type: 'POST',
			data: 'ID=' + id,
			success: function (data) {
				console.log(data);
				location.reload();
			},
			error: function (data) {
				console.log('Error: ', data);
			},
		});
	}
});