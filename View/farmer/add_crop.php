<?php

$pageTitle = 'Add Crop';

$extraCss = [
    'public/css/farmer.css'
];

require __DIR__ . '/../layouts/header.php';

?>

<main class="form-page">

    <div class="page-container">

        <div class="form-card">

            <div class="page-header">

                <h1>
                    Add New Crop
                </h1>

                <p>
                    Add your farm product
                    to the marketplace.
                </p>

            </div>


            <form
                action="index.php?page=farmer-create-crop"
                method="POST"
                class="main-form"
            >

                <div class="form-row">

                    <div class="form-group">

                        <label>
                            Crop Name
                        </label>

                        <input
                            type="text"
                            name="crop_name"
                            placeholder="e.g. Tomato"
                            required
                        >

                    </div>


                    <div class="form-group">

                        <label>
                            Category
                        </label>

                        <select
                            name="category"
                            required
                        >

                            <option value="">
                                Select Category
                            </option>

                            <option value="vegetable">
                                Vegetable
                            </option>

                            <option value="fruit">
                                Fruit
                            </option>

                            <option value="rice">
                                Rice
                            </option>

                            <option value="spice">
                                Spice
                            </option>

                        </select>

                    </div>

                </div>


                <div class="form-group">

                    <label>
                        Description
                    </label>

                    <textarea
                        name="description"
                        rows="5"
                        placeholder="Describe your product..."
                    ></textarea>

                </div>


                <div class="form-row">

                    <div class="form-group">

                        <label>
                            Price per KG
                        </label>

                        <input
                            type="number"
                            name="price_per_kg"
                            min="0"
                            step="0.01"
                            required
                        >

                    </div>


                    <div class="form-group">

                        <label>
                            Quantity
                        </label>

                        <input
                            type="number"
                            name="quantity"
                            min="0"
                            step="0.01"
                            required
                        >

                    </div>


                    <div class="form-group">

                        <label>
                            Unit
                        </label>

                        <select
                            name="unit"
                        >

                            <option value="kg">
                                KG
                            </option>

                            <option value="piece">
                                Piece
                            </option>

                        </select>

                    </div>

                </div>


                <div class="form-actions">

                    <a
                        href="index.php?page=farmer-crops"
                        class="btn btn-secondary"
                    >
                        Cancel
                    </a>


                    <button
                        type="submit"
                        class="btn btn-primary"
                    >
                        Add Crop
                    </button>

                </div>

            </form>

        </div>

    </div>

</main>


<?php
require __DIR__ . '/../layouts/footer.php';
?>