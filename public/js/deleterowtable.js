// delete row table
    $(document).ready(function(){
        $('.delete-row').click(function(){
            var index = $(this).data('index');
            $('tr[data-index="' + index + '"]').remove();

            $.ajax({
                url: '{{ route("remove.session.row") }}',
                type: 'POST',
                data: {
                    _token: '{{ csrf_token() }}',
                    index: index
                },
                success: function(response) {
                    console.log(response);
                },
                error: function(xhr) {
                    console.log(xhr.responseText);
                }
            });
        });
    });
