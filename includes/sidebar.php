<div class="col-md-4">

    <!-- Blog Search Well -->
    <div class="well">
        <h4>Blog Search</h4>
        <form class="" action="search.php" method="post">
          <div class="input-group">
              <input type="text" name="search" class="form-control">
              <span class="input-group-btn">
                  <button class="btn btn-default" type="submit" name="submit">
                      <span class="glyphicon glyphicon-search"></span>
              </button>
              </span>
          </div>
        </form>

        <!-- /.input-group -->
    </div>

  <div class="well">
    <?php

    if (isset($_SESSION['role'])):?>
    <h4>You logged in as "<?php echo $_SESSION['username']; ?>"</h4>
    <a href="includes/logout.php" class="btn btn-primary">Logout</a>
  <?php else: ?>
      <h4>Login</h4>
      <form class="" action="includes/login.php" method="post">
        <div class="input-group">
            <input type="text" name="username" class="form-control" placeholder="Username">
            <input type="password" name="password" class="form-control" placeholder="Password">
  <br>
  <br>
  <br>
  <br>
                <button class="btn btn-primary" type="submit" name="submit" value="submit">Login
            </button>

        </div>
        <a href="forgot.php?forgot=<?php echo uniqid(true); ?>">Forget password?</a>

      </form>

      <!-- /.input-group -->

<?php endif; ?>
  </div>

    <!-- Blog Categories Well -->
    <div class="well">
        <h4>Blog Categories</h4>
        <?php

        $query="SELECT * FROM category";
        $selected_query=mysqli_query($connction,$query);

         ?>


        <div class="row">
            <div class="col-lg-12">
                <ul class="list-unstyled">
                  <?php
                  while ($row=mysqli_fetch_assoc($selected_query)) {
                    $cat_title=$row['cat_title'];
                      $cat_id=$row['cat_id'];
                    echo  "<li>
                          <a href='category.php?c_id=$cat_id'>{$cat_title}</a>
                      </li>" ;
                  }

                   ?>
                </ul>
            </div>

        </div>
        <!-- /.row -->
    </div>

  <?php include "includes/widget.php" ?>

</div>
