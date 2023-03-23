<script type="text/javascript">
    $('.table').DataTable();

    $(document).ready(function() {
        $('.alert').fadeIn().delay(3000).fadeOut();

        $('#dist_img').change(function() {
            let file = this.files[0];
            let fileType = file['type'];
            let validImageTypes = ['image/jpeg', 'image/png', 'image/gif'];
            if ($.inArray(fileType, validImageTypes) < 0) {
                // show error message
                $('#image-upload-error').html(
                    'Invalid image type. Please select a JPEG, PNG or GIF file.');
                // reset the file input
                $('#dist_img').val('');
                // clear the preview image
                $('#preview-image-before-upload').attr('src', 'assets/images/users/1.jpg');
            } else {
                // clear the error message
                $('#image-upload-error').html('');
                // display the preview image
                let reader = new FileReader();
                reader.onload = (e) => {
                    $('#preview-image-before-upload').attr('src', e.target.result);
                }
                reader.readAsDataURL(file);
            }
        });

        $(".table").on('click', '.show_confirm', function(event) {
            var form = $(this).closest("form");
            var name = $(this).data("name");
            event.preventDefault();
            swal({
                    title: `Are you sure you want to delete this record?`,
                    icon: "warning",
                    buttons: true,
                    dangerMode: true,
                })
                .then((willDelete) => {
                    if (willDelete) {
                        form.submit();
                    }
                });
        });
    });

    // using ajax to fetch data 
    function showDistrictDetails(dist_id) {
        $.ajax({
            url: "{{ route('update_district_show') }}",
            type: 'POST',
            headers: {
                'X-CSRF-TOKEN': '{{ csrf_token() }}'
            },
            data: {
                dist_id: dist_id
            },
            success: function(data) {
                $('#edit-modal-body').html(data)
            },

        });
    }

    function showSubDivisionDetails(subdiv_id) {
        $.ajax({
            url: "{{ route('update_sub_division_show') }}",
            type: 'POST',
            headers: {
                'X-CSRF-TOKEN': '{{ csrf_token() }}'
            },
            data: {
                subdiv_id: subdiv_id
            },
            success: function(data) {
                $('#edit-subdiv-modal-body').html(data)
            },

        });
    }
</script>
