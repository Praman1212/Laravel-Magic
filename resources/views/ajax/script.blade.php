<!-- Ajax Form submit for create.blade.php -->
<script>
    $(document).ready(function() {
        $('#ajaxForm').on('submit', function(event) {
            event.preventDefault();
            var dataItem = $(this).serialize();
            var url = '{{ route('ajax.store') }}';
            $.ajax({
                url: url,
                type: 'POST',
                data: dataItem,
                success: function(response) {
                    sessionStorage.setItem('status', response.status);
                    window.location.href = response.route;
                },
                error: function(xhr, status, error) {
                    console.error(error)
                    alert('Form submission error');
                }
            })

        });
    });
</script>
<!-- To get the status message -->
<script>
    $(document).ready(function() {
        var statusMessage = sessionStorage.getItem('status');
        if (statusMessage) {
            $('#statusMessage').text(statusMessage).removeClass('hidden');
            setTimeout(function() {
                $('#statusMessage').addClass('hidden')
                sessionStorage.removeItem('status');
            }, 2000);
        }
    });
</script>