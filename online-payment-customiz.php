<?php
session_start();
require_once 'vendor/autoload.php';

use Stripe\StripeClient;

// Initialize Stripe
$stripe = new StripeClient("sk_test_51QS0Z2Cep5g9cGsIBmZGyu0bNBn5vQd9Nxg0vfF6C1EmOeI5TE1BVFxwvrubwpxKdnNYCtv3NJB7pCYlR3VxH1Fn004fvwzud3");

// Retrieve session data
$itemDescription = isset($_SESSION['checkout_items']) ? $_SESSION['checkout_items'] : "No items selected";
$totalPrice = isset($_SESSION['checkout_total_price']) ? $_SESSION['checkout_total_price'] : 0;

try {
    // Create Stripe checkout session
    $checkout_session = $stripe->checkout->sessions->create([
        "success_url" => "http://localhost/project-payment-test-v1/order-success-cutomize.php",
        "cancel_url" => "http://localhost/Payments%20test/cancel.php",
        "mode" => "payment",
        "line_items" => [
            [
                "price_data" => [
                    "currency" => "LKR",
                    "product_data" => [
                        "name" => "Total Amount",
                        "description" => $itemDescription,
                    ],
                    "unit_amount" => $totalPrice,
                ],
                "quantity" => 1,
            ]
        ]
    ]);

    http_response_code(303);
    header("Location: " . $checkout_session->url);
} catch (\Stripe\Exception\ApiErrorException $e) {
    echo "Error: " . $e->getMessage();
}
?>
