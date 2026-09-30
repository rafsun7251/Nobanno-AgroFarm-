<?php

$pageTitle = 'Edit Crop';

$extraCss = [
    'public/css/farmer.css'
];

require __DIR__ . '/../layouts/header.php';

?>

<main class="form-page">

    <div class="page-container">

        <div class="form-card">

            <div class="page-header">

                <div>

                    <h1>
                        Edit Crop
                    </h1>

                    <p>
                        Update your farm product information.
                    </p>

                </div>

            </div>


            <form
                action="index.php?page=farmer-update-crop"
                method="POST"
                class="main-form"
            >

                <!-- Crop ID -->

                <input
                    type="hidden"
                    name="crop_id"
                    value="<?= (int)$crop['crop_id'] ?>"
                >


                <!-- Crop Name + Category -->

                <div class="form-row">

                    <div class="form-group">

                        <label>
                            Crop Name
                        </label>

                        <input
                            type="text"
                            name="crop_name"
                            value="<?= htmlspecialchars(
                                $crop['crop_name']
                            ) ?>"
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

                            <option
                                value="vegetables"
                                <?= $crop['category'] === 'vegetables'
                                    ? 'selected'
                                    : '' ?>
                            >
                                Vegetables
                            </option>

                            <option
                                value="grains"
                                <?= $crop['category'] === 'grains'
                                    ? 'selected'
                                    : '' ?>
                            >
                                Grains
                            </option>

                            <option
                                value="fruits"
                                <?= $crop['category'] === 'fruits'
                                    ? 'selected'
                                    : '' ?>
                            >
                                Fruits
                            </option>

                            <option
                                value="other"
                                <?= $crop['category'] === 'other'
                                    ? 'selected'
                                    : '' ?>
                            >
                                Other
                            </option>

                        </select>

                    </div>

                </div>


                <!-- Description -->

                <div class="form-group">

                    <label>
                        Description
                    </label>

                    <textarea
                        name="description"
                        rows="5"
                        placeholder="Describe your product..."
                    ><?= htmlspecialchars(
                        $crop['description'] ?? ''
                    ) ?></textarea>

                </div>


                <!-- Price + Quantity + Unit -->

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
                            value="<?= htmlspecialchars(
                                $crop['price_per_kg']
                            ) ?>"
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
                            value="<?= htmlspecialchars(
                                $crop['quantity']
                            ) ?>"
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

                            <option
                                value="kg"
                                <?= ($crop['unit'] ?? 'kg') === 'kg'
                                    ? 'selected'
                                    : '' ?>
                            >
                                KG
                            </option>

                            <option
                                value="piece"
                                <?= ($crop['unit'] ?? '') === 'piece'
                                    ? 'selected'
                                    : '' ?>
                            >
                                Piece
                            </option>

                        </select>

                    </div>

                </div>


                <!-- Actions -->

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
                        Update Crop
                    </button>

                </div>

            </form>

        </div>

    </div>

</main>


<?php

require __DIR__ . '/../layouts/footer.php';

?>