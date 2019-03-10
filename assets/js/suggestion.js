$(function(){
	$('#from').on('input', function(){
		var q = $('#from').val();
		if(q.length<1){
			$('#from').parent().find('#from-parent').html('');
			return false;
		}
		$.ajax({
			url:'/hotel/assets/requests/suggestion.php',
			data:{q:q},
			method:'GET'
		}).done(function(data){
			console.log(data);
			var c = JSON.parse(data);
			$('#from').parent().find('#from-parent').html('');
			$.each(c, function(i){
				var city = c[i].city;
					$('#from').parent().find('#from-parent').append('<p>'+city+'</p>');

				clickListener();
			});
		});
	});

	function clickListener(){
		console.log('called');
		$('#from-parent p').click(function(){
			var t = $(this).html();
			$('#from').val(t);
			$('#from').parent().find('#from-parent').html('');
		});
	}
});