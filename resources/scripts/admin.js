function admin(query, password)
{
	$.ajax({
		url: 'admin.php',
		type: 'POST',
		data: {
			query: query,
			password: password
		},
		success: function(response)
		{
			console.log(response);
		}
	});
};