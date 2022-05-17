<?php 
    $db = new PDO('mysql:host=localhost;dbname=products_crud', 'root' , '');
    $db->setAttribute(PDO::ATTR_ERRMODE , PDO::ERRMODE_EXCEPTION);
    $image = '';
    $search = '';
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
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
        $title = $_POST['title'];
        $description = $_POST['description'];
        $price = $_POST['price'];
        $create_date = date('Y-m-d H:i:s');
        $statement = $db->prepare("INSERT INTO products (title,description,image,price,create_date) VALUES (:title,:description,:image,:price,:create_date)");
        $statement->bindvalue(':title',$title);
        $statement->bindvalue(':image',$image);
        $statement->bindvalue(':description',$description);
        $statement->bindvalue(':price',$price);
        $statement->bindvalue(':create_date',$create_date);
        $statement->execute();
    }
    $fetch = $db->prepare('SELECT * FROM products ORDER BY create_date DESC');
    if($_SERVER["REQUEST_METHOD"] == 'GET'){
        $search = $_GET['search'];
        $fetch = $db->prepare("SELECT * FROM products WHERE title LIKE '%$search%' ORDER BY create_date DESC");
      }
    $fetch->execute();
    $products = $fetch->fetchAll(PDO::FETCH_ASSOC);
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
        .pic{
            width:50px;
        }
        form{
            display:inline;
        }
    </style>
  </head>
  <body>
  <div class="container">
        <div class="card border-danger" id="add">
            <div class="card-header bg-danger text-white">
                <strong><i class="fa fa-plus"></i> Add New Product</strong>
            </div>
            <div class="card-body">
                <form action="" method="POST" enctype="multipart/form-data">
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="name" class="col-form-label">Title</label>
                            <input type="text" class="form-control" id="title" name="title" placeholder="Name" required>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="price" class="col-form-label">Price</label>
                            <input type="number" class="form-control" id="price" name="price" step='0.01' placeholder="Price" required>
                        </div>
                        <div class="form-group col-md-6">
                            <label for="image" class="col-form-label">Image</label>
                            <input type="file" class="form-control" name="image" id="image" placeholder="Image URL">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="note" class="col-form-label">Description</label>
                        <textarea name="description" id="" rows="5" class="form-control" placeholder="description"></textarea><br>
                    </div>
                    <button type="submit" class="btn btn-success"><i class="fa fa-check-circle"></i> Save</button>
                </form>
            </div>
        </div>
        <br>
                <!-- Table Product -->
                <div class="card border-danger" id="products">
                    <div class="card-header bg-danger text-white">
                        <strong><i class="fa fa-database"></i> Products</strong>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-12">
                                <h5 class="card-title float-left">Table Products</h5>
                                <a href="#" class="btn btn-success float-right mb-3"><i class="fa fa-plus"></i> Add New</a>
                            </div>
                        </div>
                        <form action="" method="GET">
                            <input type="search" class="form-control form-control-sm ml-3 w-75 d-inline" placeholder='Search' name="search" id="search" value = "<?php echo $search?>">
                            <input class="btn btn-sm btn-outline-success mb-1 ml-3 " type="submit" value="Search" >
                        </form>
                        <table class="table table-bordered table-striped col-md">
                            <thead>
                                <tr>
                        <th>ID</th>
                        <th>Image</th>
                        <th class = "display">Product Title</th>
                        <th>Description</th>
                        <th>Price</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <?php if($products){?>
                    <?php foreach($products as $i => $product):?>
                        <tbody>
                        <tr>
                            <td><?php echo $i +1 ;?></td>
                            <td class ='picture<?php echo $i+1;?>' ><img class='pic' src="<?php echo $product['image'];?>" alt="error"></td>
                            <td class ='display' ><?php echo $product['title'];?></td>
                            <td><?php echo  substr($product['description'], 0, 90);?>...</td>
                            <td class ='display' ><?php echo $product['price'];?></td>
                            <td>
                                <form action="update.php" method="GET">
                                    <input type="hidden" name="id"  value="<?php echo $product['id'];?>">
                                    <input type="submit" class="btn btn-sm btn-outline-primary" value="Edit">
                                </form>
                                <form action="delete.php" method="POST">
                                    <input type="hidden" name="id"  value="<?php echo $product['id'];?>">
                                    <input type="submit" class="btn btn-sm btn-outline-danger" value="Delete">
                                </form>
                            </td>
                        </tr>
                    </tbody>
                    <?php endforeach;?>
                    <?php 
                    }else{
                        echo "<h1> No products found </h1>";
                    }
                ?>
            </table>
        </div>
      </div>
        <!-- End create form -->
    <!-- Bootstrap JavaScript Libraries -->
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>
  </body>
</html>