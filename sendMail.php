<?php

$response_message = "";

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    // Get form data
    $user_name  = $_POST["user"];
    $user_email = $_POST["email"];
    $phone      = $_POST["phone"];
    $select     = $_POST["select"];
    $message    = $_POST["message"];

    // Set recipient email address
    $to = "info@versai.tech";

    // Set email subject
    $subject = "New Form Submission from: " . $user_name;

    // Set email body/content
    $body = "Name: $user_name\n";
    $body .= "Email: $user_email\n";
    $body .= "Phone: $phone\n";
    $body .= "Type: $select\n";
    $body .= "Message:\n$message";

    // Set email headers (From and Reply-To)
    $headers = "From: $user_email\r\n";
    $headers .= "Reply-To: $user_email\r\n";

    // Use PHP's mail() function to send the email
    if (mail($to, $subject, $body, $headers)) {
        $response_message = "Thank you for contacting us! We'll get back to you soon.";
    } else {
        $response_message = "Failed to send email. Please try again later.";
    }
}

?>

<html>
<head>
    <title>Form Response</title>
    <script type="text/javascript">
        // Function to show alert and then redirect
        function showAlertAndRedirect(message) {
            alert(message);
            window.location.href = 'https://versai.tech/';
        }
    </script>
</head>
<body>

<?php if ($response_message != ""): ?>
    <script type="text/javascript">
        // Call the function with the PHP response message
        showAlertAndRedirect("<?php echo $response_message; ?>");
    </script>
<?php endif; ?>

</body>
</html>
