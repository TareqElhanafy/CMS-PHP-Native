<nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
    <div class="container">
        <!-- Brand and toggle get grouped for better mobile display -->
        <div class="navbar-header">
            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="index.php">HexaBlogs</a>
        </div>
        <!-- Collect the nav links, forms, and other content for toggling -->
        <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
            <ul class="nav navbar-nav">

<?php

$query="SELECT * FROM category";
$selected_query=mysqli_query($connction,$query);
while ($row=mysqli_fetch_assoc($selected_query)) {
  $cat_title=$row['cat_title'];
    $cat_id=$row['cat_id'];

    $category_class='';
    $static_class='';
     $else_class='';
    $pageName=basename($_SERVER['PHP_SELF']);
    if (isset($_GET['c_id'])&&$_GET['c_id']==$cat_id) {
    $category_class='active';
  }elseif ($pageName=='registration.php') {
      $static_class='active';

    }
    if ($pageName=='login.php') {
        $else_class='active';

      }

  echo  "<li class='$category_class'>
        <a href='category.php?c_id=$cat_id'>{$cat_title}</a>
    </li>" ;
}


 ?>


                <li >
                    <a href="admin">admin</a>

                </li>
                <?php

                 if (!isset($_SESSION['role'])){
                  echo "<li class='$else_class'>
                      <a href='login.php'>Login</a>
                  </li>";
                }  ?>


                <li class="<?php echo  $static_class; ?>">
                    <a href="registration.php">register</a>

                </li>

                <?php

               if(isset($_SESSION['username'])){
                 if (isset($_GET['p_id'])) {
                   $postID=$_GET['p_id'];
                   echo "<li>
                        <a href='admin/posts.php?source=edit&p_id=$postID'> Edit Post</a>
                    </li>";
                 }
               }
                 ?>
            </ul>
        </div>
        <!-- /.navbar-collapse -->
    </div>
    <!-- /.container -->
</nav>
