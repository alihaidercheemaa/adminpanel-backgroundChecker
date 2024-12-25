<?php
    $title = 'Service Details';
    $id = (isset($_GET['id']) && !empty($_GET['id']) ? $_GET['id'] : '');
    if (empty($id)) {
        header('Location: /404');
        exit();
    }
    include('../includes/header.php');
    ?>
    <!--========================= Add Details =====================-->
    <div class="modal fade" id="detailsModal" role="dialog" aria-labelledby="addsucessModal" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered w-800" role="document">
            <div class="modal-content">
                <div class="modal-header border-0 pb-0">
                    <h6 class="modal-title mb-3" id="modal-title-default">Add Details</h6>
                    <button type="button" class="close w-100 text-right" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">
                            <svg width="17" height="17" viewBox="0 0 22 22" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M19.5312 2.46875L2.46875 19.5312M2.46875 2.46875L19.5312 19.5312" stroke="#000000" stroke-width="4" stroke-linecap="round" stroke-linejoin="round"></path>
                            </svg>
                        </span>
                    </button>
                </div>
                <div class="modal-body pt-3">
                    <form class="services_form" id="services_form" method="post" novalidate>
                        <div class="form-row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <div class="d-flex justify-content-between">
                                        <label class="modal-lable form-label">Service Image</label>
                                    </div>
                                    <div class="dropzone dropzone-single dz-clickable dz-max-files-reached" data-toggle="dropzone-image-1" data-dropzone-url="/assets/uploads/upload" data-max-filesizee="800x503">
                                        <div class="fallback">
                                            <div class="custom-file">
                                                <input type="file" class="custom-file-input" id="dropzoneBasicUpload">
                                                <label class="custom-file-label" for="dropzoneBasicUpload"><i class="fad fa-image"></i></label>
                                            </div>
                                        </div>
                                        <div class="dz-preview dz-preview-single">
                                            <div class="dz-preview-cover"> <img class="dz-preview-img" src="" alt="..." data-dz-thumbnail id="appendImage"> </div>
                                        </div>
                                        <div id="dropzone_upload" style="z-index:0" class="dropzone_upload"> <img src=""> </div>
                                    </div>
                                    <input type="hidden" value="" class="image" id="image-1">
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="form-group">
                                    <label>Title <span class="text-danger">*</span></label>
                                    <input type="text" name="title" id="title" class="form-control" required placeholder="Title" maxlength="130">
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label>Description <span class="text-danger">*</span></label>
                                    <textarea class="form-control" name="description" id="description" placeholder="Type your Service description here..." required rows="4" cols="80" maxlength="300"></textarea>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <a href="javascript: void(0);" class="btn btn-bgchecker" type="button" id="manageServiceDetails" onclick="manageServiceDetails(this);" data-module="create">Save</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!--========================= Add Details =====================-->
    <!--========================= Update Details =====================-->
    <div class="modal fade" id="edit-service-modal" role="dialog" aria-labelledby="addsucessModal" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered w-800" role="document">
            <div class="modal-content">
                <div class="modal-header border-0 pb-0">
                    <h6 class="modal-title mb-3" id="modal-title-default">Update Service</h6>
                    <button type="button" class="close w-100 text-right" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">
                            <svg width="17" height="17" viewBox="0 0 22 22" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M19.5312 2.46875L2.46875 19.5312M2.46875 2.46875L19.5312 19.5312" stroke="#000000" stroke-width="4" stroke-linecap="round" stroke-linejoin="round"></path>
                            </svg>
                        </span>
                    </button>
                </div>
                <div class="modal-body pt-3" id="edit-service-modal-body">

                </div>
            </div>
        </div>
    </div>
    <!--========================= Add Details =====================-->

    <body id="app-top">
        <div class="app-wrapper">
            <?php include('../includes/sidebar.php') ?>
            <div class="app-main">
                <?php include('../includes/topbar.php') ?>
                <div class="app-content">
                    <div class="app-content--inner">
                        <div class="pb-4 text-center text-xl-left">
                            <div class="row align-items-center">
                                <div class="col-xl-6">
                                    <div>
                                        <ol class="d-inline-block breadcrumb text-uppercase font-size-xs p-0">
                                            <li class="d-inline-block breadcrumb-item"><a href="/">Dashboard</a></li>
                                            <li class="d-inline-block breadcrumb-item active"><?= $title ?></li>
                                        </ol>
                                        <h5 class="display-3 mt-1 mb-2 font-weight-bold"><?= $title ?></h5>
                                    </div>
                                </div>
                                <div class="col-xl-6 d-flex align-items-center justify-content-start mt-xl-0 justify-content-xl-end">
                                    <div class="mx-auto mx-xl-0 mt-3 btn-wrapper">
                                        <a href="javascript: void(0);" class="btn btn-secondary-orio" data-toggle="modal" data-target="#detailsModal">Add Details</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card card-box mb-3">
                            <div class="card-header">
                                <div class="card-header--title">
                                    <small><?= $title ?></small>
                                </div>
                            </div>
                            <table id="serviceDetailsList" class="nowrap table table-hover" width="100%" services_id="<?= $id ?>">
                                <thead>
                                    <tr>
                                        <th class="text-center">
                                            <b class="th-text-iceburk text-uppercase fs-13 Heebo-Regular">SNO</b>
                                        </th>
                                        <th class="text-center">
                                            <b class="th-text-iceburk text-uppercase fs-13 Heebo-Regular">Title</b>
                                        </th>
                                        <th class="text-center">
                                            <b class="th-text-iceburk text-uppercase fs-13 Heebo-Regular">Image</b>
                                        </th>
                                        <th class="no-sort">
                                            <b class="th-text-iceburk text-uppercase fs-13 Heebo-Regular">Actions</b>
                                        </th>
                                    </tr>
                                </thead>
                            </table>
                        </div>
                    </div>
<?php include('../includes/footer.php'); ?>
<script src="<?= BASE_URL ?>/assets/js/app/service_details.js?v=<?= time() ?>"></script>
<script src="/assets/js/demo/dropzone/init_dropzone.min.js"></script>
                