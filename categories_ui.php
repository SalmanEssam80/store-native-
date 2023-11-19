<?php
include_once('header.php');
include_once('config.php');
?>

<!-- Begin page content -->
<main class="flex-shrink-0">
    <div class="container">
        <h1 class="mt-5 text-center">Categories</h1>
        <div class="border p-4 rounded">
            <form action="categories.php" method="post">
                <div class="row">
                    <h3 class="text-decoration-underline">Add New Category</h3>
                    <?php if (!empty($_GET['status']) && $_GET['status'] == 'empty') { ?>
                        <div class="alert alert-danger" role="alert">
                            <strong>Category Name Is Required</strong>
                        </div>
                    <?php } elseif (!empty($_GET['status']) && $_GET['status'] == 'added') {?>
                        <div class="alert alert-success" role="alert">
                            <strong>Category Added Successfully</strong>
                        </div>
                    <?php }?>
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label for="name" class="form-label">Name</label>
                            <input type="text" class="form-control" name="name" id="name" aria-describedby="helpId" placeholder="Category Name">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label for="category_id" class="form-label">Main Category</label>
                            <select class="form-select form-select-lg" name="category_id" id="category_id">
                                <option selected>Select one</option>
                                <option value="">New Delhi</option>
                                <option value="">Istanbul</option>
                                <option value="">Jakarta</option>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="d-flex justify-content-end">
                    <button type="submit" class="btn btn-primary">Save</button>
                </div>
            </form>
        </div>
    </div>
</main>

<?php
include_once('footer.php');
?>