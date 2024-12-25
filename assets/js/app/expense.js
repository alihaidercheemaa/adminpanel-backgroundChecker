const manageExpense = (module) => {
    const forms = $("#expenseForm");
    forms.parsley().validate();
    if (forms.parsley().isValid()) {
        const data = {
            name: $("#name").val(),
            description: $("#description").val(),
            amount: $("#amount").val(),
            purchase_date: new Date($("#purchase_date").val()).toISOString().slice(0, 10),
            module: module,
            requestType: "manageExpense"
        };
        if (module == 'update') {
            data.id = $('#manageExpense').attr("expense_id");
        }
        initLoader('manageExpense', 'Save', 'btn btn-bgchecker');
        $.post('datafiles/expense', data, function (response) {
            let result = JSON.parse(response);
            if (result.status == 1) {
                Swal.fire('Success!', `${result.message}`, 'success')
                    .then(() => {
                        window.location.href = "/expenseList";
                    });
            } else {
                Notification('danger', 'Error', `${result.message}`);
            }
            destroyLoader('manageExpense', 'Save', 'btn btn-bgchecker');
        });
    } else {
        return false;
    }
}
$(document).ready(function () {
    var picker = $('#datepicker');
    var start = "";
    var end = "";
    start = moment().subtract(3, 'days');
    end = moment();
    picker.daterangepicker({
        start_date: start,
        end_date: end,
        opens: 'left',
        minDate: moment().subtract(12, 'months'),
        maxDate: moment(),
        ranges: {
            'Today': [moment(), moment()],
            'Yesterday': [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
            'This Month': [moment().startOf('month'), moment().endOf('month')],
            'Last Month': [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')],
            'Last 3 Months': [moment().subtract(3, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')],
            'This Year': [moment().startOf('year'), moment().endOf('year')],
            'Last Year': [moment().subtract(1, 'year').startOf('year'), moment().subtract(1, 'year').endOf('year')]
        },
    }, expenseListInit);
    expenseListInit(start, end, '');
});

//======================== Show Leads ========================
function expenseListInit(start, end, label) {
    var title = '';
    var range = '';
    var rangejson = '';
    if (label == 'Today') {
        title = 'Today:';
        range = start.format('MMM DD, YYYY');
        rangejson = start.format('YYYY-MM-DD');
    } else if (label == 'Yesterday') {
        title = 'Yesterday:';
        range = start.format('MMM DD, YYYY');
        rangejson = start.format('YYYY-MM-DD');
    } else {
        range = start.format('MMM DD, YYYY') + ' - ' + end.format('MMM DD, YYYY');
        rangejson = start.format('YYYY-MM-DD') + ' - ' + end.format('YYYY-MM-DD');
    }

    start_date = start.format('YYYY-MM-DD');
    end_date = end.format('YYYY-MM-DD');
    let expenseList = () => {
        $("#expenseList").DataTable({
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
                url: "./datafiles/expense",
                type: "POST",
                data: {
                    start_date: start_date,
                    end_date: end_date,
                    requestType: 'expenseList'
                },
            },
            drawCallback: function (settings) {
                init_select2();
                init_search();
                init_tooltip();
                $('#datepicker').find('span.date_range').html(range);
                $('#datepicker').find('span.date_title').html(title);
            },
            columns: [
                { data: "SNO" },
                { data: "NAME" },
                { data: "PURCHASEDATE" },
                { data: "DESCRIPTION" },
                { data: "AMOUNT" },
                { data: "ACTIONS" }
            ],
            columnDefs: [
                { targets: [0] },
                { targets: [1] },
                { targets: [2] },
                { targets: [3] },
                { targets: [4] },
                { targets: [5], visible: true, orderable: false },
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
    expenseList();
    $('#datepicker').find('span.date_range').html(range);
    $('#datepicker').find('span.date_title').html(title);
}
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
            $.post('datafiles/expense', data, function (response) {
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
// ============================ Delete Record ============================