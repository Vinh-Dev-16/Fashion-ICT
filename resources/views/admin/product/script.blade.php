
<script>

    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    $(function () {
        $('body').on('click', '.pagination a', function (e) {
            e.preventDefault();
            let url = $(this).attr('href');
            list_data(url);
        });
    });
    $('#search-product').keyup(function(e) {
        if (e.keyCode === 13) {
            list_data();
        }
    });

    function list_data(url) {
        $.ajax({
            url: url,
            method: 'GET',
            data: {
                search: $('#search-product').val(),
            },
            success: function (data) {
                $('#show-data').fadeOut(400, function() {
                    $(this).html(data);
                    $(this).fadeIn(400);
                });
            },
            error: function (error) {
                console.log(error);
            }
        });
    }


    function confirmation(eve) {
        let url = eve.getAttribute('href');
        console.log(url);
        swal({
            title: 'Bạn có chắc là xóa nó chứ?',
            text: 'Bạn có thể restore nó',
            icon: 'warning',
            buttons: true,
            dangerMode: true,
        })
            .then((willCancle) => {
                if (willCancle) {
                    window.location.href = url;
                }
            })
        return false;
    }


</script>
