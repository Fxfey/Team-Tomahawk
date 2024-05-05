<?php

// Token in DB = bearer + user + salt md5

$error_log = "../../endpoint_logs/story_delete_error.log";

$success_log = "../../endpoint_logs/story_delete_success.log";

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

if ($_SERVER['REQUEST_METHOD'] != 'DELETE') {

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

    // Get the request body
    $request_body = file_get_contents('php://input');

    // Check if the request body is not empty
    if (!empty($request_body)) {


        $decoded_body = json_decode($request_body, true);

        // Check if decoding was successful
        if ($decoded_body !== null) {

            $body_whitelist = ['id'];

            $decoded_body_keys = array_keys($decoded_body);

            // Check if request is missing any fields
            foreach($body_whitelist as $whitelist_check){

                if(!in_array($whitelist_check, $decoded_body_keys)){

                    handleApiError($whitelist_check.' is missing','missing field',$error_log);

                    http_response_code(406);
                
                    die();
                }

            }


            foreach($decoded_body_keys AS $current_input){

                // Check if input field is in whitelist
                if(!in_array($current_input, $body_whitelist)){

                    handleApiError($current_input.' is not a valid field','invalid field used',$error_log);

                    http_response_code(406);
                
                    die();

                }

                // Check if request content is empty
                if(empty($decoded_body[$current_input])){

                    handleApiError($current_input.' is empty','empty field used',$error_log);

                    http_response_code(406);
                
                    die();

                }

            }

            
            // Convert into int
            $id = intval($decoded_body['id']);

            // Prepare the SQL Query
            $select_row = $wpdb->prepare(
                "SELECT * FROM xx_timeline_items WHERE id = %d",
                $id
            );

            // Insert the new timeline event
            $check_row_exists = $wpdb->get_results($select_row);

            if(empty($check_row_exists)){

                handleApiError('Row does not exist','row does not exist',$error_log);

                http_response_code(406);
            
                die();

            }

            // Prepare the SQL Query
            $query = $wpdb->prepare(
                "DELETE FROM xx_timeline_items WHERE id = '%s'",
                $id
            );

            // Insert the new timeline event
            $delete_story = $wpdb->query($query);

            if($delete_story != 1){

                handleApiError('DB Insert Error','DB insert error',$error_log);

                http_response_code(406);
            
                die();

            } else {

                $logMessage = "Timeline Event successfully deleted.";

                http_response_code(200);

                echo $logMessage;

                // Write the error message to the log file
                $logEntry = date('Y-m-d H:i:s') . ' - ' . $logMessage . PHP_EOL;
                file_put_contents($success_log, $logEntry, FILE_APPEND);

            }

        } else {

            handleApiError('Invalid JSON format','JSON invalid',$error_log);

            http_response_code(406);
        
            die();

        }
    } else {

        handleApiError('Empty request body','request body empty',$error_log);

        http_response_code(406);
    
        die();
    }



}

?>