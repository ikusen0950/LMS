<!doctype html>
<html lang="en">

    <body>
    
        <!-- ============================================================== -->
        <!-- Start right Content here -->
        <!-- ============================================================== -->
        <div class="main-content">

            <div class="page-content">
                <div class="container-fluid">

                    <!-- start page title -->
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box d-flex align-items-center justify-content-between">
                        <h4 class="mb-0">Profile</h4>

                        <div class="page-title-right">
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item"><a href="javascript: void(0);">LMS</a></li>
                                <li class="breadcrumb-item active">Profile</li>
                            </ol>
                        </div>

                    </div>

                    <div class="row mb-4">
                        <div class="col-xl-4">
                            <div class="card h-100">
                                <div class="card-body">
                                    <div class="text-center">
                                        <a name="edit_status" id="<?= $user['userid'] ?>" class="px-3 text-primary float-end edit_user"><i class="uil uil-pen font-size-15"></i> Edit</a>
                                        <div class="clearfix"></div>
                                        <div>
                                            <img src="<?= base_url('img/profile/' . $user['image']) ?>" alt="" style="width:200px;height:200px;" class="rounded-circle img-thumbnail">
                                        </div>
                                        <h5 class="mt-3 mb-1"><?php if ($user['first_name'] == '') {
                                            echo $user['username'];
                                        } else {
                                            echo '<span class="text-capitalize">' . $user['first_name'] . ' ' . $user['last_name'] . '</span>';
                                        } ?></h5>
                                        <p class="text-muted"><?= $user['designation'] ?></p>
                                    </div>

                                    <hr class="my-4">

                                    <div class="text-muted">
                                        <image style="width:10px;height:10px;" src="img/res/quote-left.svg">                                        
                                        <p class="text-center mt-2"><?= $user['description'] ?></p>
                                        <image align="right" style="width:10px;height:10px;" src="img/res/quote-right.svg">                      
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-xl-8">
                            <div class="card p-4">

                                <div>
                                    <div class="table-responsive mt-4">
                                        <div>
                                            <p class="mb-1">User # :</p>
                                            <h5 class="font-size-15"><?= $user['users_uid'] ?></h5>
                                        </div>
                                        <div class="mt-4">
                                            <p class="mb-1">E-mail :</p>
                                            <h5 class="font-size-15"><?= $user['email'] ?></h5>
                                        </div>
                                        <div class="mt-4">
                                            <p class="mb-1">Username :</p>
                                            <h5 class="font-size-15"><?= $user['username'] ?></h5>
                                        </div>
                                        <div class="mt-4">
                                            <p class="mb-1">Role :</p>
                                            <h5 class="badge bg-pill bg-soft-success font-size-15">
                                                <?php if ($user['group_id'] == 1) : ?>
                                                    <?= 'Super Admin' ?>
                                                <?php elseif ($user['group_id'] == 2) : ?>
                                                    <?= 'User' ?>
                                                <?php elseif ($user['group_id'] == 3) : ?>
                                                    <?= 'Librarian' ?>
                                                <?php elseif ($user['group_id'] == 4) : ?>
                                                    <?= 'Teacher' ?>
                                                <?php elseif ($user['group_id'] == 5) : ?>
                                                    <?= 'Student' ?>
                                                <?php endif ?>
                                            </h5>
                                        </div>
                                        
                                    </div>
                                </div>
                        
                            </div>
                        </div>

                    </div>                   
                    

                </div>

                <!-- Profile Edit Modal -->
                <div class="modal fade" id="editProfileModal" class="modal hide" data-backdrop="static" data-keyboard="false" tabindex="-1000" role="dialog" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel">Edit Profile</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <form method="post" id="user_form_edit">
                                <?= csrf_field() ?>
                                    <div class="modal-content">
                                        <!-- Modal body -->
                                        <div class="modal-body">
                                            <div>
                                                <div  align="center" class="form-group">                                                    
                                                    <div class="col-md-8">
                                                        <div id="image-preview">
                                                            <img id="user_img" src='img/profile/<?= $user['image'] ?>' class='rounded-circle img-thumbnail'  style="width:170px;height:170px;">
                                                        </div>
                                                        <label class="col-md-5 mt-2 text-right">Profile Picture</label>
                                                        <input class="float-center" type="file" name="image" id="user_image_edit" />
                                                        <small class="text-muted float-start">Only .jpg and .png is allowed!</small><br />
                                                        <span id="error_user_image_edit" class="text-danger"></span>
                                                        
                                                    </div>
                                                </div> 
                                            </div>
                                            <div>
                                                <label class="col-md-5 text-right mt-2">First Name</label>
                                                <div class="col">
                                                    <input type="text" name="first_name" id="first_name_edit" class="form-control" />
                                                    <span id="error_first_name_edit" class="text-danger"></span>
                                                </div> 
                                            </div>
                                    
                                            <div>
                                                <label class="col-md-5 text-right  mt-2">Last Name</label>
                                                <div class="col">
                                                    <input type="text" name="last_name" id="last_name_edit" class="form-control" />
                                                    <span id="error_last_name_edit" class="text-danger"></span>
                                                </div>
                                            </div>

                                            <div>
                                                <label   label class="col-md-5 text-right  mt-2">Username</label>
                                                <div class="col">
                                                    <input type="text" name="username" id="username_edit" class="form-control" />
                                                    <span id="error_username_edit" class="text-danger"></span>
                                                </div>
                                            </div>

                                            <div>
                                                <label class="col-md-5 text-right  mt-2">Email</label>
                                                <div class="col">
                                                    <input type="text" name="email" id="email_edit" class="form-control" />
                                                    <span id="error_email_edit" class="text-danger"></span>
                                                </div>
                                            </div>

                                        </div>

                                        <!-- Modal footer -->
                                        <div class="modal-footer">                    
                                            <input type="hidden" name="id" id="user_id_edit" value="">
                                            <input type="hidden" name="hidden_user_image" id="hidden_user_image" value="<?= $user['image'] ?>">
                                            <input type="submit" name="button_action" id="button_action_edit" class="btn btn-primary float-ends" value="Update" />
                                        </div>

                                    </div>       
                                </form>                     
                            </div>
                        </div>
                    </div>
                </div>                  
                <!-- End Profile Edit Modal -->               

            </div>
            <!-- end page title -->
            </div> <!-- container-fluid -->
        </div>
        <!-- End Page-content -->
    
    </body>
    
