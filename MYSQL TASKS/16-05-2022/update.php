<?php
$db = new PDO('mysql:host=localhost;dbname=products_crud', 'root' , '');
$db->setAttribute(PDO::ATTR_ERRMODE , PDO::ERRMODE_EXCEPTION);

$image = '';
$search = '';
$imageName = $_FILES['image']['name'];
$imagetmp = $_FILES['image']['tmp_name'];
$imageNewPath = 'upload/';
if(!is_dir('upload')){
    mkdir('upload');
}
if ($_FILES['image']['error'] === 0) {
    move_uploaded_file($imagetmp,$imageNewPath . $imageName);
    $image = $imageNewPath . $imageName;
}
// if($_SERVER['REQUEST_METHOD'] == 'GET'){
$id = $_GET['id'];
$title = $_POST['title'];
$description = $_POST['description'];
$price = $_POST['price'];
$statement = $db->prepare("UPDATE products SET `title`=:title,`description`=:description,`image`=:image,`price`=:price WHERE id = :id");
$fetch = $db->prepare("SELECT * FROM products WHERE id=$id");

$statement->bindvalue(':id',$id);
$statement->bindvalue(':title',$title);
$statement->bindvalue(':image',$image);
$statement->bindvalue(':description',$description);
$statement->bindvalue(':price',$price);
$fetch->execute();
$products = $fetch->fetchAll(PDO::FETCH_ASSOC);
$statement->execute();
$product = $products[0];
// }
?>
<!doctype html>
<html lang="en">
  <head>
    <title>Title</title>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS v5.0.2 -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css"  integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <style>
        .update{
            width:200px;
        }
        form{
            display:inline;
        }
    </style>
  </head>
  <body>
      <div class="container">
        <a href="create.php" class="btn btn-success mb-3">Back to products</a>
        <div class="card border-danger" id="add">
            <div class="card-header bg-danger text-white">
                <strong><i class="fa fa-plus"></i> Edit Product <b><?= $product["title"]; ?></b></strong>
            </div>
            <img class='update' src="<?php echo $product['image'];?>" alt="error">
            <div class="card-body">
                <form action="" method="POST" enctype="multipart/form-data">
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="name" class="col-form-label">Title</label>
                            <input type="text" class="form-control" id="title" name="title" placeholder="Name" value='<?= $product["title"]; ?>' required>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="price" class="col-form-label">Price</label>
                            <input type="number" class="form-control" id="price" name="price" step='0.01' placeholder="Price" value='<?= $product["price"]; ?>' required>
                        </div>
                        <div class="form-group col-md-6">
                            <label for="image" class="col-form-label">Image</label>
                            <input type="file" class="form-control" name="image" id="image"  placeholder="Image URL">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="note" class="col-form-label">Description</label>
                        <textarea name="description" id="" rows="5" class="form-control" placeholder="description" value='<?= $product["description"]; ?>'></textarea><br>
                    </div>
                    <button type="submit" class="btn btn-success"><i class="fa fa-check-circle"></i> Save</button>
                </form>
            </div>
        </div>
    <!-- Bootstrap JavaScript Libraries -->
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>
  </body>
</html>