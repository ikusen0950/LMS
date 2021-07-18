<div id="card_profile">
    <div class="card">
        <!-- <div class="card-header">
            <div class="row">
                <div class="col-md-4">
                    <h2></h2>
                </div>
            </div>
        </div> -->
        <div class="card-body" style="padding:0">
            <div class="container">
                <div class="row">
                    <div class="col-md-5 bg_darkblue py-5">
                        <h2 class="text-center text-white mb-4" style="font-size: 45px"><?= $title ?></h2>
                        <img src="<?= base_url('img/profile/' . $user['image']) ?>" class="mx-auto d-block" alt="" style="width:280px;height:280px;border-radius:50%;object-fit:cover;object-postition:center;">
                        <h2 class="text-center text-white mt-3">
                            <?php if ($user['first_name'] == '') {
                                echo $user['username'];
                            } else {
                                echo '<span class="text-capitalize">' . $user['firstname'] . ' ' . $user['lastname'] . '</span>';
                            } ?>
                        </h2>
                    </div>
                    <div class="col-md-7 p-5">
                        <div class="row">
                            <div class="col-md-6 mt-3">
                                <h3>Username</h3>
                                <p id="username"><?= $user['username'] ?></p>
                            </div>
                            <div class="col-md-6 mt-3">
                                <h3>Email</h3>
                                <p id="email"><?= $user['email'] ?></p>
                            </div>
                            <div class="col-md-6 mt-3">
                                <h3>User Id</h3>
                                <p id="users_uid"><?= $user['users_uid'] ?></p>
                            </div>
                            <div class="col-md-6 mt-3">
                                <h3>Role</h3>
                                <p class="text-capitalize">
                                    <?php if ($user['group_id'] == 2) : ?>
                                        <?= 'User' ?>
                                    <?php else : ?>
                                        <?= 'Admin' ?>
                                    <?php endif ?>
                                </p>
                            </div>
                        </div>
                        <hr>
                        <button id="<?= $user['userid'] ?>" class="btn btn-success mt-3 mx-auto edit_user"><i class="fas fa-edit"></i> Edit</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>