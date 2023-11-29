<?php
$active = 'users';
include_once('header.php');
require_once('config.php');
require_once('User.php');
$user = User::find($_GET['user_id']);
?>

<main class="flex-shrink-0">
    <div class="container bg-light mt-5">
        <h3>Full Details Of Product</h3>
        <div class="card">
            <div class="row g-0">
                <div class="col-5">
                    <div class="card-body">
                        <h2 class="card-title mb-5">Name: <?= $user->name ?></h2>
                        <h2 class="card-title mb-5">Email: <?= $user->email ?></h2>
                        <h2 class="card-title mb-5">mobile: <?= $user->mobile ?></h2>
                        <h2 class="card-title mb-5">role: <?= $user->role ?></h2>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>

<?php
include_once('footer.php');
?>