<?
$sql = "SELECT * FROM categories WHERE parent = 0";
$pquery = $db->query($sql);
?>
<!-- Top Nav Bar -->
<nav class="navbar navbar-default navbar-fixed-top">
  <div class="container">
    <a href="/index.php" class="navbar-brand">Shaunta's Boutique</a>
    <ul class="nav navbar-nav">
      <? while($parent = mysqli_fetch_assoc($pquery)) : ?>
      <? $parent_id = $parent['id'];
          $sql2 = "SELECT * FROM categories WHERE parent = '$parent_id'";
          $cquery = $db->query($sql2);
      ?>
      <!-- Menu Item -->
        <li class="dropdown">
          <a href="#" class="dropdown-toggle" data-toggle="dropdown"><? echo $parent['category']?><span class="caret"></span></a>
          <ul class="dropdown-menu" role="menu">
            <? while($child = mysqli_fetch_assoc($cquery)) : ?>
            <li><a href="#"><? echo $child['category'];?></a> </li>
          <? endwhile;?>
          </ul>
        </li>
      <? endwhile; ?>


  </div>
</nav>
