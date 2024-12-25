$(document).ready(function () {
    var services_id = $('#serviceDetailsList').attr("services_id");
    serviceDetailsList(services_id);
});
let manageServiceDetails = (element) => {
    let forms = $(element).closest('.services_form');
    let image = forms.find('.image').val();
    if (image == "") {
        Notification('danger', 'Error', `Please upload service detail image`);
        return false;
    }
    let fields = ['title', 'description'];
    let module = forms.find('#manageServiceDetails').data('module');
    let isValid = true;
    forms.each(function () {
        if (!this.checkValidity()) {
            isValid = false;
            fields.forEach(field => {
                let value = forms.find(`#${field}`).val();
                (value == '') ? forms.find(`#${field}`).addClass('is-invalid') : forms.find(`#${field}`).removeClass('is-invalid');
            });
        }
    });
    if (isValid) {
        let data = {
            services_id: $('#serviceDetailsList').attr("services_id"),
            title: forms.find('#title').val(),
            image: image,
            description: forms.find('#description').val(),
            module: module,
            requestType: 'manageServiceDetails'
        };
        if (module == 'update') {
            data.id = forms.find('#manageServiceDetails').data('servicedetails-id');
        }
        $.post('datafiles/service_details', data, function (response) {
            let result = JSON.parse(response);
            if (result.status == 1) {
                Notification('success', 'Success', `${result.message}`);
                $('#serviceDetailsList').DataTable().ajax.reload();
                switch (module) {
                    case 'create':
                        $('#detailsModal').modal('hide');
                        forms.find('#description, #title, .image').val('');
                        forms.find(".dz-preview .dz-preview-img").attr({ 'src': "", 'alt': "" });
                        break;
                    case 'update':
                        $('#edit-service-modal').modal('hide');
                        break;
                }
            } else {
                Notification('danger', 'Error!', `${result.message}`);
            }
        });
    }
};

let serviceDetailsList = (services_id) => {
    $("#serviceDetailsList").DataTable({
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
            url: "./datafiles/service_details",
            type: "POST",
            data: {
                requestType: 'serviceDetailsList',
                id: services_id
            },
        },
        drawCallback: function (settings) {
            init_search();
            init_tooltip();
        },
        columns: [
            { data: "sno" },
            { data: "title" },
            { data: "image" },
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
            sSearchPlaceholder: "Search Blogs",
            oPaginate: {
                "sPrevious": `<img src="assets/images/svg/chevron-left.svg" width="20" alt="Previous">`,
                "sNext": `<img src="assets/images/svg/chevron-right.svg" width="20" alt="Next">`,
            }
        }
    });
};
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
            $.post('datafiles/service_details', data, function (response) {
                let result = JSON.parse(response);
                if (result.status == 1) {
                    $(`#row_${id}`).closest('tr').css('background-color', 'red').fadeOut(2000).remove('slow');
                    Notification('success', 'Success!', `${result.message}`);
                    $('#serviceDetailsList').DataTable().ajax.reload();
                } else {
                    Notification('danger', 'Error', `${result.message}`);
                }
            });
        }
    });
}
let updateServiceDetails = (id) => {
    let data = {
        id: id,
        requestType: 'updateServiceDetails'
    };
    $.post('datafiles/service_details', data, function (response) {
        let result = JSON.parse(response);
        if (result.status == 1) {
            $("#edit-service-modal-body").html(result.payload);
            initializeDropzone('[data-toggle="dropzone-image-2"]', '#image-2');
            $("#edit-service-modal").modal('show');
        } else {
            Notification('danger', 'Error!', `${result.message}`);
        }
    });
}