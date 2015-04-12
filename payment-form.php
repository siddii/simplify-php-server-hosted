<?php
/*
 * Copyright (c) 2015, MasterCard International Incorporated
 * All rights reserved.
 *
 * Redistribution and use in source and binary forms, with or without modification, are
 * permitted provided that the following conditions are met:
 *
 * Redistributions of source code must retain the above copyright notice, this list of
 * conditions and the following disclaimer.
 * Redistributions in binary form must reproduce the above copyright notice, this list of
 * conditions and the following disclaimer in the documentation and/or other materials
 * provided with the distribution.
 * Neither the name of the MasterCard International Incorporated nor the names of its
 * contributors may be used to endorse or promote products derived from this software
 * without specific prior written permission.
 * THIS SOFTWARE IS PROVIDED BY THE COPYRIGHT HOLDERS AND CONTRIBUTORS "AS IS" AND ANY
 * EXPRESS OR IMPLIED WARRANTIES, INCLUDING, BUT NOT LIMITED TO, THE IMPLIED WARRANTIES
 * OF MERCHANTABILITY AND FITNESS FOR A PARTICULAR PURPOSE ARE DISCLAIMED. IN NO EVENT
 * SHALL THE COPYRIGHT HOLDER OR CONTRIBUTORS BE LIABLE FOR ANY DIRECT, INDIRECT,
 * INCIDENTAL, SPECIAL, EXEMPLARY, OR CONSEQUENTIAL DAMAGES (INCLUDING, BUT NOT LIMITED
 * TO, PROCUREMENT OF SUBSTITUTE GOODS OR SERVICES; LOSS OF USE, DATA, OR PROFITS;
 * OR BUSINESS INTERRUPTION) HOWEVER CAUSED AND ON ANY THEORY OF LIABILITY, WHETHER
 * IN CONTRACT, STRICT LIABILITY, OR TORT (INCLUDING NEGLIGENCE OR OTHERWISE) ARISING
 * IN ANY WAY OUT OF THE USE OF THIS SOFTWARE, EVEN IF ADVISED OF THE POSSIBILITY OF
 * SUCH DAMAGE.
 */
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8"/>
    <title>Simplify Commerce Getting Test Payment Form</title>
    <script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
    <script type="text/javascript" src="https://www.simplify.com/commerce/v1/simplify.js"></script>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap-theme.min.css">
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.2.0/js/bootstrap.min.js"></script>
    <script type="text/javascript">
        function simplifyResponseHandler(data) {
            var $paymentForm = $("#simplify-payment-form");
            $(".error").remove();
			$("#process-payment-btn").removeAttr("disabled");
            if (data.error) {
                if (data.error.code == "validation") {
                    var fieldErrors = data.error.fieldErrors,
                            fieldErrorsLength = fieldErrors.length,
                            errorList = "";
                    for (var i = 0; i < fieldErrorsLength; i++) {
                        errorList += "<div class='error'>Field: '" + fieldErrors[i].field +
                                "' is invalid - " + fieldErrors[i].message + "</div>";
                    }
                    $paymentForm.after(errorList);
                }
            } else {
                // The token contains id, last4, and card type
                var token = data["id"];
                console.log('#### token = ', token);
                var amount = $('#amount').val();
                console.log('##### Charging amount = ', amount);
				/*
                $.post("/charge.php", { simplifyToken: token, amount: amount}, function (data){
                    console.log('#### Success', data);
                });
                */
				var request = $.ajax({
					url: "/charge.php",
					type: "POST",
					data: { simplifyToken: token, amount: amount},
					dataType: "html"
				});

				request.done(function( msg ) {
					alert("Payment successfully processed!")
				});

				request.fail(function( jqXHR, textStatus ) {
					console.error('Payment processing failed = ', jqXHR, textStatus);
				});
            }
        }

		<?php
			$publicKey = getenv('SIMPLIFY_API_PUBLIC_KEY');
		?>
        $(document).ready(function () {
            $("#process-payment-btn").click(function () {
                // Disable the submit button
                $("#process-payment-btn").attr("disabled", "disabled");
                // Generate a card token & handle the response
                SimplifyCommerce.generateToken({
                    key: "<?echo $publicKey?>",
                    card: {
                        number: $("#cc-number").val(),
                        cvc: $("#cc-cvc").val(),
                        expMonth: $("#cc-exp-month").val(),
                        expYear: $("#cc-exp-year").val()
                    }
                }, simplifyResponseHandler);
            });
        });
    </script>
</head>
<body>
<div class="container">
    <h1>Run Payments using Simplify Commerce</h1>

    <form role="form" class="form-horizontal" id="simplify-payment-form">
        <div class="form-group">
            <label class="col-sm-2">Amount</label>
            <input id="amount"  class="form-control" type="text" maxlength="10" autocomplete="off" value="" autofocus
                   placeholder="Enter Amount"/>
        </div>
        <div class="form-group">
            <label>Credit Card Number: </label>
            <input id="cc-number" class="form-control" type="text" maxlength="20" autocomplete="off" value="5555555555554444"/>
        </div>
        <div class="form-group">
            <label>CVC: </label>
            <input id="cc-cvc" class="form-control" type="text" maxlength="4" autocomplete="off" value="123"/>
        </div>
        <div class="form-group">
            <label>Expiry Date: </label>
            <select class="form-control" id="cc-exp-month">
                <option value="01">Jan</option>
                <option value="02">Feb</option>
                <option value="03">Mar</option>
                <option value="04">Apr</option>
                <option value="05">May</option>
                <option value="06">Jun</option>
                <option value="07">Jul</option>
                <option value="08">Aug</option>
                <option value="09">Sep</option>
                <option value="10">Oct</option>
                <option value="11">Nov</option>
                <option value="12">Dec</option>
            </select>
            <select class="form-control" id="cc-exp-year">
                <option value="15">2015</option>
                <option value="16">2016</option>
                <option value="17">2017</option>
                <option value="18">2018</option>
                <option value="19">2019</option>
                <option value="20">2020</option>
                <option value="21">2021</option>
                <option value="22">2022</option>
            </select>
        </div>
        <button class="btn btn-primary" id="process-payment-btn" type="btn">Process Payment</button>
    </form>
</div>
</body>
</html>