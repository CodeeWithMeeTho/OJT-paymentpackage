<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Laravel</title>

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@200;600&display=swap" rel="stylesheet">

    <!-- Styles -->
    <style>
        html,
        body {
            background-color: #fff;
            color: #636b6f;
            font-family: 'Nunito', sans-serif;
            font-weight: 200;
            height: 100vh;
            margin: 0;
        }

        .full-height {
            height: 100vh;
        }

        .flex-center {
            align-items: center;
            display: flex;
            justify-content: center;
        }

        .position-ref {
            position: relative;
        }

        .top-right {
            position: absolute;
            right: 10px;
            top: 18px;
        }

        .content {
            text-align: center;
        }

        .title {
            font-size: 84px;
        }

        .links>a {
            color: #636b6f;
            padding: 0 25px;
            font-size: 13px;
            font-weight: 600;
            letter-spacing: .1rem;
            text-decoration: none;
            text-transform: uppercase;
        }

        .m-b-md {
            margin-bottom: 30px;
        }
    </style>
</head>

<body>
    <div class="container mt-5 text-center">
        <div id="paypal-button"></div>
        <script src="https://www.paypalobjects.com/api/checkout.js"></script>
        <script>
            paypal.Button.render({
                // Configure environment
                env: 'sandbox',
                client: {
                    sandbox: 'ASPmqCEsPkCZt5LAlF34IbhyS3Ptp4PpTDt0NUmU1jk8tUwa-jpGgGZyoaFxavnowDywOGDXUPD65f_v',
                    production: 'demo_production_client_id'
                },
                // Customize button (optional)
                locale: 'en_US',
                style: {
                    size: 'large',
                    color: 'gold',
                    shape: 'pill',
                },

                // Enable Pay Now checkout flow (optional)
                commit: true,

                // Set up a payment
                payment: function(data, actions) {
                    return actions.request.post('/api/payment')
                        .then(function(res) {
                          console.log(res);
                            return res.id;
                        });
                },
                // Execute the payment
                onAuthorize: function(data, actions) {
                 
                    return actions.request.post('/api/payment', {
                        paymentID: data.paymentID,
                        payerID: data.payerID,
                        process: "Success"
                    }).then(function(res) {
                       
                        // Show a confirmation message to the buyer
                        window.alert('Thank you for your purchase!');
                    });
                }
            }, '#paypal-button');
        </script>
    </div>
    <div class="flex-center position-ref full-height">
        <div class="content">
            <form action="/api/payment" method="POST">
                <label for="fname">Card Number:</label><br>
                <input type="text" name="cardNumber"><br>
                <label for="lname">Expiry month:</label><br>
                <input type="text" name="expiryMonth"><br>
                <label for="lname">Expiry year:</label><br>
                <input type="text" name="expiryYear"><br>
                <label for="lname">CVC:</label><br>
                <input type="text" name="cvc"><br>
                <label for="lname">Amount:</label><br>
                <input type="text" name="amount"><br>
                <label for="lname">Description:</label><br>
                <input type="text" name="description"><br><br>
                <input type="submit" value="Submit">
        </div>
    </div>
</body>

</html>