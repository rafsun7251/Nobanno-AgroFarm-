<?php

session_start();

/*
|--------------------------------------------------------------------------
| Error Reporting
|--------------------------------------------------------------------------
*/

error_reporting(E_ALL);
ini_set('display_errors', 1);


/*
|--------------------------------------------------------------------------
| Base Path
|--------------------------------------------------------------------------
*/

define('BASE_PATH', __DIR__);


/*
|--------------------------------------------------------------------------
| Autoload Classes
|--------------------------------------------------------------------------
*/

spl_autoload_register(function ($className) {

    $folders = [
        'Model',
        'Controller'
    ];

    foreach ($folders as $folder) {

        $file = BASE_PATH
            . DIRECTORY_SEPARATOR
            . $folder
            . DIRECTORY_SEPARATOR
            . $className
            . '.php';

        if (file_exists($file)) {

            require_once $file;

            return;
        }
    }
});


/*
|--------------------------------------------------------------------------
| Get Requested Page
|--------------------------------------------------------------------------
*/

$page = $_GET['page'] ?? 'home';


/*
|--------------------------------------------------------------------------
| Router
|--------------------------------------------------------------------------
*/

switch ($page) {

    /*
    |--------------------------------------------------------------------------
    | Home
    |--------------------------------------------------------------------------
    */

    case 'home':

        require_once BASE_PATH
            . '/Controller/HomeController.php';

        $controller =
            new HomeController();

        $controller->index();

        break;

        /*
    |--------------------------------------------------------------------------
    | Crop-Seaerch 
    |--------------------------------------------------------------------------
    */
    case 'crop-search':

    require_once BASE_PATH . '/Controller/CropController.php';

    $controller = new CropController();

    $controller->search();

    break;
    /*
    |--------------------------------------------------------------------------
    | Authentication
    |--------------------------------------------------------------------------
    */

    case 'login':

        require_once BASE_PATH
            . '/Controller/AuthController.php';

        $controller =
            new AuthController();

        $controller->login();

        break;


    case 'login-process':

        require_once BASE_PATH
            . '/Controller/AuthController.php';

        $controller =
            new AuthController();

        $controller->authenticate();

        break;


    case 'register':

        require_once BASE_PATH
            . '/Controller/AuthController.php';

        $controller =
            new AuthController();

        $controller->register();

        break;


    case 'register-process':

        require_once BASE_PATH
            . '/Controller/AuthController.php';

        $controller =
            new AuthController();

        $controller->createAccount();

        break;


    case 'farmer-register':

        require_once BASE_PATH
            . '/Controller/AuthController.php';

        $controller =
            new AuthController();

        $controller->farmerRegister();

        break;


    case 'farmer-register-process':

        require_once BASE_PATH
            . '/Controller/AuthController.php';

        $controller =
            new AuthController();

        $controller->createFarmer();

        break;


    case 'logout':

        require_once BASE_PATH
            . '/Controller/AuthController.php';

        $controller =
            new AuthController();

        $controller->logout();

        break;


    /*
    |--------------------------------------------------------------------------
    | Crops
    |--------------------------------------------------------------------------
    */

    case 'crops':

        require_once BASE_PATH
            . '/Controller/CropController.php';

        $controller =
            new CropController();

        $controller->index();

        break;


    case 'product-details':

        require_once BASE_PATH
            . '/Controller/CropController.php';

        $controller =
            new CropController();

        $controller->details();

        break;


    /*
    |--------------------------------------------------------------------------
    | Customer
    |--------------------------------------------------------------------------
    */

    case 'customer-dashboard':

        require_once BASE_PATH
            . '/Controller/CustomerController.php';

        $controller =
            new CustomerController();

        $controller->dashboard();

        break;


    case 'customer-profile':

        require_once BASE_PATH
            . '/Controller/CustomerController.php';

        $controller =
            new CustomerController();

        $controller->profile();

        break;


    case 'customer-orders':

        require_once BASE_PATH
            . '/Controller/OrderController.php';

        $controller =
            new OrderController();

        $controller->customerOrders();

        break;


    case 'customer-order-details':

        require_once BASE_PATH
            . '/Controller/OrderController.php';

        $controller =
            new OrderController();

        $controller->customerOrderDetails();

        break;


    /*
    |--------------------------------------------------------------------------
    | Cart
    |--------------------------------------------------------------------------
    */

    case 'cart':

        require_once BASE_PATH
            . '/Controller/CartController.php';

        $controller =
            new CartController();

        $controller->index();

        break;


    case 'cart-add':

        require_once BASE_PATH
            . '/Controller/CartController.php';

        $controller =
            new CartController();

        $controller->add();

        break;


    case 'cart-update':

        require_once BASE_PATH
            . '/Controller/CartController.php';

        $controller =
            new CartController();

        $controller->update();

        break;


    case 'cart-remove':

        require_once BASE_PATH
            . '/Controller/CartController.php';

        $controller =
            new CartController();

        $controller->remove();

        break;


    case 'cart-clear':

        require_once BASE_PATH
            . '/Controller/CartController.php';

        $controller =
            new CartController();

        $controller->clear();

        break;


    /*
    |--------------------------------------------------------------------------
    | Checkout / Orders
    |--------------------------------------------------------------------------
    */

    case 'checkout':

        require_once BASE_PATH
            . '/Controller/OrderController.php';

        $controller =
            new OrderController();

        $controller->checkout();

        break;


    case 'create-order':

        require_once BASE_PATH
            . '/Controller/OrderController.php';

        $controller =
            new OrderController();

        $controller->create();

        break;


    /*
    |--------------------------------------------------------------------------
    | Farmer
    |--------------------------------------------------------------------------
    */

    case 'farmer-dashboard':

        require_once BASE_PATH
            . '/Controller/FarmerController.php';

        $controller =
            new FarmerController();

        $controller->dashboard();

        break;


    case 'farmer-crops':

        require_once BASE_PATH
            . '/Controller/FarmerController.php';

        $controller =
            new FarmerController();

        $controller->crops();

        break;


    case 'farmer-add-crop':

        require_once BASE_PATH
            . '/Controller/FarmerController.php';

        $controller =
            new FarmerController();

        $controller->addCrop();

        break;


    case 'farmer-create-crop':

        require_once BASE_PATH
            . '/Controller/FarmerController.php';

        $controller =
            new FarmerController();

        $controller->createCrop();

        break;


    case 'farmer-edit-crop':

        require_once BASE_PATH
            . '/Controller/FarmerController.php';

        $controller =
            new FarmerController();

        $controller->editCrop();

        break;


    case 'farmer-update-crop':

        require_once BASE_PATH
            . '/Controller/FarmerController.php';

        $controller =
            new FarmerController();

        $controller->updateCrop();

        break;


    case 'farmer-delete-crop':

        require_once BASE_PATH
            . '/Controller/FarmerController.php';

        $controller =
            new FarmerController();

        $controller->deleteCrop();

        break;


    /*
    |--------------------------------------------------------------------------
    | Admin
    |--------------------------------------------------------------------------
    */

    case 'admin-dashboard':

        require_once BASE_PATH
            . '/Controller/AdminController.php';

        $controller =
            new AdminController();

        $controller->dashboard();

        break;


    case 'admin-users':

        require_once BASE_PATH
            . '/Controller/AdminController.php';

        $controller =
            new AdminController();

        $controller->users();

        break;


    case 'admin-delete-user':

        require_once BASE_PATH
            . '/Controller/AdminController.php';

        $controller =
            new AdminController();

        $controller->deleteUser();

        break;


    case 'admin-farmers':

        require_once BASE_PATH
            . '/Controller/AdminController.php';

        $controller =
            new AdminController();

        $controller->farmers();

        break;


    case 'admin-customers':

        require_once BASE_PATH
            . '/Controller/AdminController.php';

        $controller =
            new AdminController();

        $controller->customers();

        break;


    case 'admin-delivery-men':

        require_once BASE_PATH
            . '/Controller/AdminController.php';

        $controller =
            new AdminController();

        $controller->deliveryMen();

        break;


    case 'admin-crops':

        require_once BASE_PATH
            . '/Controller/AdminController.php';

        $controller =
            new AdminController();

        $controller->crops();

        break;


    case 'admin-orders':

        require_once BASE_PATH
            . '/Controller/AdminController.php';

        $controller =
            new AdminController();

        $controller->orders();

        break;


    case 'admin-payments':

        require_once BASE_PATH
            . '/Controller/AdminController.php';

        $controller =
            new AdminController();

        $controller->payments();

        break;


    case 'admin-deliveries':

        require_once BASE_PATH
            . '/Controller/AdminController.php';

        $controller =
            new AdminController();

        $controller->deliveries();

        break;


    /*
    |--------------------------------------------------------------------------
    | Delivery Man
    |--------------------------------------------------------------------------
    */

    case 'delivery-dashboard':

        require_once BASE_PATH
            . '/Controller/DeliveryController.php';

        $controller =
            new DeliveryController();

        $controller->dashboard();

        break;


    case 'delivery-pending':

        require_once BASE_PATH
            . '/Controller/DeliveryController.php';

        $controller =
            new DeliveryController();

        $controller->pending();

        break;


    case 'delivery-history':

        require_once BASE_PATH
            . '/Controller/DeliveryController.php';

        $controller =
            new DeliveryController();

        $controller->history();

        break;


    case 'delivery-edit':

        require_once BASE_PATH
            . '/Controller/DeliveryController.php';

        $controller =
            new DeliveryController();

        $controller->edit();

        break;


    case 'delivery-update':

        require_once BASE_PATH
            . '/Controller/DeliveryController.php';

        $controller =
            new DeliveryController();

        $controller->update();

        break;
// Add crop 
     case 'farmer-add-crop':

    require_once
        BASE_PATH . '/Controller/CropController.php';

    $controller =
        new CropController();

    $controller->addCrop();

    break;
//Store crop 
        
    case 'farmer-create-crop':

    require_once
        BASE_PATH . '/Controller/CropController.php';

    $controller =
        new CropController();

    $controller->storeCrop();

    break;
    /*
    |--------------------------------------------------------------------------
    | Errors
    |--------------------------------------------------------------------------
    */

    case 'unauthorized':

        require BASE_PATH
            . '/View/errors/unauthorized.php';

        break;


    default:

        http_response_code(404);

        require BASE_PATH
            . '/View/errors/404.php';

        break;
}