// const manageProducts = (module) => {
//     const forms = $("#productForm");
//     forms.parsley().validate();
//     if (forms.parsley().isValid()) {
//         const data = {
//             name: $("#name").val(),
//             quantity: $("#quantity").val(),
//             price: $("#price").val(),
//             cost_price: $("#cost_price").val(),
//             status: $("#status option:selected").val(),
//             module: module,
//             requestType: "manageProducts"
//         };
//         if (module == 'update') {
//             data.id = $('#manageProducts').attr("product_id");
//         }
//         initLoader('manageProducts', 'Save', 'btn btn-bgchecker');
//         $.post('datafiles/products', data, function (response) {
//             let result = JSON.parse(response);
//             if (result.status == 1) {
//                 Swal.fire('Success!', `${result.message}`, 'success')
//                     .then(() => {
//                         window.location.href = "/appointmentList";
//                     });
//             } else {
//                 Notification('danger', 'Error', `${result.message}`);
//             }
//             destroyLoader('manageProducts', 'Save', 'btn btn-bgchecker');
//         });
//     } else {
//         return false;
//     }
// }

//======================== Show Products ========================
const appointmentList = () => {
    $("#appointmentList").DataTable({
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
            url: "./datafiles/appointments",
            type: "POST",
            data: {
                requestType: 'appointmentList'
            },
        },
        drawCallback: function (settings) {
            init_search();
            init_tooltip();
        },
        columns: [
            { data: "SNO" },
            { data: "NAME" },
            { data: "PHONE" },
            { data: "EMAIL" },
            { data: "MESSAGE" },
            { data: "DATE" },
            { data: "TIME" },
            { data: "ACTIONS" }
        ],
        columnDefs: [
            { targets: [0] },
            { targets: [1] },
            { targets: [2] },
            { targets: [3] },
            { targets: [4] },
            { targets: [5] },
            { targets: [6], visible: true, orderable: false }
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
appointmentList();
// ============================ Delete Record ============================
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
            $.post('datafiles/appointments', data, function (response) {
                let result = JSON.parse(response);
                if (result.status == 1) {
                    $(`#row_${id}`).closest('tr').css('background-color', 'red').fadeOut(2000).remove('slow');
                    $('#appointmentList').DataTable().ajax.reload();
                    Notification('success', 'Success!', `${result.message}`);
                } else {
                    Notification('danger', 'Error', `${result.message}`);
                }
            });
        }
    });
}
// ============================ Delete Record ============================