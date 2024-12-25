<?php
    if (!isset($_GET['id'])) {
        header('Location: /404');
        exit();
    }
    $id = (int)$_GET['id'];
    $title = 'Update Industries';
    include('../includes/header.php');
    $url = API_URL . "industries/details";
    $request = ["id" => (int)$id];
    $response = curlFunction($url, $request, '', '', 'POST', '1');
    if ($response->status == 1) {
        $details = $response->payload;
    } else {
        header('Location: /404');
        exit();
    }
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
                                <form class="industries_form" id="industries_form" method="post" novalidate> 
                                    <div class="form-row">
                                        <div class="col-12">
                                            <div class="card-box">
                                                <div class="card-header px-0 mb-3">
                                                    <div class="card-header--title text-uppercase font-size-lg">
                                                        <b>Industry Information: </b>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <div class="d-flex justify-content-between">
                                                    <label class="modal-lable form-label">Industry Image</label>
                                                </div>
                                                <div class="dropzone dropzone-single dz-clickable dz-max-files-reached" data-toggle="dropzone-image-1" data-dropzone-url="/assets/uploads/upload" data-max-filesizee="1024x1024">
                                                    <div class="fallback">
                                                        <div class="custom-file">
                                                            <input type="file" class="custom-file-input" id="dropzoneBasicUpload">
                                                            <label class="custom-file-label" for="dropzoneBasicUpload"><i class="fad fa-image"></i></label>
                                                        </div>
                                                    </div>
                                                    <div class="dz-preview dz-preview-single">
                                                        <div class="dz-preview-cover">
                                                            <img class="dz-preview-img" src="/assets/uploads/<?= $details->image; ?>" alt="..." data-dz-thumbnail>
                                                        </div>
                                                    </div>
                                                    <div id="dropzone_upload" style="z-index:0" class="dropzone_upload">
                                                        <img src="/assets/uploads/<?= $details->image; ?>">
                                                    </div>
                                                </div>
                                                <input type="hidden" value="<?= $details->image; ?>" class="image" id="image-1">
                                            </div>
                                        </div>
                                        <div class="col-6">
                                            <div class="form-group">
                                                <label>Title <span class="text-danger">*</span></label>
                                                <input type="text" name="title" id="title" class="form-control" required placeholder="Title" value="<?= $details->title ?>" maxlength="130">
                                            </div>
                                        </div>
                                        <div class="col-6">
                                            <div class="form-group">
                                                <label>Slug <span class="text-danger">*</span></label>
                                                <input type="text" name="slug" id="slug" class="form-control" required placeholder="Slug" disabled readonly value="<?= $details->slug ?>">
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label>Short Description <span class="text-danger">*</span></label>
                                                <textarea class="form-control" name="description" id="description" placeholder="Type your Industry short description here..." required rows="4" cols="80" maxlength="200"><?= $details->description ?></textarea>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <a href="javascript: void(0);" class="btn btn-bgchecker" type="button" id="manageIndustries" onclick="manageIndustries();" data-module="update" industries_id="<?= $details->id ?>">Save</a>  
                                    </div>
                                </form>
                        </div>
                    </div>
                </div>
                <?php include('../includes/footer.php'); ?>
                <script type="text/javascript" src="<?= BASE_URL ?>/assets/js/app/industries.js?v=<?= time() ?>"></script>
                <script src="/assets/js/demo/dropzone/init_dropzone.min.js"></script>