<?php
$active = "users";
include('header.php');
require_once('config.php');
require_once('User.php');
$user = User::find($_GET['edit_id']);
?>

<main class="container-fluid mt-5">
    <div class="bg-light p-5 rounded">
        <h3>Edit User Data</h3>
        <?php if (!empty($_GET['status']) && $_GET['status'] == "empty") { ?>
            <div class="alert alert-danger" role="alert">
                Must Complete Data !
            </div>
        <?php } ?>
        <form action="user_edit.php" method="post">
            <?php if (!empty($user->id)) { ?>
                <input type="hidden" name="edit_user_id" value="<?= $user->id ?>">
            <?php } ?>
            <div class="row mb-2">
                <div class="col-6">
                    <label for="formControlInput" class="form-label">Name</label>
                    <input required type="text" name="name" class="form-control" id="formControlInput" value="<?= $user->name ?>">
                </div>
                <div class="col-6">
                    <label for="formControlInput" class="form-label">Email</label>
                    <input required type="text" name="email" class="form-control" id="formControlInput" value="<?= $user->email ?>">
                </div>
            </div>
            <div class="row mb-2">
                <div class="col-6">
                    <label for="formControlInput" class="form-label">Mobile </label>
                    <input required type="text" name="mobile" class="form-control" id="formControlInput" value="<?= $user->mobile ?>">
                </div>
                <div class="col-6">
                    <label for="formControlInput" class="form-label">Role</label>
                    <select required name="role" class="form-select" aria-label="Default select">
                        <option value="null">Open this select menu</option>
                        <option <?php if ('admin' == $user->role) echo "selected" ?> value="admin">Admin</option>
                        <option <?php if ('user' == $user->role) echo "selected" ?> value="user">user</option>
                    </select>
                </div>
            </div>
            <div class="d-flex justify-content-end mt-5">
                <button type="submit" class="btn btn-success">Save</button>
            </div>
        </form>
    </div>
</main>

<?php
include('footer.php');
?>