let managePackages = () => {
    let image = $('.image').val();
    if (image == "") {
        Notification('danger', 'Error', `Please upload package image`);
        return false;
    }
    let data = {
        image: image,
        requestType: 'managePackages'
    };
    $.post('datafiles/package', data, function (response) {
        let result = JSON.parse(response);
        if (result.status == 1) {
            Notification('success', 'Success', `${result.message}`);
            $('#packageList').DataTable().ajax.reload();
            $(".dz-preview .dz-preview-img").attr({ 'src': "", 'alt': "" });
            $('.image').val('');
        } else {
            Notification('danger', 'Error', `${result.message}`);
        }
    });
}
let packageList = () => {
    $("#packageList").DataTable({
        destroy: true,
        stateSave: true,
        responsive: true,
        bAutoWidth: true,
        dom: '<"row py-3"<"col-md-6 d-flex align-items-center" f><"col-md-6 offset-md-0 d-flex align-items-center justify-content-end" B>><"table-responsive" t><"table-footer-wrapper" <"divider"> <"row"<"col-md-6 d-flex align-items-center" il><"col-md-6 d-flex align-items-center justify-content-end" p>>>',
        buttons: [
            'excelHtml5',
            'csvHtml5',
            {
                extend: 'colvis',
                collectionLayout: 'fixed two-column'
            }
        ],
        order: [
            [0, "desc"]
        ],
        ordering: true,
        rowReorder: true,
        searchDelay: 200,
        processing: true,
        serverSide: false,
        lengthMenu: [
            [50, 100, 500, 1000],
            [50, 100, 500, 1000]
        ],
        ajax: {
            url: "./datafiles/package",
            type: "POST",
            data: {
                requestType: 'packageList'
            },
        },
        drawCallback: function (settings) {
            init_search();
            init_tooltip();
        },
        columns: [
            { data: "sno" },
            { data: "image" },
            { data: "status" },
            { data: "actions" }
        ],
        columnDefs: [
            { targets: [0] },
            { targets: [1] },
            { targets: [2] },
            { targets: [3], visible: true, orderable: false },
        ],
        oLanguage: {
            sSearch: "",
            sSearchPlaceholder: "Search",
            oPaginate: {
                "sPrevious": `<img src="assets/images/svg/chevron-left.svg" width="20" alt="Previous">`,
                "sNext": `<img src="assets/images/svg/chevron-right.svg" width="20" alt="Next">`,
            }
        }
    });
};
packageList();
let deleteRecord = (id) => {
    let data = {
        id: id,
        requestType: 'deleteRecord'
    };
    Swal.fire({
        title: 'Are you sure?',
        text: "You won't be able to revert this!",
        type: 'warning',
        showCancelButton: true,
        confirmButtonText: 'Yes, delete it!'
    }).then((result) => {
        if (result.value) {
            $.post('datafiles/package', data, function (response) {
                let result = JSON.parse(response);
                if (result.status == 1) {
                    $(`#row_${id}`).closest('tr').css('background-color', 'red').fadeOut(2000).remove('slow');
                    Notification('success', 'Success!', `${result.message}`);
                } else {
                    Notification('danger', 'Error', `${result.message}`);
                }
            });
        }
    });
}
let updateStatus = (id) => {
    let data = {
        id: id,
        status: ($(`#status_${id}`).is(':checked') ? '1' : '0'),
        requestType: 'updateStatus'
    };
    Swal.fire({
        title: 'Are you sure?',
        text: "You won't be able to revert this!",
        type: 'warning',
        showCancelButton: true,
        confirmButtonText: 'Yes, update it!'
    }).then((result) => {
        if (result.value) {
            $.post('datafiles/package', data, function (response) {
                let result = JSON.parse(response);
                if (result.status == 1) {
                    $('#packageList').DataTable().ajax.reload();
                    Notification('success', 'Success', `${result.message}`);
                } else {
                    Notification('danger', 'Error!', `${result.message}`);
                }
            });
        }
    });
}