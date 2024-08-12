<script>
    $(document).ready(function() {
        $('.email-edit-btn').on('click', function(event) {
            event.preventDefault();

            var id = $(this).data('id');
            var yourEmail = $(this).data('yourEmail');
            var clientEmail = $(this).data('clientEmail');
            var message = $(this).data('message');

            console.log(id, yourEmail, clientEmail, message)
            $('#email_id').val(id);
            $('#your_email').val(yourEmail)
            $('#client_email').val(clientEmail)
            $('#message').append(message);


        })
        $('#closeModal').on('click', function(event) {
            event.preventDefault();

            $('#yourEmail').html('')
            $('#clientEmail').html('')
            $('#message').html('')
        })
    });
</script>
<!-- Store and update the email-form -->
<script>
    $(document).ready(function() {
        $('#email-form').on('submit', function(event) {
            event.preventDefault();
            var dataItem = $(this).serialize();
            var id = $('#email_id').val();
            console.log(id);
            var url = id ? '/email/' + id : '/email/';
            var method = id ? 'PUT' : 'POST';
            $.ajax({
                url: url,
                type: method,
                data: dataItem,
                success: function(response) {
                    sessionStorage.setItem('status', response.status);
                    window.location.href = response.route;
                },
                error: function(xhr, status, error) {
                    console.log(error);
                }

            })
        });
    });
</script>

<!-- Delete email data -->
<script>
    $(document).ready(function() {
        $('#email-delete-form').on('submit', function(event) {
            event.preventDefault();
            var form = $(this);
            var url = form.attr('action');
            var formData = form.serialize();

            $.ajax({
                url: url,
                type: "POST",
                data: formData,
                success: function(response) {
                    sessionStorage.setItem('status', response.status);
                    window.location.href = response.route;
                },
                error: function(xhr, status, error) {
                    console.log(error)
                }
            });
        });
    });
</script>

<!-- Get the status message using getItem -->
<script>
    $(document).ready(function() {
        var status = sessionStorage.getItem('status');
        if (status) {

            $('.status-message').text(status).addClass('bg-green-800 text-white').show();
            setTimeout(function() {
                $('.status-message').fadeOut();
            }, 2000);

            sessionStorage.removeItem('status');
        }
    });
</script>


<!-- For the confirmation message to delete the data -->
<script>
    function showConfirmationModal(event) {
        event.preventDefault();
        $('#confirmationModal').removeClass('hidden');
        $('#cancelButton').click(function() {
            $('#confirmationModal').addClass('hidden');
        })
        $('#confirmButton').click(function() {
            $('#confirmationModal').addClass('hidden');
            event.target.submit();
        });
        return false;
    }
</script>