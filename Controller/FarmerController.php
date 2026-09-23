<?php

require_once __DIR__ . '/BaseController.php';

require_once __DIR__ . '/../Model/Farmer.php';
require_once __DIR__ . '/../Model/Crop.php';


class FarmerController extends BaseController
{
    private Farmer $farmerModel;
    private Crop $cropModel;


    public function __construct()
    {
        $this->farmerModel =
            new Farmer();

        $this->cropModel =
            new Crop();
    }


    // ==========================================
    // DASHBOARD
    // ==========================================

    public function dashboard(): void
    {
        $this->requireRole('farmer');


        $farmer =
            $this->farmerModel
                ->findByUserId(
                    $this->userId()
                );


        if (!$farmer) {

            $this->setMessage(
                'error',
                'Farmer profile not found.'
            );

            $this->redirect(
                'index.php?page=login'
            );
        }


        $crops =
            $this->cropModel
                ->getByFarmer(
                    $farmer['farmer_id']
                );


        $totalCrops =
            count($crops);

        $activeCrops = 0;
        $pendingCrops = 0;
        $totalQuantity = 0;


        foreach ($crops as $crop) {

            $totalQuantity +=
                (float)$crop['quantity'];


            if (
                strtolower(
                    $crop['status']
                )
                === 'active'
            ) {

                $activeCrops++;
            }


            if (
                strtolower(
                    $crop['status']
                )
                === 'pending'
            ) {

                $pendingCrops++;
            }
        }


        $this->view(
            'farmer/dashboard',
            [
                'farmer' =>
                    $farmer,

                'crops' =>
                    $crops,

                'totalCrops' =>
                    $totalCrops,

                'activeCrops' =>
                    $activeCrops,

                'pendingCrops' =>
                    $pendingCrops,

                'totalQuantity' =>
                    $totalQuantity
            ]
        );
    }


    // ==========================================
    // CROPS
    // ==========================================

    public function crops(): void
    {
        $this->requireRole('farmer');


        $farmer =
            $this->farmerModel
                ->findByUserId(
                    $this->userId()
                );


        $crops =
            $this->cropModel
                ->getByFarmer(
                    $farmer['farmer_id']
                );


        $this->view(
            'farmer/crops',
            [
                'farmer' =>
                    $farmer,

                'crops' =>
                    $crops
            ]
        );
    }


    // ==========================================
    // ADD CROP PAGE
    // ==========================================

    public function addCrop(): void
    {
        $this->requireRole('farmer');


        $this->view(
            'farmer/add_crop'
        );
    }


    // ==========================================
    // CREATE CROP
    // ==========================================

    public function createCrop(): void
    {
        $this->requireRole('farmer');


        $farmer =
            $this->farmerModel
                ->findByUserId(
                    $this->userId()
                );


        if (!$farmer) {

            $this->setMessage(
                'error',
                'Farmer profile not found.'
            );

            $this->redirect(
                'index.php?page=farmer-crops'
            );
        }


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

        $price =
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


        if (
            $cropName === ''
            ||
            $category === ''
            ||
            $price <= 0
            ||
            $quantity <= 0
        ) {

            $this->setMessage(
                'error',
                'Please provide valid crop information.'
            );

            $this->redirect(
                'index.php?page=farmer-add-crop'
            );
        }


        $created =
            $this->cropModel
                ->create(
                    $farmer['farmer_id'],
                    $cropName,
                    $category,
                    $description,
                    $price,
                    $quantity,
                    $unit
                );


        $this->setMessage(
            $created
                ? 'success'
                : 'error',
            $created
                ? 'Crop added successfully.'
                : 'Failed to add crop.'
        );


        $this->redirect(
            'index.php?page=farmer-crops'
        );
    }


    // ==========================================
    // EDIT CROP
    // ==========================================

