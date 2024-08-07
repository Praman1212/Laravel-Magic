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

<!-- Edit button of ajax form -->
<script>
    $(document).ready(function() {
        // When you use data-id attribute then use this ho handle the click event
        $(document).on('click', '#ajax-edit-button', function(event) {
            event.preventDefault();
            var id = $(this).data('id');
            var url = '/ajax/' +id+ '/edit' ;
            $.ajax({
                url: url,
                type: 'GET',
                success: function(response){
                    console.log(response)
                    if(response.url){
                        history.pushState(null,'',response.url);
                        $('.here').empty();
                        $('.here').append(response.data);
                    }
                }
            })
        });
    })
</script>
<!--  -->

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