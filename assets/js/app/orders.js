const manageOrders = (module) => {
    const forms = $(".orderForm");
    forms.parsley().validate();
    if (forms.parsley().isValid()) {
        const data = {
            customer_name: $("#customer_name").val(),
            customer_contact: $("#customer_contact").val(),
            order_date: new Date($("#order_date").val()).toISOString().slice(0, 10),
            shipping_charges: $("#shipping_charges").val(),
            module: module,
            requestType: "manageOrders"
        };
        if (module == 'create') {
            data.details = $("[name='product_id[]']").map(function (index, element) {
                return {
                    id: $(element).val(),
                    quantity: $("[name='product_quantity[]']").eq(index).val(),
                    amount: $(element).find('option:selected').attr("product_amount"),
                    discount: $("[name='product_discount[]']").eq(index).val()
                };
            }).get();
        }

        if (module == 'update') {
            data.id = $('#manageOrders').attr("order_id");
            data.details = $("[name='product_id[]']").map(function (index, element) {
                return {
                    actual_product: $("[name='actual_product[]']").eq(index).val(),
                    id: $(element).val(),
                    quantity: $("[name='product_quantity[]']").eq(index).val(),
                    amount: $(element).find('option:selected').attr("product_amount"),
                    discount: $("[name='product_discount[]']").eq(index).val()
                };
            }).get();
        }
        initLoader('manageOrders', 'Save', 'btn btn-bgchecker');
        $.post('datafiles/orders', data, function (response) {
            let result = JSON.parse(response);
            if (result.status == 1) {
                Swal.fire('Success!', `${result.message}`, 'success')
                    .then(() => {
                        window.location.href = "/orderList";
                    });
            } else {
                Notification('danger', 'Error', `${result.message}`);
            }
            destroyLoader('manageOrders', 'Save', 'btn btn-bgchecker');
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
    }, orderListInit);
    orderListInit(start, end, '');
});

//======================== Show Leads ========================
function orderListInit(start, end, label) {
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
    let orderList = () => {
        $("#orderList").DataTable({
            responsive: true,
            destroy: true,
            stateSave: true,
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
                url: "./datafiles/orders",
                type: "POST",
                data: {
                    start_date: start_date,
                    end_date: end_date,
                    requestType: 'orderList'
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
                { data: "ORDERNO" },
                { data: "ORDERDATE" },
                { data: "CUSTOMERNAME" },
                { data: "CUSTOMERCONTACT" },
                { data: "QUANTITY" },
                { data: "SUBTOTAL" },
                { data: "SHIPPINGCHARGES" },
                { data: "DISCOUNT" },
                { data: "TOTALAMOUNNT" },
                { data: "PROFIT" },
                { data: "PAYMENTSTATUS" },
                { data: "ACTIONS" },

            ],
            columnDefs: [
                { targets: [0] },
                { targets: [1] },
                { targets: [2] },
                { targets: [3] },
                { targets: [4] },
                { targets: [5] },
                { targets: [6] },
                { targets: [7] },
                { targets: [8] },
                { targets: [9] },
                { targets: [10] },
                { targets: [11], visible: true, orderable: false },
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
    orderList();
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
            $.post('datafiles/orders', data, function (response) {
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
// ============================ Update Record ============================
let updateRecord = (id) => {
    let data = {
        id: id,
        requestType: 'updateRecord'
    };
    Swal.fire({
        title: 'Are you sure?',
        text: "You won't be able to revert this!",
        type: 'warning',
        showCancelButton: true,
        confirmButtonText: 'Yes, update it!'
    }).then((result) => {
        if (result.value) {
            $.post('datafiles/orders', data, function (response) {
                let result = JSON.parse(response);
                if (result.status == 1) {
                    $('#orderList').DataTable().ajax.reload();
                    Notification('success', 'Success!', `${result.message}`);
                } else {
                    Notification('danger', 'Error', `${result.message}`);
                }
            });
        }
    });
}
// ============================ Update Record ============================

let row_count = 0;
let add_row = () => {
    const append_body = $('#append_products');
    let productList = $('#productList').html();
    const body = `
        <div class="row">
            <div class="col-3">
                <div class="form-group">
                    <label class="creat-lable d-none" for="">Product</label>
                    <select name="product_id[]" class="form-control form-control-lg" size="1" data-toggle="custom-select2" placeholder="Select Product" data-allow-clear="1" required>
                    ${productList}
                    </select>
                </div>
            </div>
            <div class="col-3">
                <div class="form-group">
                    <label class="creat-lable d-none" for="">Quantity</label>
                    <input type="text" name="product_quantity[]" data-parsley-type="number" class="form-control form-control-lg digits" required placeholder="Quantity" value="1">
                </div>
            </div>
            <div class="col-3">
                <div class="form-group">
                    <label class="creat-lable d-none" for="">Product Discount</label>
                    <input type="text" name="product_discount[]" class="form-control form-control-lg digits" required placeholder="Discount Amount">
                </div>
            </div>
            <div class="col-3">
                <a href="javascript:void(0);" onclick="${(row_count === 0 ? 'add_row()' : 'remove_row(this)')}" class="btn btn-sm btn-custom"><i class="fa fa-${(row_count === 0 ? 'plus' : 'trash')}" aria-hidden="true"></i></a>
            </div>
        </div>
    `;

    if (row_count < 3) {
        append_body.append(body);
        init_select2();
        row_count++;
    } else {
        Notification("danger", "Error!", `Limit Exceeded!`);
    }
}

const remove_row = (element) => {
    row_count--;
    $(element).closest('.row').remove();
};
add_row();