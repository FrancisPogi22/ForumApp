<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    function showWarningMessage(message = "No changes were made.") {
        return toastr.warning(message, 'Warning');
    }

    function showSuccessMessage(message) {
        return toastr.success(message, 'Success');
    }

    function showInfoMessage(message) {
        return toastr.info(message, 'Info');
    }

    function showErrorMessage(message = 'An error occurred while processing your request.') {
        return toastr.error(message, 'Error');
    }

    function checkPageScroll() {
        if ($(this).scrollTop() > 0)
            $('#header').addClass('scrolled');
        else
            $('#header').removeClass('scrolled');
    }

    function confirmModal(text) {
        return Swal.fire({
            title: 'Confirmation',
            text: text,
            icon: 'info',
            iconColor: '#1d4ed8',
            showDenyButton: true,
            confirmButtonText: 'Yes',
            confirmButtonColor: '#15803d',
            denyButtonText: 'No',
            denyButtonColor: '#B91C1C',
            allowOutsideClick: false
        });
    }

    function getRowData(row, table) {
        let currentRow = $(row).closest('tr');

        if (table.responsive && table.responsive.hasHidden()) currentRow = currentRow.prev('tr');

        return table.row(currentRow).data();
    }

    // $(document).ready(() => {
    //     $(window).scroll(() => {
    //         checkPageScroll();
    //     });

    //     checkPageScroll();

    //     $('.mobile-btn').click(function() {
    //         $('#mobile-nav').slideToggle();
    //     });
    // });
</script>
