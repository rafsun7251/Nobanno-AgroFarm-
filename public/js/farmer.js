document.addEventListener("DOMContentLoaded", function () {

    const deleteModal =
        document.getElementById("deleteModal");

    const deleteCropName =
        document.getElementById("deleteCropName");

    const confirmDelete =
        document.getElementById("confirmDelete");

    const cancelDelete =
        document.getElementById("cancelDelete");

    const modalOverlay =
        document.querySelector(".delete-modal-overlay");


    let deleteUrl = "";


    // ==========================================
    // OPEN DELETE MODAL
    // ==========================================

    const deleteButtons =
        document.querySelectorAll(".delete-crop-btn");


    deleteButtons.forEach(function (button) {

        button.addEventListener("click", function (event) {

            event.preventDefault();


            deleteUrl =
                button.getAttribute("data-delete-url");


            const cropName =
                button.getAttribute("data-crop-name");


            deleteCropName.textContent =
                cropName;


            deleteModal.classList.add("active");

        });

    });


    // ==========================================
    // CANCEL DELETE
    // ==========================================

    function closeDeleteModal() {

        deleteModal.classList.remove("active");

        deleteUrl = "";

    }


    cancelDelete.addEventListener(
        "click",
        closeDeleteModal
    );


    modalOverlay.addEventListener(
        "click",
        closeDeleteModal
    );


    // ==========================================
    // CONFIRM DELETE
    // ==========================================

    confirmDelete.addEventListener(
        "click",
        function () {

            if (deleteUrl !== "") {

                window.location.href =
                    deleteUrl;

            }

        }
    );


    // ==========================================
    // ESC KEY
    // ==========================================

    document.addEventListener(
        "keydown",
        function (event) {

            if (
                event.key === "Escape" &&
                deleteModal.classList.contains("active")
            ) {

                closeDeleteModal();

            }

        }
    );

});