<?php
$active = "users";
include_once('header.php')
?>

<main class="flex-shrink-0 mt-5">
    <div class="container bg-light">
        <h3>Added New User</h3>
        <?php if (!empty($_GET['info']) && $_GET['info'] == "empty") { ?>
            <div class="alert alert-danger" role="alert">
                Must Complete Data !
            </div>
        <?php  } ?>
        <form action="user_add.php" method="post">
            <div class="row mb-2">
                <div class="col-6">
                    <label for="formControlInput" class="form-label">Name</label>
                    <input required name="name" type="text" class="form-control" id="formControlInput">
                </div>
                <div class="col-6">
                    <label for="formControlInput" class="form-label">email</label>
                    <input required name="email" type="text" class="form-control" id="formControlInput">
                </div>
                <div class="col-6">
                    <label for="formControlInput" class="form-label">password</label>
                    <input required name="password" type="password" class="form-control" id="formControlInput">
                </div>
                <div class="col-6">
                    <label for="formControlInput" class="form-label">mobile</label>
                    <input required name="mobile" type="text" class="form-control" id="formControlInput">
                </div>
                <div class="col-6">
                    <label for="formControlInput" class="form-label">role</label>
                    <select required name="role" class="form-select" aria-label="Default select">
                        <option value="null">open this select menu</option>
                        <option value="admin">Admin</option>
                        <option value="user">User</option>
                    </select>
                </div>
            </div>
            <div class="d-flex justify-content-end mt-5">
                <button type="submit" class="btn btn-success">save</button>
            </div>
        </form>
    </div>
</main>

<?php
include_once('footer.php')
?>