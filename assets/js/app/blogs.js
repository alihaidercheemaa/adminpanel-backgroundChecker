    //========================CKEditor=======================
    initCKEditor();
    //========================CKEditor=======================

    $("#title").keyup(function () {
        var slug = $("#title").val().replace(/ /g, "-").toLowerCase();
        $("#slug").val(slug);
    });

    let manageBlogs = () => {
        let detailed_content = CKEDITOR.instances[document.querySelector('#detailed_content').getAttribute('id')].getData();
        let forms = $('.blogs_form');
        let image = $('.image').val();
        if(image == ""){
            Notification('danger', 'Error', `Please upload blog image`);
            return false;
        }
        let fields = ['title', 'slug', 'date', 'author', 'short_content'];
        let module = $('#manageBlogs').data("module");
        let isValid = true;
        forms.each(function () {
            if (!this.checkValidity()) {
                isValid = false;
                fields.forEach(field => {
                    let value = $(`#${field}`).val();
                    (value == '') ? $(`#${field}`).addClass('is-invalid') : $(`#${field}`).removeClass('is-invalid');
                });
            }
        });
        if(detailed_content == ""){
            Notification('danger', 'Error', `Please Enter Blog Detailed Content!`);
            return false;
        }
        if (isValid) {
            let data = {
                title: $('#title').val(),
                slug: $('#slug').val(),
                blog_image: image,
                author: $('#author').val(),
                short_description: $('#short_content').val(),
                detailed_description: detailed_content,
                blog_date : $("#date").val(),
                module: module,
                requestType: 'manageBlogs'
            };
            if (module == 'update') {
                data.id = $('#manageBlogs').attr("blogs_id");
            }
            $.post('datafiles/blogs', data, function (response) {
                let result = JSON.parse(response);
                if (result.status == 1) {
                    Swal.fire('Success', `${result.message}`, 'success')
                        .then(() => {
                            window.location.href = "/blogList";
                        });
                } else {
                    Notification('danger', 'Error', `${result.message}`);
                }
            });
        }
    };
    $(document).ready(function () {
        var picker = $('#datepicker');
        var start = "";
        var end = "";
        start = moment().startOf('month');
        end = moment();
        picker.daterangepicker({
            start_date: start,
            end_date: end,
            opens: 'left',
            minDate: moment().subtract(3, 'months'),
            maxDate: moment(),
            ranges: {
                'Today': [moment(), moment()],
                'Yesterday': [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
                'Last 7 Days': [moment().subtract(6, 'days'), moment()],
                'Last 30 Days': [moment().subtract(29, 'days'), moment()],
                'This Month': [moment().startOf('month'), moment().endOf('month')],
                'Last Month': [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')],
                'Last 3 Months': [moment().subtract(3, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')]
            },
        }, blogsInit);
        blogsInit(start, end, '');
    });
    function blogsInit(start, end, label) {
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
        let blogsList = () => {
            $("#blogsList").DataTable({
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
                    url: "./datafiles/blogs",
                    type: "POST",
                    data: {
                        start_date: start_date,
                        end_date: end_date,
                        requestType: 'blogsList'
                    },
                },
                drawCallback: function (settings) {
                    init_search();
                    init_tooltip();
                    $('#datepicker').find('span.date_range').html(range);
                    $('#datepicker').find('span.date_title').html(title);
                },
                columns: [
                    { data: "sno" },
                    { data: "image" },
                    { data: "title" },
                    { data: "author" },
                    { data: "date" },
                    { data: "status" },
                    { data: "actions" }
                ],
                columnDefs: [
                    { targets: [0] },
                    { targets: [1] },
                    { targets: [2] },
                    { targets: [3] },
                    { targets: [4] },
                    { targets: [5], visible: true, orderable: false },
                    { targets: [6], visible: true, orderable: false },
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
        blogsList();
        $('#datepicker').find('span.date_range').html(range);
        $('#datepicker').find('span.date_title').html(title);
    }
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
                $.post('datafiles/blogs', data, function (response) {
                    let result = JSON.parse(response);
                    if (result.status == 1) {
                        $(`#row_${id}`).closest('tr').css('background-color', 'red').fadeOut(2000).remove('slow');
                        Notification('success', 'Success!', `${result.message}`);
                        $('#blogsList').DataTable().ajax.reload();
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
                $.post('datafiles/blogs', data, function (response) {
                    let result = JSON.parse(response);
                    if (result.status == 1) {
                        $('#blogsList').DataTable().ajax.reload();
                        Notification('success', 'Success', `${result.message}`);
                    } else {
                        Notification('danger', 'Error!', `${result.message}`);
                    }
                });
            }
        });
    }