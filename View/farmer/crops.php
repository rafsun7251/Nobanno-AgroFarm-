<?php

$pageTitle = 'My Crops';

$extraCss = [
    'public/css/farmer.css'
];

require __DIR__ . '/../layouts/header.php';

?>

<main class="dashboard-page">

    <div class="page-container">


        <div class="page-header">

            <div>

                <h1>
                    My Crops
                </h1>

                <p>
                    Manage all your products.
                </p>

            </div>


            <a
                href="index.php?page=farmer-add-crop"
                class="btn btn-primary"
            >
                + Add Crop
            </a>

        </div>


        <div class="table-container">

            <table>

                <thead>

                    <tr>

                        <th>
                            Name
                        </th>

                        <th>
                            Category
                        </th>

                        <th>
                            Price
                        </th>

                        <th>
                            Quantity
                        </th>

                        <th>
                            Status
                        </th>

                        <th>
                            Actions
                        </th>

                    </tr>

                </thead>


                <tbody>

                    <?php if (
                        empty($crops)
                    ): ?>

                        <tr>

                            <td
                                colspan="6"
                                class="text-center"
                            >
                                No crops added yet.
                            </td>

                        </tr>


                    <?php else: ?>


                        <?php foreach (
                            $crops
                            as $crop
                        ): ?>

                            <tr>

                                <td>

                                    <?= htmlspecialchars(
                                        $crop[
                                            'crop_name'
                                        ]
                                    ) ?>

                                </td>


                                <td>

                                    <?= htmlspecialchars(
                                        $crop[
                                            'category'
                                        ]
                                    ) ?>

                                </td>


                                <td>

                                    ৳<?= number_format(
                                        (float)$crop[
                                            'price_per_kg'
                                        ],
                                        2
                                    ) ?>

                                </td>


                                <td>

                                    <?= number_format(
                                        (float)$crop[
                                            'quantity'
                                        ],
                                        2
                                    ) ?>

                                    <?= htmlspecialchars(
                                        $crop[
                                            'unit'
                                        ]
                                        ?? 'kg'
                                    ) ?>

                                </td>


                                <td>

                                    <span
                                        class="status-badge"
                                    >

                                        <?= htmlspecialchars(
                                            $crop[
                                                'status'
                                            ]
                                        ) ?>

                                    </span>

                                </td>


                                <td>

                                    <a
                                        href="index.php?page=farmer-edit-crop&id=<?= (int)$crop['crop_id'] ?>"
                                        class="btn btn-small"
                                    >
                                        Edit
                                    </a>


                                    <a 
                                         href="index.php?page=farmer-delete-crop&id=<?= (int)$crop['crop_id'] ?>"
                                        class="btn btn-small btn-danger delete-crop-btn"
                                         data-delete-url="index.php?page=farmer-delete-crop&id=<?= (int)$crop['crop_id'] ?>"
                                         data-crop-name="<?= htmlspecialchars($crop['crop_name']) ?>"
                                    >
                                        Delete
                                    </a>

                                </td>

                            </tr>

                        <?php endforeach; ?>

                    <?php endif; ?>

                </tbody>

            </table>

        </div>

    </div>

</main>
<!-- Delete Confirmation Modal -->

<div 
    id="deleteModal" 
    class="delete-modal"
    hidden
>

    <div class="delete-modal-overlay"></div>

    <div class="delete-modal-content">

        <div class="delete-modal-icon">
            !
        </div>

        <h2>
            Delete Crop?
        </h2>

        <p>
            Are you sure you want to delete
            <strong id="deleteCropName"></strong>?
        </p>

        <p class="delete-warning">
            This action cannot be undone.
        </p>

        <div class="delete-modal-actions">

            <button 
                type="button"
                id="cancelDelete"
                class="btn btn-secondary"
            >
                Cancel
            </button>

            <button 
                type="button"
                id="confirmDelete"
                class="btn btn-danger"
            >
                Delete
            </button>

        </div>

    </div>

</div>
<script 
    src="public/js/farmer.js" 
    defer
></script>
<?php
require __DIR__ . '/../layouts/footer.php';
?>