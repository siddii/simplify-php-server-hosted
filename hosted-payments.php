<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8"/>
    <title>Simplify Commerce Getting Started Form</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap.min.css">
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.2.0/js/bootstrap.min.js"></script>
    <script type="text/javascript">
		<?php
			$publicKey = getenv('SIMPLIFY_API_PUBLIC_KEY');
		?>
    </script>
</head>
<body>
<div class="container">
    <h3>Hosted Payments Sample Page</h3>
	<hr/>
	<h5>Following is a sample paynow button, click on it to see the hosted payments modal form in action...</h5>
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