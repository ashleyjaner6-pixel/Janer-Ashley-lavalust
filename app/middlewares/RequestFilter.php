<?php
defined('PREVENT_DIRECT_ACCESS') OR exit('No direct script access allowed');

class RequestFilter {
    public function handle($next) {
        $method = $_SERVER['REQUEST_METHOD'] ?? 'GET';
        $uri = $_SERVER['REQUEST_URI'] ?? '/';

        if ($method !== 'GET') {
            http_response_code(405);
            echo '405 Method Not Allowed';
            return;
        }

        if (preg_match('/\.(php|env|ini|log|sql|bak)$/i', $uri)) {
            http_response_code(403);
            echo '403 Forbidden';
            return;
        }

        return $next();
    }
}
?>
