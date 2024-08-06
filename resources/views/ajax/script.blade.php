<!-- Ajax Form submit for create.blade.php -->
<script>
    $(document).ready(function() {
        $('#ajaxForm').on('submit', function(event) {
            event.preventDefault();
            var dataItem = $(this).serialize();
            var url = $('#ajaxForm').attr('action');
            var method = '{{ isset($item) ? 'PUT' : 'POST' }}';
            $.ajax({
                url: url,
                type: method,
                data: dataItem,
                success: function(response) {
                    console.log(response)
                    // partial view concept
                    if (response.url) {
                        history.pushState(null, '', response.url);
                        $('.partial-view').empty();
                        $('.partial-view').append(response.data)
                    }
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
<!-- For delete message -->
<script>
    function approveMessage() {
        return confirm('Are you sure want to delete the data?')
    }
</script>