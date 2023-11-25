<?php
$active = 'home';
include_once('header.php')
?>

<!-- Begin page content -->
<main class="flex-shrink-0">
    <div class="container">
        <h1 class="mt-5 text-center"><?=$lang['Welcome']?> <?=$_SESSION['user']['name']?> <?=$lang['To Our Store']?></h1>
        <h5 class="mt-5 text-center"><?=$lang['Your_Mail_Is:']?> <?=$_SESSION['user']['email']?></h5>
    </div>
</main>

<?php
include_once('footer.php')
?>