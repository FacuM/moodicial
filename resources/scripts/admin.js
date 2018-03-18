console.log("Are you human, potato or administrator? Run a SQL query by typing as follows: \n\n\nadmin('query', 'database password');\n\ni.e: \nadmin('SELECT * FROM moodicial_posts', 'admin');\n\nYou'll receive the response here.\n\nWanna ban someone? Type ban('ip', 'reason', 'database password');");

// Admin console function definition
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

// Ban system client function definition
function ban(ip, reason, password)
{
	$.ajax({
		url: 'ban.php',
		type: 'POST',
		data: {
			ip: ip,
			reason: reason,
			password: password
		},
		success: function(response)
		{
			console.log(response);
		}
	});
};
