<?php

require_once __DIR__ . '/BaseController.php';

require_once __DIR__ . '/../Model/Crop.php';
require_once __DIR__ . '/../Model/Farmer.php';


class CropController extends BaseController
{
    private Crop $cropModel;
    private Farmer $farmerModel;


    public function __construct()
    {
        $this->cropModel = new Crop();
        $this->farmerModel = new Farmer();
    }


    // ==========================================
    // PUBLIC CROP LIST
    // ==========================================

    public function index(): void
    {
        $crops =
            $this->cropModel
                ->getActive();


        $this->view(
            'home/crops',
            [
                'crops' =>
                    $crops
            ]
        );
    }


    // ==========================================
    // SEARCH
    // ==========================================

    public function search(): void
    {
        $keyword =
            trim(
                $_GET['search'] ?? ''
            );

        $category =
            trim(
                $_GET['category'] ?? ''
            );


        $crops =
            $this->cropModel
                ->search(
                    $keyword,
                    $category
                );


        $this->view(
            'home/crops',
            [
                'crops' =>
                    $crops,

                'keyword' =>
                    $keyword,

                'category' =>
                    $category
            ]
        );
    }

    // ==========================================
    // DETAILS
    // ==========================================

    public function details(): void
    {
        $cropId =
            (int)(
                $_GET['id'] ?? 0
            );


        if ($cropId <= 0) {

            $this->redirect(
                'index.php?page=crops'
            );
        }


        $crop =
            $this->cropModel
                ->findById(
                    $cropId
                );


        if (!$crop) {

            $this->setMessage(
                'error',
                'Crop not found.'
            );

            $this->redirect(
                'index.php?page=crops'
            );
        }


        $this->view(
            'home/product_details',
            [
                'crop' =>
                    $crop
            ]
        );
    }
    // ==========================================
// ADD CROP FORM
// ==========================================

public function addCrop(): void
{
    if (session_status() === PHP_SESSION_NONE) {
        session_start();
    }

    // Check login
    if (!isset($_SESSION['user_id'])) {

        $this->redirect(
            'index.php?page=login'
        );

        return;
    }


    // Check farmer role
    if (
        !isset($_SESSION['role']) ||
        $_SESSION['role'] !== 'farmer'
    ) {

        $this->redirect(
            'index.php'
        );

        return;
    }


    // Show form
    $this->view(
        'farmer/add_crop'
    );
}
// ==========================================
// STORE CROP
// ==========================================

public function storeCrop(): void
{
    if (session_status() === PHP_SESSION_NONE) {
        session_start();
    }


    // ==========================================
    // AUTH CHECK
    // ==========================================

    if (!isset($_SESSION['user_id'])) {

        $this->redirect(
            'index.php?page=login'
        );

        return;
    }


    if (
        !isset($_SESSION['role']) ||
        $_SESSION['role'] !== 'farmer'
    ) {

        $this->redirect(
            'index.php'
        );

        return;
    }


    // ==========================================
    // GET FARMER
    // ==========================================

    $userId =
        (int)$_SESSION['user_id'];


    $farmer =
        $this->farmerModel
            ->findByUserId($userId);


    if (!$farmer) {

        $this->setMessage(
            'error',
            'Farmer profile not found.'
        );

        $this->redirect(
            'index.php?page=farmer-dashboard'
        );

        return;
    }


    $farmerId =
        (int)$farmer['farmer_id'];


    // ==========================================
    // GET FORM DATA
    // ==========================================

    $cropName =
        trim(
            $_POST['crop_name'] ?? ''
        );


    $category =
        trim(
            $_POST['category'] ?? ''
        );


    $description =
        trim(
            $_POST['description'] ?? ''
        );


    $pricePerKg =
        (float)(
            $_POST['price_per_kg'] ?? 0
        );


    $quantity =
        (float)(
            $_POST['quantity'] ?? 0
        );


    $unit =
        trim(
            $_POST['unit'] ?? 'kg'
        );


    // ==========================================
    // VALIDATION
    // ==========================================

    if (
        $cropName === '' ||
        $category === '' ||
        $pricePerKg <= 0 ||
        $quantity <= 0
    ) {

        $this->setMessage(
            'error',
            'Please provide valid crop information.'
        );

        $this->redirect(
            'index.php?page=farmer-add-crop'
        );

        return;
    }


    // ==========================================
    // CREATE CROP
    // ==========================================

    $cropId =
        $this->cropModel->create(
            $farmerId,
            $cropName,
            $category,
            $description,
            $pricePerKg,
            $quantity,
            $unit,
            'available'
        );


    if ($cropId === false) {

        $this->setMessage(
            'error',
            'Failed to add crop.'
        );

        $this->redirect(
            'index.php?page=farmer-add-crop'
        );

        return;
    }


    // ==========================================
    // SUCCESS
    // ==========================================

    $this->setMessage(
        'success',
        'Crop added successfully.'
    );


    $this->redirect(
        'index.php?page=farmer-crops'
    );
}
}