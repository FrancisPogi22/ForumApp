<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"
    integrity="sha512-VEd+nq25CkR676O+pLBnDW09R7VQX9Mdiij052gVCp5yVH3jGtH70Ho/UUv4mJDsEdTvqRCFZg0NKGiojGnUCw=="
    crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script>
    $(document).ready(function() {
        toastr.options = {
            closeButton: false,
            progressBar: true,
            preventDuplicates: true,
            timeOut: 3000,
            positionClass: "toast-bottom-left"
        };
        @if (Session::has('success'))
            toastr.success("{{ Session::get('success') }}", 'Success');
        @elseif (Session::has('error'))
            toastr.error("{{ Session::get('error') }}", 'Error');
        @elseif (Session::has('warning'))
            toastr.warning("{{ Session::get('warning') }}", 'Warning');
        @endif
    })
</script>
