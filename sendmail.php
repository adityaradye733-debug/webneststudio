<?php
// Change these for security if you like
$to = 'adityaradye733@gmail.com';

header('Content-Type: application/json');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = isset($_POST['name']) ? strip_tags($_POST['name']) : '';
    $email = isset($_POST['email']) ? strip_tags($_POST['email']) : '';
    $type = isset($_POST['type']) ? strip_tags($_POST['type']) : '';
    $message = isset($_POST['message']) ? strip_tags($_POST['message']) : '';

    if (!$name || !$email || !$message) {
        echo json_encode(['status'=>'error', 'message'=>'Missing fields.']);
        exit;
    }
    
    $subject = "New Project Inquiry: {$type}";
    $body = "Name: $name\nEmail: $email\nProject Type: $type\nMessage:\n$message";

    $headers = "From: $name <$email>\r\n";
    $headers .= "Reply-To: $email\r\n";

    if (mail($to, $subject, $body, $headers)) {
        echo json_encode(['status'=>'success', 'message'=>'Message sent!']);
    } else {
        echo json_encode(['status'=>'error', 'message'=>'Mail sending failed.']);
    }
} else {
    echo json_encode(['status'=>'error', 'message'=>'Invalid request.']);
}
?>
