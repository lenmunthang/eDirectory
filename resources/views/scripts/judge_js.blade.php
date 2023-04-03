<script type="text/javascript">
    $('#table_active').DataTable();
    $('#table_inactive').DataTable();
    // Basic Example with form
    var form = $("#judge-form");
    form.validate({
        errorPlacement: function errorPlacement(error, element) {
            element.before(error);
        },
        rules: {
            confirm: {
                equalTo: "#password"
            }
        }
    });
    form.children("div").steps({
        headerTag: "h3",
        bodyTag: "section",
        transitionEffect: "slideLeft",
        onStepChanging: function(event, currentIndex, newIndex) {
            form.validate().settings.ignore = ":disabled,:hidden";
            return form.valid();
        },
        onFinishing: function(event, currentIndex) {
            form.validate().settings.ignore = ":disabled";
            return form.valid();
        },
        onFinished: function(event, currentIndex) {
            // alert("Submitted!");
            $("#judge-form").submit();
        }
    });

    $(document).ready(function() {
        $('.alert-success').fadeIn().delay(3000).fadeOut();
        
        $('#inactive_judges').hide();
        $("input[id$='active_judges_rd']").click(function() {
            $('#active_judges').show();
            $('#inactive_judges').hide();
        });

        $("input[id$='inactive_judges_rd']").click(function() {
            $('#inactive_judges').show();
            $('#active_judges').hide();
        });

        // Get the input fields
        var firstNameInput = $('#judge_f_name');
        var middleNameInput = $('#judge_m_name');
        var lastNameInput = $('#judge_l_name');
        var fullNameInput = $('#judge_full_name');

        // Attach an event listener to the input fields
        firstNameInput.on('input', updateFullName);
        middleNameInput.on('input', updateFullName);
        lastNameInput.on('input', updateFullName);

        // Define the function that updates the full name input
        function updateFullName() {
            var firstName = firstNameInput.val();
            var middleName = middleNameInput.val();
            var lastName = lastNameInput.val();

            // Concatenate the first, middle, and last name values
            var fullName = firstName + ' ' + middleName + ' ' + lastName;

            fullName = fullName.replace(/\b\w/g, function(txt) {
                return txt.charAt(0).toUpperCase() + txt.substr(1).toLowerCase();
            });
            // Set the value of the full name input
            fullNameInput.val(fullName);
        }

        $('#image').change(function() {
            let file = this.files[0];
            let fileType = file['type'];
            let validImageTypes = ['image/jpeg', 'image/png', 'image/gif'];
            if ($.inArray(fileType, validImageTypes) < 0) {
                // show error message
                $('#image-upload-error').html(
                    'Invalid image type. Please select a JPEG, PNG or GIF file.');
                // reset the file input
                $('#image').val('');
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

        $("#table_active").on('click', '.show_confirm', function(event) {
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

        $("#table_inactive").on('click', '.show_confirm', function(event) {
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
</script>
