<?php
$active = "categories";
include_once('header.php');
include_once('config.php');
$connect = db_connect();
if (!empty($_GET['edit_category_id'])) {
    $edit_category_id = $_GET['edit_category_id'];
    $get_category_data = "SELECT * FROM `categories` WHERE id =" . $edit_category_id;
    $result_get_data_category = mysqli_query($connect, $get_category_data);
    if ($data = mysqli_fetch_assoc($result_get_data_category)) {
        $edit_category = $data;
    }
}
?>

<!-- Begin page content -->
<main class="flex-shrink-0">
    <div class="container">
        <h1 class="mt-5 text-center">Categories</h1>
        <div class="border p-4 rounded">
            <form action="categories.php" method="post">
                <?php if (isset($edit_category)) { ?>
                    <input type="hidden" value="<?= $edit_category['id'] ?>" name="edit_category_id">
                <?php } ?>
                <div class="row">
                    <h3 class="text-decoration-underline">Add New Category</h3>
                    <?php if (!empty($_GET['status']) && $_GET['status'] == 'empty') { ?>
                        <div class="alert alert-danger" role="alert">
                            <strong>Category Name Is Required</strong>
                        </div>
                    <?php } elseif (!empty($_GET['status']) && $_GET['status'] == 'added') { ?>
                        <div class="alert alert-success" role="alert">
                            <strong>Category Added Successfully</strong>
                        </div>
                    <?php } elseif (!empty($_GET['status']) && $_GET['status'] == 'deleted') { ?>
                        <div class="alert alert-success" role="alert">
                            <strong>Category deleted Successfully</strong>
                        </div>
                    <?php } elseif (!empty($_GET['status']) && $_GET['status'] == 'updated') { ?>
                        <div class="alert alert-success" role="alert">
                            <strong>Category Updated Successfully</strong>
                        </div>
                    <?php } ?>
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label for="name" class="form-label">Name</label>
                            <input type="text" value="<?= isset($edit_category) ? $edit_category['name'] : '' ?>" class="form-control" name="name" id="name" aria-describedby="helpId" placeholder="Category Name">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <?php
                        $sql_of_main_categories = "select * from categories";
                        $result_of_main_categories = mysqli_query($connect, $sql_of_main_categories);
                        ?>
                        <div class="mb-3">
                            <label for="category_id" class="form-label">Main Category</label>
                            <select class="form-select form-select-lg" name="category_id" id="category_id">
                                <option value="null" selected>Select one</option>
                                <?php while ($main_category = mysqli_fetch_assoc($result_of_main_categories)) {
                                    $category_name = $main_category['name'];
                                    $category_id = $main_category['id'];
                                    $is_selected ='';
                                    isset($edit_category) && $category_id == $edit_category['category_id'] ? $is_selected = 'selected' : '';
                                    echo "<option $is_selected value='$category_id'>$category_name</option>";
                                } ?>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="d-flex justify-content-end">
                    <button type="submit" class="btn btn-primary">Save</button>
                </div>
            </form>
        </div>
        <div class="border rounded p-3 mt-3">
            <h3 class="text-center text-decoration-underline">Categories</h3>
            <div class="row">
                <?php
                $sql_show_main_categories = "SELECT * FROM `categories` WHERE category_id is null";
                $result_show_main_categories = mysqli_query($connect, $sql_show_main_categories);
                while ($main_category = mysqli_fetch_assoc($result_show_main_categories)) {
                ?>
                    <div class="col-md-4 mb-3">
                        <div class="card">
                            <div class="card-body">
                                <div class="d-flex justify-content-between">
                                    <div>
                                        <h3 class="card-title"><?= $main_category['name'] ?></h3>
                                    </div>
                                    <div>
                                        <a href="categories_ui.php?edit_category_id=<?= $main_category['id'] ?>">
                                            <i class="fa-solid fa-pen-to-square fa-beat" style="font-size: 18px;"></i>
                                        </a>
                                        <a href="categories.php?category_id=<?= $main_category['id'] ?>">
                                            <i class="fa-solid fa-trash fa-shake" style="color: #f50000;font-size: 18px;"></i>
                                        </a>
                                    </div>
                                </div>
                                <?php
                                $sql_show_sub_categories = "select * from categories where category_id =" . $main_category['id'];
                                $result_show_sub_categories = mysqli_query($connect, $sql_show_sub_categories);
                                while ($sub_category = mysqli_fetch_assoc($result_show_sub_categories)) {
                                    $sub_category_name = $sub_category['name'];
                                ?>
                                    <div class="d-flex justify-content-between">
                                        <div>
                                            <p class='card-text fw-bold text-success'>- <?= $sub_category_name ?></p>
                                        </div>
                                        <div>
                                            <a href="categories_ui.php?edit_category_id=<?= $sub_category['id'] ?>">
                                                <i class="fa-solid fa-pen-to-square fa-beat" style="font-size: 18px;"></i>
                                            </a>
                                            <a href="categories.php?category_id=<?= $sub_category['id'] ?>">
                                                <i class="fa-solid fa-trash fa-shake" style="color: #f50000;font-size: 18px;"></i>
                                            </a>
                                        </div>
                                    </div>
                                <?php } ?>
                            </div>
                        </div>
                    </div>
                <?php } ?>
            </div>
        </div>
    </div>
</main>

<?php
include_once('footer.php');
?>