<?php include 'inc/header.php'; 
require_once 'inc/App.php';?>



<div class="container my-5">

    <div class="row">
    <?php 
if ($request->check($request->get('id'))){
$id=$request->get('id');
$result = $conn->query("select * from product where id = $id");

$product = $result->fetch(PDO::FETCH_ASSOC)
?>

    <div class="col-lg-6">
            <img src="<?php echo $product['image'] ?> " class="card-img-top">
            </div>
            <div class="col-lg-6">
            <h5 ><?php echo $product['name'] ?> </h5>
            <p class="text-muted"><?php echo $product['price'] ?></p>
            <p><?php echo $product['description'] ?></p>
            <a href="index.php" class="btn btn-primary">Back</a>
            <a href="edit.php?id=<?php echo $product['id'] ?>" class="btn btn-info">Edit</a>
            <a href="del.php?id=<?php echo $product['id'] ?>" class="btn btn-danger">Delete</a>
        </div>
        
    </div>
</div>
<?php }?>



<?php include 'inc/footer.php'; ?>