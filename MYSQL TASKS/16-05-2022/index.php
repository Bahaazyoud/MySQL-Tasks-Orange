<?php
    $db = new PDO('mysql:host=localhost;dbname=products_crud', 'root' , '');
    $db->setAttribute(PDO::ATTR_ERRMODE , PDO::ERRMODE_EXCEPTION);
    $statement = $db->prepare('SELECT * FROM products ORDER BY create_date DESC');
    if($_SERVER["REQUEST_METHOD"] == 'POST'){
      $search = $_POST['search'];
      $statement = $db->prepare("SELECT * FROM products WHERE title LIKE '%$search%' ORDER BY create_date DESC");
    }
    $statement->execute();
    $products = $statement->fetchAll(PDO::FETCH_ASSOC);
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
    <link rel="stylesheet" href="style.css">
    <style>
      .part-1:hover{
        transform: scale(1.05,1.05) rotate(3deg);
        transition: all 0.4s;
      }
      .product-description{
        overflow: hidden;
        word-break: break-all;
        
      }
      .full_description{
        display:none;
      }
      .product-price{
        display:block !important;
      }
    </style>
  </head>
  <body>
    
<section class="section-products">
		<div class="container">
				<div class="row justify-content-center text-center">
						<div class="col-md-8 col-lg-6">
								<div class="header">
										<h3>Featured Product</h3>
										<h2>Popular Products</h2>
								</div>
						</div>
				</div>
				<div class="row">
            <form action="" method="POST">
              <input type="search" name="search" id="search">
              <input type="submit" value="Search" >
            </form>
                    <?php foreach($products as $i => $product): ?>
                        <!-- Single Product -->
						<div class="col-md-6 col-lg-4 col-xl-3">
								<div id="product-4" class="single-product">
										<div class="part-1" style="background: url('<?php echo $product['image']; ?>') no-repeat center; background-size: cover; ">
												<span class="new">new</span>
												<ul>
														<li><a href="#"><i class="fas fa-heart"></i></a></li>
														<li><a href="#"><i class="fa-solid fa-cart-plus"></i></a></li>
												</ul>
										</div>
										<div class="part-2">
												<h3 class="product-title"><?php echo $product['title']; ?></h3>
												<h4 class="product-price"><?php echo $product['price']; ?></h4>
                        <p  class="product-description"><?php echo substr($product['description'], 0, 30); ?>...</p>
                        <p class="full_description" ><?php echo $product['description'];?></p>
                        <button class="btn btn-outline-primary seemore">See more</button>
										</div>
								</div>
						</div>
                        <!-- Single Product -->
                        <?php endforeach; ?>
				</div>
		</div>
</section>
    <!-- Bootstrap JavaScript Libraries -->
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>
    <script src="https://kit.fontawesome.com/3509c2808e.js" crossorigin="anonymous"></script>
    <script src="main.js"></script>
  </body>
</html>