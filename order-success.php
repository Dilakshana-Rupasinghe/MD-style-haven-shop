<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Order Success</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body,
        html {
            height: 100%;
        }
    </style>
</head>

<body class="d-flex align-items-center justify-content-center">
    <div class="container text-center">
        <div class="card shadow-lg p-4">
            <h1 class="text-success">🎉 Order Successful!</h1>
            <p class="mt-3">Thank you for your order! We have received your details.</p>
            <div class="d-flex justify-content-center">
                <button id="okay-btn" name="okaybtn" class="btn btn-primary mt-4 col-2">Okay</button>
            </div>
        </div>
    </div>

    <script>
        document.getElementById("okay-btn").addEventListener("click", function() {
            window.location.href = "index.php"; // Redirect to home page or desired page
        });
    </script>
</body>

</html>