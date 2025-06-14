<?php
function base64url_decode_custom(string $data): string {
    $remainder = strlen($data) % 4;
    if ($remainder) {
        $data .= str_repeat('=', 4 - $remainder);
    }
    return base64_decode(strtr($data, '-_', '+/'));
}

function verify_jwt(string $token, string $secret) {
    $parts = explode('.', $token);
    if (count($parts) !== 3) {
        return false;
    }
    list($header64, $payload64, $signature64) = $parts;
    $signature = base64url_decode_custom($signature64);
    $expected = hash_hmac('sha256', "$header64.$payload64", $secret, true);
    if (!hash_equals($expected, $signature)) {
        return false;
    }
    $payload = json_decode(base64url_decode_custom($payload64), true);
    if (!$payload) {
        return false;
    }
    if (isset($payload['exp']) && time() >= $payload['exp']) {
        return false;
    }
    return $payload;
}

function require_auth(): array {
    if (session_status() === PHP_SESSION_NONE) {
        session_start();
    }
    if (!isset($_SESSION['token'])) {
        header('Location: login.php');
        exit();
    }
    $payload = verify_jwt($_SESSION['token'], 'aslkdja98yhoihafpihf11asf124');
    if ($payload === false) {
        session_destroy();
        header('Location: login.php');
        exit();
    }
    return $payload;
}
?>
