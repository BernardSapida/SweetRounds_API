<?php
    require_once realpath(dirname(__FILE__) . "/../../../")."/utils/database.php";
    require_once realpath(dirname(__FILE__) . "/../../../")."/model/Product.php";
    
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        // !
        $postData = file_get_contents('php://input');
        $data = json_decode($postData, true);
        $product_id = $data['id'];

        $product = new Product();
        $current_product = $product->loadById($product_id);

        if($current_product) {
            // Process the data
            $current_product->setName($data["name"]);
            $current_product->setFlavor($data["flavor"]);
            $current_product->setPrice($data["price"]);
            $current_product->setQuantity($data["quantity"]);
            $current_product->setAvailability($data["availability"]);
            $current_product->save();

            // Send a response
            echo sendResponse(true, 'Successfully updated a product!');
        } else {
            // Send a response
            echo sendResponse(false, 'Invalid parameters!');
        }
    }

    function sendResponse($success, $message) {
        header('Content-Type: application/json');
        $response = array('success' => $success, 'message' => $message);
        return json_encode($response);
    }
?>