    public function editCrop(): void
    {
        $this->requireRole('farmer');


        $cropId =
            (int)(
                $_GET['id'] ?? 0
            );


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
                'index.php?page=farmer-crops'
            );
        }


        $farmer =
            $this->farmerModel
                ->findByUserId(
                    $this->userId()
                );


        if (
            (int)$crop['farmer_id']
            !==
            (int)$farmer['farmer_id']
        ) {

            $this->redirect(
                'index.php?page=unauthorized'
            );
        }


        $this->view(
            'farmer/edit_crop',
            [
                'crop' =>
                    $crop
            ]
        );
    }


    // ==========================================
    // UPDATE CROP
    // ==========================================

    public function updateCrop(): void
    {
        $this->requireRole('farmer');


        $cropId =
            (int)(
                $_POST['crop_id'] ?? 0
            );


        $crop =
            $this->cropModel
                ->findById(
                    $cropId
                );


        if (!$crop) {

            $this->redirect(
                'index.php?page=farmer-crops'
            );
        }


        $farmer =
            $this->farmerModel
                ->findByUserId(
                    $this->userId()
                );


        if (
            (int)$crop['farmer_id']
            !==
            (int)$farmer['farmer_id']
        ) {

            $this->redirect(
                'index.php?page=unauthorized'
            );
        }


        $updated =
            $this->cropModel
                ->update(
                    $cropId,
                    trim(
                        $_POST['crop_name'] ?? ''
                    ),
                    trim(
                        $_POST['category'] ?? ''
                    ),
                    trim(
                        $_POST['description'] ?? ''
                    ),
                    (float)(
                        $_POST['price_per_kg']
                        ?? 0
                    ),
                    (float)(
                        $_POST['quantity']
                        ?? 0
                    ),
                    trim(
                        $_POST['unit'] ?? 'kg'
                    ),
                    trim(
                        $_POST['status'] ?? 'pending'
                    )
                );


        $this->setMessage(
            $updated
                ? 'success'
                : 'error',
            $updated
                ? 'Crop updated successfully.'
                : 'Failed to update crop.'
        );


        $this->redirect(
            'index.php?page=farmer-crops'
        );
    }


    // ==========================================
    // DELETE CROP
    // ==========================================

    public function deleteCrop(): void
    {
        $this->requireRole('farmer');


        $cropId =
            (int)(
                $_GET['id'] ?? 0
            );


        $crop =
            $this->cropModel
                ->findById(
                    $cropId
                );


        if (!$crop) {

            $this->redirect(
                'index.php?page=farmer-crops'
            );
        }


        $farmer =
            $this->farmerModel
                ->findByUserId(
                    $this->userId()
                );


        if (
            (int)$crop['farmer_id']
            !==
            (int)$farmer['farmer_id']
        ) {

            $this->redirect(
                'index.php?page=unauthorized'
            );
        }


        $deleted =
            $this->cropModel
                ->delete(
                    $cropId
                );


        $this->setMessage(
            $deleted
                ? 'success'
                : 'error',
            $deleted
                ? 'Crop deleted successfully.'
                : 'Failed to delete crop.'
        );


        $this->redirect(
            'index.php?page=farmer-crops'
        );
    }


    // ==========================================
    // INVENTORY
    // ==========================================

    public function inventory(): void
    {
        $this->requireRole('farmer');


        $farmer =
            $this->farmerModel
                ->findByUserId(
                    $this->userId()
                );


        $crops =
            $this->cropModel
                ->getByFarmer(
                    $farmer['farmer_id']
                );


        $this->view(
            'farmer/inventory',
            [
                'crops' =>
                    $crops
            ]
        );
    }


    // ==========================================
    // SELL
    // ==========================================

    public function sell(): void
    {
        $this->requireRole('farmer');


        $farmer =
            $this->farmerModel
                ->findByUserId(
                    $this->userId()
                );


        $crops =
            $this->cropModel
                ->getByFarmer(
                    $farmer['farmer_id']
                );


        $this->view(
            'farmer/sell',
            [
                'crops' =>
                    $crops
            ]
        );
    }


    // ==========================================
    // SALES
    // ==========================================

    public function sales(): void
    {
        $this->requireRole('farmer');


        /*
         * Sales Model can be added later
         * when farmer-sales schema is finalized.
         */

        $this->view(
            'farmer/sales',
            [
                'sales' => []
            ]
        );
    }


    // ==========================================
    // PROFILE
    // ==========================================

    public function profile(): void
    {
        $this->requireRole('farmer');


        $farmer =
            $this->farmerModel
                ->findByUserId(
                    $this->userId()
                );


        $this->view(
            'farmer/profile',
            [
                'farmer' =>
                    $farmer
            ]
        );
    }
}