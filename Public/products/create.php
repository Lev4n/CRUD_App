<?php
$pdo = require_once '../../DBConn.php';


$errors = [];

$sku = '';
$name = '';
$price = '';
$size = '';
$height = '';
$width = '';
$length = '';
$weight = '';


if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $sku = $_POST['sku'];
    $name = $_POST['name'];
    $price = $_POST['price'];
    $size = $_POST['size'];
    $height = $_POST['height'];
    $width = $_POST['width'];
    $length = $_POST['length'];
    $weight = $_POST['weight'];

    if (!$sku || !$name || !$price) {
        $errors[] = 'Please, submit required data';
    }


    if (empty($errors)) {
        // Checking if SKU already exists
        $statement = $pdo->prepare('SELECT COUNT(*) FROM products WHERE sku = :sku');
        $statement->bindValue(':sku', $sku);
        $statement->execute();
        $count = $statement->fetchColumn();

        if ($count > 0) {
            $errors[] = 'SKU already exists';
        } else {
            // Inserting inputs into products db and binding all values to each other, if everything is okay.
            $statement =  $pdo->prepare("INSERT INTO products (sku, name, price, size, height, width, length, weight)
            VALUES (:sku, :name, :price, :size, :height, :width, :length, :weight)");
            $statement->bindValue(':sku', $sku);
            $statement->bindValue(':name', $name);
            $statement->bindValue(':price', $price);
            $statement->bindValue(':size', $size);
            $statement->bindValue(':height', $height);
            $statement->bindValue(':width', $width);
            $statement->bindValue(':length', $length);
            $statement->bindValue(':weight', $weight);


            $statement->execute();
            header("Location: index.php");
        }
    }
}
?>

<?php require_once '../../Views/Partials/header.php' ?>

<body>

    <nav class="navbar navbar-expand-lg">
        <div class="container">
            <a href="" class="navbar-brand">Product Add</a>

            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse justify-content-md-end" id="navbarNav">
                <div class="d-grid gap-2 d-md-flex">
                    <input form="product_form" type="submit" name="save" value="SAVE" class="btn btn-outline-success">
                    <a href="index.php" type="submit" value="CANCEL" class="btn btn-outline-danger">CANCEL</a>
                </div>
            </div>
        </div>
    </nav>

    <hr>

    <?php if (!empty($errors)) : ?>
        <div class="alert alert-danger">
            <?php foreach ($errors as $error) : ?>
                <div><?php echo $error ?></div>
            <?php endforeach; ?>
        </div>
    <?php endif; ?>

    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" id="product_form" method="post">
        <div class="mt-5">
            <div id="sku" class="row mb-3 col-4">
                <label for="sku" class="col-3 col-form-label">SKU</label>
                <div class="col-9">
                    <input type="text" class="form-control" name="sku" value="<?php echo $sku ?>">
                </div>
            </div>
            <div id="name" class="row mb-3 col-4">
                <label for="name" class="col-3 col-form-label">Name</label>
                <div class="col-9">
                    <input type="text" class="form-control" name="name" value="<?php echo $name ?>">
                </div>
            </div>
            <div id="price" class="row mb-5 col-4">
                <label for="price" class="col-3 col-form-label">Price ($)</label>
                <div class="col-9">
                    <input type="number" class="form-control" name="price" value="<?php echo $price ?>">
                </div>
            </div>
            <div id="productType" class="row mb-3 col-4">
                <label for="productType" class="col-6 col-form-label">Type Switcher</label>
                <div class="col-6">
                    <select class="form-select" name="productType" onchange="showSelectedInput();">
                        <option value="">Type Switcher</option>
                        <option value="DVD">DVD</option>
                        <option value="Furniture">Furniture</option>
                        <option value="Book">Book</option>
                    </select>
                </div>
            </div>
            <div class="inputHide" id="DVD">
                <div id="size" class="row mb-3 col-4">
                    <label for="size" class="col-6 col-form-label">Size (MB)</label>
                    <div class="col-6">
                        <input type="number" class="form-control" name="size" value="<?php echo $size ?>">
                    </div>
                    <p><strong>Please, provide disc space in MB.</strong></p>
                </div>
            </div>
            <div class="inputHide" id="Furniture">
                <div id="height" class="row mb-3 col-4">
                    <label for="height" class="col-6 col-form-label">Height(CM)</label>
                    <div class="col-6">
                        <input type="number" class="form-control" name="height" value="<?php echo $height ?>">
                    </div>
                </div>
                <div id="width" class="row mb-3 col-4">
                    <label for="width" class="col-6 col-form-label">Width(CM)</label>
                    <div class="col-6">
                        <input type="number" class="form-control" name="width" value="<?php echo $width ?>">
                    </div>
                </div>
                <div id="length" class="row mb-3 col-4">
                    <label for="length" class="col-6 col-form-label">Length(CM)</label>
                    <div class="col-6">
                        <input type="number" class="form-control" name="length" value="<?php echo $length ?>">
                    </div>
                </div>
                <p><strong>Please, provide dimensions in HxWxL format.</strong></p>
            </div>
            <div class="inputHide" id="Book">
                <div id="weight" class="row mb-3 col-4">
                    <label for="weight" class="col-6 col-form-label">Weight (KG)</label>
                    <div class="col-6">
                        <input type="text" class="form-control" name="weight" value="<?php echo $weight ?>">
                    </div>
                </div>
                <p><strong>Please, provide weight in KG.</strong></p>
            </div>

        </div>

    </form>
    <script src="../script.js"></script>
</body>
<?php require_once '../../views/partials/footer.php' ?>

</html>