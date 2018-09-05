<?php
require_once $_SERVER['DOCUMENT_ROOT'].'/tutorial/core/init.php';
include 'includes/head.php';
include 'includes/navigation.php';
if(isset($_GET['add'])){
$brandQuery = $db->query("SELECT * FROM brand ORDER BY brand");
$parentQuery = $db->query("SELECT * FROM categories WHERE parent = 0 ORDER BY category");
if($_POST){
  if(!empty($_POST['sizes'])){
    $sizeString = sanitize($_POST['sizes']);
    $sizeString = rtrim($sizeString,',');
    $sizesArray = explode(',',$sizesString);
    $sArray = array();
    $qArray = array();
    foreach($sizesArray as $ss){
      $s = explode(':',$ss);
      $sArray[] = $s[0];
      $qArray[] = $s[1];
    }
  }else{$sizesArray = array();}
}
?>
  <h2 class="text-center">Add New Product</h2><hr>
  <form class="" action="products.php?add=1" method="post" enctype="multipart/form-data">
    <div class="form-group col-md-3">
      <label for="titel">Title*:</label>
      <input type="text" name="title" class="form-control" id="title" value="<?=((isset($_POST['titel']))?sanitize($_POST['titel']):'');?>">
    </div>
    <div class="form-group col-md-3">
      <label for="brand">Brand*:</label>
      <select class="form-control" id="brand" name="brand">
        <option value=""<?=((isset($_POST['brand']) && $_POST['brand'] == '')?'selected':'');?>></option>
        <? while ($brand = mysqli_fetch_assoc($brandQuery)): ?>
          <option value="<?=$brand['id'];?>"<?=((isset($_POST['brand']) && $_POST['brand'] == $brand['id'])?'selected':'');?>><?=$brand['brand'];?></option>
        <? endwhile;?>
      </select>
    </div>
    <div class="form-group col-md-3">
      <label for="parent">Parent Category*:</label>
      <select class="form-control" id="parent" name="parent">
        <option value="" <?=((isset($_POST['parent']) && $_POST['parent'] == '')?'selected':'')?>></option>
        <? while($parent = mysqli_fetch_assoc($parentQuery)):?>
        <option value="<?=$parent['id'];?>"<?=((isset($_POST['parent']) && $_POST['parent'] == $parent['id'])?'selected':'');?>><?=$parent['category'];?></option>
        <? endwhile;?>
      </select>
    </div>
    <div class="form-group col-md-3">
      <label for="child">Child Category*:</label>
      <select class="form-control" id="child" name="child">
      </select>
    </div>
    <div class="form-group col-md-3">
      <label for="price">Price*:</label>
      <input type="text" id="price" name="price" value="<?=((isset($_POST['price']))?sanitize($_POST['price']):'');?>" class="form-control">
    </div>
    <div class="form-group col-md-3">
      <label for="price">List Price*:</label>
      <input type="text" id="list_price" name="list_price" value="<?=((isset($_POST['list_price']))?sanitize($_POST['list_price']):'');?>" class="form-control">
    </div>
    <div class="form-group col-md-3">
      <label for="">Quantity & Sizes*:</label>
      <button type="button" class="btn btn-default form-control" onclick="jQuery('#sizesModal').modal('toggle');return false" name="button">Quantity & Sizes</button>
    </div>
    <div class="form-group col-md-3">
      <label for="sizes">Sizes & Qty Preview</label>
      <input type="text" class="form-control" name="sizes" id="sizes" value="<?=((isset($_POST['sizes']))?$_POST['size']:'');?>" readonly>
    </div>
    <div class="form-group col-md-6">
      <label for="photo">Product Photo:</label>
      <input type="file" name="photo" id="photo" class="form-control" value="">
    </div>
    <div class="form-group col-md-6">
      <label for="description">Description:</label>
      <textarea name="description" id="description" class="form-control" rows="6"><?=((isset($_POST['description']))?sanitize($_POST['description']):'')?></textarea>
    </div>
    <div class="form-group pull-right">
      <input type="submit" name="" value="Add Product" class="form-control btn btn-success">
    </div>
    <div class="clearfix">

    </div>
  </form>

<!-- Modal -->
<div class="modal fade" id="sizesModal" tabindex="-1" role="dialog" aria-labelledby="sizesmyModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="sizesModalLabel">Size & Quantity</h4>
      </div>
      <div class="modal-body">
        <div class="container-fluid">
        <? for($i=1;$i<=12;$i++):?>
        <div class="form-group col-md-4">
          <label for="sizes<?=$i;?>">Size</label>
          <input type="text" name="size<?=$i;?>" id="size<?=$i;?>" value="<?=((!empty($sArray[$i-1]))?$sArray[$i-1]:'');?>" class="form-control">
        </div>
        <div class="form-group col-md-2">
          <label for="qty<?=$i;?>">Quantity</label>
          <input type="number" name="qty<?=$i;?>" id="qty<?=$i;?>" value="<?=((!empty($qArray[$i-1]))?$qArray[$i-1]:'');?>" min="0" class="form-control">
        </div>
      <? endfor;?>
      </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary" onclick="updateSizes();jQuery('#sizesModal').modal('toggle');return false;">Save changes</button>
      </div>
    </div>
  </div>
</div>
<?
}else{
$sql = "SELECT * FROM products WHERE deleted = 0";
$presults = $db->query($sql);
if (isset($_GET['featured'])) {
    $id = (int)$_GET['id'];
    $featured = (int)$_GET['featured'];
    $featuredSql = "UPDATE products SET featured = '$featured' WHERE id = '$id'";
    $db->query($featuredSql);
    header('Location: products.php');
}
?>
<h2 class="text-center">Products</h2>
<a href="products.php?add=1" class="btn btn-success pull-right" id="add-product-btn">Add Product</a>
<div class="clearfix">

</div>
<hr>
<table class="table table-bordered table-condensed table-striped">
  <thead>
    <th></th>
    <th>Product</th>
    <th>Price</th>
    <th>Category</th>
    <th>Featured</th>
    <th>Sold</th>
  </thead>
  <tbody>
    <?php while ($product = mysqli_fetch_assoc($presults)):
      $childID = $product['categories'];
      $catSql = "SELECT * FROM categories WHERE id = '$childID'";
      $result = $db->query($catSql);
      $child = mysqli_fetch_assoc($result);
      $parentID = $child['parent'];
      $pSql = "SELECT * FROM categories WHERE id = '$parentID'";
      $presult = $db->query($pSql);
      $parent = mysqli_fetch_assoc($presult);
      $category = $parent['category'].'~'.$child['category'];
      ?>
      <tr>
        <td>
          <a href="products.php?edit=<?=$product['id'];?>" class="btn btn-xs btn-default"><span class="glyphicon glyphicon-pencil"></span> </a>
          <a href="products.php?delete=<?=$product['id'];?>" class="btn btn-xs btn-default"><span class="glyphicon glyphicon-remove"></span> </a>
        </td>
        <td><?=$product['title'];?></td>
        <td><?=money($product['price']);?></td>
        <td><?=$category;?></td>
        <td> <a href="products.php?featured=<?=(($product['featured'] == 0)?'1':'0');?>&id=<?=$product['id'];?>" class="btn btn-xs btn-default">
          <span class="glyphicon glyphicon-<?=(($product['featured'] == 1)?'minus':'plus');?>"></span>
        </a> &nbsp<?=(($product['featured'] == 1)?'Featured Product':'');?></td>
        <td>0</td>
      </tr>
    <?php endwhile;?>
  </tbody>
</table>
<?php
}
include 'includes/footer.php';
?>
