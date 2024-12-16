<!-- file create.php -->
<?php
session_start();
include 'flowers.php';

$error_message = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (
        !empty($_POST['name']) && !empty($_POST['description'])
        && isset($_FILES['image1']) && $_FILES['image1']['size'] > 0
        && isset($_FILES['image2']) && $_FILES['image2']['size'] > 0
    ) {
        $name = $_POST['name'];
        $description = $_POST['description'];

        $image1 = $_FILES['image1'];
        $image2 = $_FILES['image2'];

        $image1Path = 'images/' . time() . basename($image1['name']);
        $image2Path = 'images/' . time() . basename($image2['name']);

        move_uploaded_file($image1['tmp_name'], $image1Path);
        move_uploaded_file($image2['tmp_name'], $image2Path);

        $newId = max(array_column($flowers, 'id')) + 1;

        $flowers[] = [
            'id' => $newId,
            'name' => $name,
            'description' => $description,
            'images' => [$image1Path, $image2Path]
        ];

        file_put_contents('flowers.php', '<?php $flowers = ' . var_export($flowers, true) . ';');
        $_SESSION['success_message'] = 'Thêm mới hoa thành công!';
        header('Location: admin.php');
        exit;
    } else {
        $error_message = 'Vui lòng điền đầy đủ thông tin và tải lên hình ảnh.';
    }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>New Flower</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.1/css/all.min.css" integrity="sha512-5Hs3dF2AEPkpNAR7UiOHba+lRSJNeM2ECkwxUIxC1Q/FLycGTbNapWXB4tP889k5T5Ju8fs4b1P5z/iB4nMfSQ==" crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>

<body>
    <div class="container">
        <div class="row">
            <div class="col-md-4"></div>
            <div class="col-md-4">
                <h1 class="mb-3 mt-5 text-center">Thêm hoa mới</h1>
                <a href="admin.php" class="btn btn-success mb-3">Quay lại</a>

                <?php if (!empty($error_message)) : ?>
                    <div class="alert alert-danger">
                        <?php echo $error_message; ?>
                    </div>
                <?php endif; ?>

                <form method="POST" enctype="multipart/form-data">
                    <div class="mb-3">
                        <label for="name" class="form-label">Tên hoa</label>
                        <input type="text" class="form-control" id="name" name="name">
                    </div>

                    <div class="mb-3">
                        <label for="description" class="form-label">Mô tả</label>
                        <textarea class="form-control" id="description" name="description" rows="5"></textarea>
                    </div>

                    <div class="mb-3">
                        <label for="image1" class="form-label">Ảnh 1</label>
                        <input type="file" class="form-control" id="image1" name="image1" accept="image/*">
                    </div>
                    <div class="mb-3">
                        <label for="image2" class="form-label">Ảnh 2</label>
                        <input type="file" class="form-control" id="image2" name="image2" accept="image/*">
                    </div>

                    <button type="submit" class="btn btn-primary">Lưu hoa</button>
                </form>
            </div>
            <div class="col-md-4"></div>
        </div>

    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>

</html>