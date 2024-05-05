<?php

// Token in DB = bearer + user + salt md5

$error_log = "../../endpoint_logs/auth_error.log";

$success_log = "../../endpoint_logs/auth_success.log";

include('../../salt.php');

include('../wp-load.php');

/**
 * Handle API errors, notify the user, and write a log
 *
 * @param string $errorMessage The error message to display to the user
 * @param string $logMessage The error message to write to the log
 */
function handleApiError($errorMessage, $logMessage, $logFile) {
    // Send a notification to the user (you can customize this part based on your application's requirements)
    echo "An error occurred: $errorMessage. Please try again.";

    // Write the error message to the log file
    $logEntry = date('Y-m-d H:i:s') . ' - ' . $logMessage . PHP_EOL;
    file_put_contents($logFile, $logEntry, FILE_APPEND);
}

/**
 * Retrieve HTTP headers from the $_SERVER
 *
 * This function iterates through the $_SERVER array to retrieve
 * all HTTP headers and returns them in an associative array format.
 *
 * @return array Associative array containing all HTTP headers
 */
function obtainHeaders() {

    $headers = [];

    // Iterate through each key-value pair in the $_SERVER array
    foreach ($_SERVER as $name => $value) {

        if (substr($name, 0, 5) === 'HTTP_') {

            // Format the header name properly (e.g., 'Content-Type' instead of 'HTTP_CONTENT_TYPE')
            $name = str_replace(' ', '-', ucwords(strtolower(str_replace('_', ' ', substr($name, 5)))));

            $headers[$name] = $value;
        }
    }

    return $headers;
}

/**
 * Sanitise HTTP header value
 *
 * @param string $headerValue The value of the HTTP header
 * @return string The sanitised header value
 */
function sanitiseHeader($headerValue) {

    // Remove leading and trailing whitespace
    $headerValue = trim($headerValue);

    // Remove backslashes
    $headerValue = stripslashes($headerValue);

    // Convert special characters to HTML entities
    $headerValue = htmlspecialchars($headerValue, ENT_QUOTES | ENT_HTML5);

    return $headerValue;
}

if ($_SERVER['REQUEST_METHOD'] != 'GET') {

    handleApiError('Incorrect request method','incorrect request method used',$error_log);

    die();

}
    
$list_of_headers = obtainHeaders();

// var_dump($list_of_headers);

$bearer_token = $list_of_headers['Authorization'];
$sanitised_bearer = sanitiseHeader($bearer_token);
$trimmed_bearer = substr($sanitised_bearer, 7);

$user_header = $list_of_headers['User'];
$sanitised_user = sanitiseHeader($user_header);

$auth_string = md5("$trimmed_bearer$sanitised_user$salt_token");

$auth_query = $wpdb->prepare("SELECT * FROM xx_api_keys WHERE MD5(CONCAT(token, user, %s)) = '%s'", $salt_token, $auth_string);

$run_auth_check = $wpdb->get_results($auth_query);

if(empty($run_auth_check)){

    handleApiError('Unauthorised','unauthorised',$error_log);

    http_response_code(401);

    die();

} else {

    $logMessage = "Authorised";

    http_response_code(200);

    echo $logMessage;

    // Write the error message to the log file
    $logEntry = date('Y-m-d H:i:s') . ' - ' . $logMessage . PHP_EOL;
    file_put_contents($success_log, $logEntry, FILE_APPEND);

}

?>