<?php
$active = "users";
include_once('header.php');
require_once('User.php');
?>

<main class="flex-shrink-0 mt-5">
    <div class="container">
        <?php if (!empty($_GET['status']) && $_GET['status'] == "added") { ?>
            <div class="alert alert-success" role="alert">
                New User Added !
            </div>
        <?php } elseif (!empty($_GET['status']) && $_GET['status'] == "deleted") { ?>
            <div class="alert alert-warning" role="alert">
                User Deleted !
            </div>
        <?php } elseif (!empty($_GET['status']) && $_GET['status'] == "updated") { ?>
            <div class="alert alert-success" role="alert">
                User updated !
            </div>
        <?php } ?>
        <div class="d-flex justify-content-between mb-3">
            <h3>All Users</h3>
            <div>
                <a href="user_add_ui.php" role="button" class="btn btn-secondary">Add New User</a>
            </div>
        </div>
        <table class="table table-hover table-bordered text-center table-primary">
            <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Name</th>
                    <th scope="col">email</th>
                    <th scope="col">mobile</th>
                    <th scope="col">role</th>
                    <th scope="col">Created at</th>
                    <th scope="col">Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $i = 1;
                foreach (User::all() as $user) {
                ?>
                    <tr>
                        <th scope="row"><?= $i++ ?></th>
                        <td><a title="Show Details of User" href="user_details_ui.php?user_id=<?= $user->id ?>" style="text-decoration: none; font-weight: bold;"><?= $user->name ?></a></td>
                        <td><?= $user->email ?></td>
                        <td><?= $user->mobile ?></td>
                        <td><?= $user->role ?></td>
                        <td><?= date_format(date_create($user->created_at), 'F j, Y, g:i a') ?></td>
                        <td>
                            <div class="d-flex justify-content-center ">
                                <a href="user_edit_ui.php?edit_id=<?= $user->id ?>" title="Edit User" class="mt-2">
                                    <i class="fa fa-edit" style="font-size:20px;color:darkblue"></i>
                                </a>
                                <button type="button" class="btn" data-bs-toggle="modal" data-bs-target="#exampleModal<?= $user->id ?>">
                                    <i class="fa fa-trash" style="font-size:20px;color:red"></i>
                                </button>
                                <div class="modal fade" id="exampleModal<?= $user->id ?>" tabindex="-1" aria-labelledby="exampleModalLabel<?= $user->id ?>" aria-hidden="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="exampleModalLabel<?= $user->id ?>">Delete
                                                    Confirmation</h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body">
                                                Are you sure you need to Delete User <?= $user->name ?> ?
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                                                    Close
                                                </button>
                                                <a role="button" href="user_add.php?delete_user_id=<?= $user->id ?>" class="btn btn-danger">Delete</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>
    </div>
</main>

<?php
include_once('footer.php')
?>