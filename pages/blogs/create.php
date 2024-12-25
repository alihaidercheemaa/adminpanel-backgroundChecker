<?php
    $title = 'Create Blogs';
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
                                <div class="col-xl-8">
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
                                    <small><?= $title ?></small>
                                </div>
                            </div>
                            <div class="card-body">
                                <form class="blogs_form" id="blogs_form" method="post" novalidate>
                                    <div class="form-row">
                                        <div class="col-12">
                                            <div class="card-box">
                                                <div class="card-header px-0 mb-3">
                                                    <div class="card-header--title text-uppercase font-size-lg">
                                                        <b>Blog Information: </b>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <div class="d-flex justify-content-between">
                                                    <label class="modal-lable form-label">Blog Image</label>
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
                                            <div class="form-group">
                                                <label>Slug <span class="text-danger">*</span></label>
                                                <input type="text" name="slug" id="slug" class="form-control" required placeholder="Slug" disabled readonly value="">
                                            </div>
                                            <div class="form-group">
                                                <label>Author <span class="text-danger">*</span></label>
                                                <input type="text" name="author" id="author" class="form-control" required placeholder="Author" maxlength="100">
                                            </div>
                                            <div class="form-group">
                                                <label>Date <span class="text-danger">*</span></label>
                                                <input class="form-control form-control-lg" id="date" data-toggle="datepicker" placeholder="Select date" type="text" autocomplete="off" required>
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label>Short Description <span class="text-danger">*</span></label>
                                                <textarea class="form-control" name="short_content" id="short_content" placeholder="Type your Blog short description here..." required rows="4" cols="80" maxlength="200"></textarea>
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label>Detailed Description <span class="text-danger">*</span></label>
                                                <textarea class="form-control" name="detailed_content" id="detailed_content" placeholder="Type your Blog detailed description here..." required data-ckeditor rows="10" cols="80"></textarea>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <a href="javascript: void(0);" class="btn btn-bgchecker" type="button" id="manageBlogs" onclick="manageBlogs();" data-module="create">Save</a>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
<?php include('../includes/footer.php'); ?>
<script type="text/javascript" src="<?= BASE_URL ?>/assets/js/app/blogs.js?v=<?= time() ?>"></script>
<script src="/assets/js/demo/dropzone/init_dropzone.min.js"></script>