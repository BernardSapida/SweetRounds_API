<?php
    require_once realpath(dirname(__FILE__) . "/../../../")."/model/Transaction.php";
    
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        //! Get the raw POST data
        $postData = file_get_contents('php://input');

        // Decode the JSON data into an associative array
        $data = json_decode($postData, true);

        // Process the data
        $transaction = new Transaction();

        // Get user list
        $transactions = $transaction::searchTransaction($data["keyword"]);

        // Send a response
        header('Content-Type: application/json');
        echo sendResponse(true, 'Successfully retrieve user transactions!', $transactions);
    }

    function sendResponse($success, $message, $data = null) {
        header('Content-Type: application/json');
        $response = array('success' => $success, 'message' => $message, 'data' => $data);
        return json_encode($response);
    }
?>