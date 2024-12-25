<?php
$title = 'Packages';
include('../includes/header.php');
?>

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
                        </div>
                    </div>
                    <div class="card card-box mb-3">
                        <div class="card-header">
                            <div class="card-header--title">
                                <small><?= $title ?> List</small>
                            </div>
                        </div>
                        <section class="py-4">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <div class="d-flex justify-content-between">
                                        <label class="modal-lable form-label">Packages Image</label>
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
                            <div class="col-md-12 text-start">
                                <a href="javascript: void(0);" class="btn btn-bgchecker" onclick="managePackages()">Upload</a>
                            </div>
                        </section>
                        <hr>

                        <table id="packageList" class="nowrap table table-hover" width="100%">
                            <thead>
                                <tr>
                                    <th class="text-center">
                                        <b class="th-text-iceburk text-uppercase fs-13 Heebo-Regular">SNO</b>
                                    </th>
                                    <th class="text-center">
                                        <b class="th-text-iceburk text-uppercase fs-13 Heebo-Regular">Image</b>
                                    </th>
                                    <th class="text-center">
                                        <b class="th-text-iceburk text-uppercase fs-13 Heebo-Regular">Status</b>
                                    </th>
                                    <th class="text-center no-sort">
                                        <b class="th-text-iceburk text-uppercase fs-13 Heebo-Regular">Action</b>
                                    </th>
                                </tr>
                            </thead>
                        </table>
                    </div>
                </div>
                <?php include('../includes/footer.php'); ?>
                <script src="<?= BASE_URL ?>/assets/js/app/packages.js?v=<?= time() ?>"></script>
                <script src="/assets/js/demo/dropzone/init_dropzone.min.js"></script>