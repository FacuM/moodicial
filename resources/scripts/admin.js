console.log("Are you human, potato or administrator? Run a SQL query by typing as follows: \n\n\nadmin('query', 'database password');\n\ni.e: \nadmin('SELECT * FROM moodicial_posts', 'admin');\n\nYou'll receive the response here.");
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
