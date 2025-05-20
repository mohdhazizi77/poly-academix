<script type="text/javascript">

    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    function confirmDelete({
                               title = 'Are you sure?',
                               text = 'This action cannot be undone!',
                               confirmText = 'Delete',
                               cancelText = 'Cancel',
                               confirmColor = '#f46a6a',
                               cancelColor = '#74788d',
                               deleteUrl,
                               successText = 'Item has been successfully deleted!',
                               onSuccess
                           }) {
        Swal.fire({
            title: title,
            html: text,
            icon: "warning",
            showCancelButton: true,
            confirmButtonText: confirmText,
            cancelButtonText: cancelText,
            confirmButtonColor: confirmColor,
            cancelButtonColor: cancelColor,
            reverseButtons: true
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    type: "DELETE",
                    url: deleteUrl,
                    success: function (response) {
                        if (response.status === 'success') {
                            Swal.fire({
                                title: "Deleted!",
                                html: successText,
                                icon: "success",
                                confirmButtonColor: cancelColor,
                                confirmButtonText: cancelText
                            }).then(() => {
                                if (typeof onSuccess === 'function') {
                                    onSuccess(response);
                                }
                            });
                        }
                    }
                });
            }
        });
    }
</script>
