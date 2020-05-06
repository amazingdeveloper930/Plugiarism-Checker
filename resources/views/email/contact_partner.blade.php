<!DOCTYPE html>
<html lang="en-US">
	<head>
		<meta charset="utf-8">
	</head>
	<body>
		<h2>Inquiry Details as follows: </h2>

		<div>

			<p>
				Company : {{ $company_name }}<br>
				Country : {{ $country }}<br>

				Email: {{ $email }}<br>
				Market: {{ $market }}<br>
				
				Message: 
				{{ $txt_message }}
				
			</p>
		</div>
	</body>
</html>