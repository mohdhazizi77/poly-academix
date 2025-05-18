$(document).ready(function () {

    if ($('#dt1').length > 0) {
        var dt = $('#dt1').DataTable({
            responsive: false,
            processing: true,
            serverSide: true,
            ajax: {
                url: ajaxUrl,
                type: 'POST',
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                data: function (data) {
                    data.role = $('#role').val();
                }
            },
            columns: [
                {
                    data: 'DT_RowIndex',
                    name: 'DT_RowIndex',
                    orderable: false,
                    searchable: false,
                },
                {
                    data: 'role',
                    name: 'role',
                    class: 'text-center',
                },
                {
                    data: 'name',
                    name: 'name',
                    class: 'text-left',
                },
                {
                    data: 'email',
                    name: 'email',
                    class: 'text-center',
                },
                {
                    data: 'is_active',
                    name: 'is_active',
                    class: 'text-center',
                    render(data, type, row) {
                        let result = '';
                        if (data === 1) {
                            result += '<span class="badge badge-success">Success</span>';
                        } else {
                            result += '<span class="badge badge-danger">Danger</span>';
                        }
                        return result;
                    }
                },
                {
                    data: 'id',
                    name: 'id',
                    class: 'text-center',
                    render(data, type, row) {
                        let btn = '';
                        if (row.role !== 'SUPER ADMIN') {
                            // btn += row.actionReset ? '<a href="javascript:void(0);" data-url="' + row.actionReset + '" style="margin-left: 5px; margin-right: 10px;" class="text-info btn-reset"><i class="mdi mdi-lock-reset font-size-18"></i></a>' : '';
                            btn += row.actionUpdate ? '<a href="' + row.actionUpdate + '" style="margin-left: -5px; margin-right: 5px;" class="text-primary"><i data-feather="edit">Edit</i></a>' : '';
                            btn += row.actionDelete ? '<a href="javascript:void(0);" data-url="' + row.actionDelete + '" style="margin-left: 5px; margin-right: 5px;" class="text-danger btn-delete"><i class="fa-solid fa-life-ring">Delete</i></a>' : '';
                        }
                        return btn;
                    }
                },
            ],
            pageLength: 50,
            bLengthChange: true,
            order: [
                [0, 'asc']
            ],
        });

        if ($('#button-search').length > 0) {
            $(document).on("click", "#button-search", function (e) {
                dt.ajax.reload(null, true);
            });
        }

        $('#dt1').on('processing.dt', function (e, settings, processing) {
            if (processing) {
                $('#button-search-icon').removeClass();
                $('#button-search-icon').addClass('bx bx-loader bx-spin font-size-16 align-middle me-1');
                $('#button-search').prop('disabled', true);
            } else {
                $('#button-search-icon').removeClass();
                $('#button-search-icon').addClass('fas fa-search me-1');
                $('#button-search').prop('disabled', false);
            }
        });


    }
});
