<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8"/>
    <title>Simplify Commerce Getting Started Form</title>
    <script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
    <script type="text/javascript" src="https://www.simplify.com/commerce/v1/simplify.js"></script>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap-theme.min.css">
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.2.0/js/bootstrap.min.js"></script>
    <script type="text/javascript">
		<?php
			$publicKey = getenv('SIMPLIFY_API_PUBLIC_KEY');
		?>
    </script>
</head>
<body>
<div class="container">
    <h1>Hosted Payments Sample Page</h1>

	<h2>Following is a paynow button, click on it to see the hosted payments modal form</h2>
	<script type="text/javascript"
			src="https://www.simplify.com/commerce/simplify.pay.js"></script>
	<button data-sc-key="<?echo $publicKey?>"
			data-name="Jasmine Green Tea"
			data-description="Smooth tea with a rich jasmine bouquet"
			data-reference="999"
			data-amount="3000"
			data-color="#12B830">
		Buy Some Happiness!
	</button>
</div>
</body>
</html>