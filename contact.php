<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

// Include PHPMailer
require 'PHPMailer/PHPMailer.php';
require 'PHPMailer/SMTP.php';
require 'PHPMailer/Exception.php';

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $userEmail = $_POST['recipient'] ?? '';
    $name = $_POST['name'] ?? '';
    $message = $_POST['message'] ?? '';

    // Validate email
    if (!filter_var($userEmail, FILTER_VALIDATE_EMAIL)) {
        echo "❌ Invalid email address.";
        exit;
    }

    // Optional: sanitize name and message
    $name = htmlspecialchars(trim($name));
    $message = nl2br(htmlspecialchars(trim($message)));

    $mail = new PHPMailer(true);

    try {
        // SMTP settings
        $mail->isSMTP();
        $mail->Host       = 'smtp.gmail.com';
        $mail->SMTPAuth   = true;
        $mail->Username   = 'bovaspraveen12@gmail.com';     // Replace with your Gmail
        $mail->Password   = 'srfrpjlnxuwcbxit';       // Use App Password
        $mail->SMTPSecure = 'tls';
        $mail->Port       = 587;

        // Fix for local environments
        $mail->SMTPOptions = [
            'ssl' => [
                'verify_peer' => false,
                'verify_peer_name' => false,
                'allow_self_signed' => true
            ]
        ];

        // Email setup
        $mail->setFrom('yourgmail@gmail.com', $name);          // shows user name
        $mail->addAddress('bovaspraveen12@gmail.com');              // to yourself
        $mail->addReplyTo($userEmail, $name);                  // reply goes to user

        $mail->isHTML(true);
        $mail->Subject = "New Contact Form Message from $name";
        $mail->Body    = "
            <h3>New Contact Form Submission</h3>
            <p><strong>Name:</strong> {$name}</p>
            <p><strong>Email:</strong> {$userEmail}</p>
            <p><strong>Message:</strong><br>{$message}</p>
        ";

        $mail->send();
        echo "<script>alert('✅ Message sent successfully!'); window.location.href='index.html';</script>";
    } catch (Exception $e) {
        echo "❌ Message could not be sent. Error: {$mail->ErrorInfo}";
    }
} else {
    echo "Please submit the form.";
}
?>