</html>

<script>
    const inputFile = document.querySelector('#user_image_edit');
    const previewContainer = document.querySelector('#image-preview');
    const previewImage = previewContainer.querySelector('#user_img');

    inputFile.addEventListener("change", function() {
        const file = this.files[0];
        if (file) {
            const reader = new FileReader();

            reader.addEventListener("load", function() {
                previewImage.setAttribute("src", this.result);
            });
            reader.readAsDataURL(file);
        }
    })

    // function fetchCardProfile() {
    //     $.ajax({
    //         url: "<?= base_url('profile/fetch_single') ?>",
    //         method: "post",
    //         dataType: "json",
    //         success: function(res) {
    //             console.log(res.data)
    //             $('#card_profile').html(res.data)
    //         }
    //     })
    // }

    function clearField() {
        $('#username_edit').val('')
        $('#email_edit').val('')
        $('#first_name_edit').val('')
        $('#last_name_edit').val('')
        $('#user_image_edit').val('')

        $('#error_username_edit').text('')
        $('#username_edit').removeClass('is-invalid')
        $('#error_email_edit').text('')
        $('#email_edit').removeClass('is-invalid')
        $('#error_first_name_edit').text('')
        $('#first_name_edit').removeClass('is-invalid')
        $('#error_last_name_edit').text('')
        $('#last_name_edit').removeClass('is-invalid')
        $('#error_user_image_edit').text('')
        $('#image_edit').removeClass('is-invalid')
    }

    $(document).ready(function() {
        //fetchCardProfile()
        var user_id = '';
        $(document).on('click', '.edit_user', function() {
            clearField()
            user_id = $(this).attr('id');
            $.ajax({
                url: "<?= base_url('profile/fetch_edit') ?>",
                type: "POST",
                data: {
                    user_id: user_id
                },
                dataType: "json",
                success: function(res) {
                    // $('#formModalEdit').modal('show')
                    $('#editProfileModal').appendTo("body").modal('show');
                    $('#username_edit').val(res.username)
                    $('#email_edit').val(res.email)
                    $('#first_name_edit').val(res.first_name)
                    $('#last_name_edit').val(res.last_name)
                    $('#user_id_edit').val(res.id)
                }
            })
        })

        $('#user_form_edit').on('submit', function(e) {
            e.preventDefault()
            $.ajax({
                url: "<?= base_url('profile/update_user') ?>",
                method: "POST",
                data: new FormData(this),
                dataType: "json",
                contentType: false,
                processData: false,
                beforeSend: function() {
                    $('#button_action').val('Validate...');
                    $('#button_action').attr('disabled', 'disabled');
                },
                success: function(res) {
                    if (res.success) {
                        $('#alert_message').html(`<div class="alert alert-success">${res.success}</div>`);
                        $('#editProfileModal').modal('hide');
                        setTimeout(() => {
                            $('#alert_message').html('');
                        }, 5000)
                        location.reload();
                        clearField()
                        //fetchCardProfile()
                    }
                    if (res.error) {
                        if (res.error.error_username) {
                            $('#error_username_edit').text(res.error.error_username)
                            $('#username_edit').addClass('is-invalid')
                        } else {
                            $('#error_username_edit').text('')
                            $('#username_edit').removeClass('is-invalid')
                        }
                        if (res.error.error_email) {
                            $('#error_email_edit').text(res.error.error_email)
                            $('#email_edit').addClass('is-invalid')
                        } else {
                            $('#error_email_edit').text('')
                            $('#email_edit').removeClass('is-invalid')
                        }
                        if (res.error.error_first_name) {
                            $('#error_first_name_edit').text(res.error.error_first_name)
                            $('#first_name_edit').addClass('is-invalid')
                        } else {
                            $('#error_first_name_edit').text('')
                            $('#first_name_edit').removeClass('is-invalid')
                        }
                        if (res.error.error_last_name) {
                            $('#error_last_name_edit').text(res.error.error_last_name)
                            $('#last_name_edit').addClass('is-invalid')
                        } else {
                            $('#error_last_name_edit').text('')
                            $('#last_name_edit').removeClass('is-invalid')
                        }
                        if (res.error.error_image) {
                            $('#error_user_image_edit').text(res.error.error_image)
                            $('#image_edit').addClass('is-invalid')
                        } else {
                            $('#error_user_image_edit').text('')
                            $('#image_edit').removeClass('is-invalid')
                        }

                    }
                }
            })
        });
    })
</script>