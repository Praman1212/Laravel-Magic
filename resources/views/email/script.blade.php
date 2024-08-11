<script>
    $(document).ready(function(){
        $('.email-edit-btn').on('click',function(event){
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
        $('#closeModal').on('click',function(event){
            event.preventDefault();

            $('#yourEmail').html('')
            $('#clientEmail').html('')
            $('#message').html('')
        })
    });
</script>