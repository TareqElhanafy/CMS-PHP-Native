


<?php include "includes/admin_header.php" ?>

    <div id="wrapper">

        <!-- Navigation -->

        <?php include "includes/admin_nav.php" ?>

        <div id="page-wrapper">
          <?php
$session=session_id();
$time=time();
$time_out_in_sec=30;
$time_out=$time-$time_out_in_sec;

$query="SELECT * FROM online_users WHERE session='$session' ";
$selected_session_query=mysqli_query($connction,$query);
$session_count=mysqli_num_rows($selected_session_query);

if ($session_count == NULL ) {
  $query="INSERT INTO online_users (session , estimate_time ) VALUES ('$session','$time' ) ";
  $selected_inserted_query=mysqli_query($connction,$query);
}else {
  $query="UPDATE online_users SET  estimate_time= '$time' WHERE session= '$session' ";
  $selected_updateded_query=mysqli_query($connction,$query);
}
$query="SELECT * FROM online_users WHERE estimate_time >'$time_out' ";
$selected_counted_query=mysqli_query($connction,$query);
$_SESSION['users_count']=$users_count=mysqli_num_rows($selected_counted_query);
           ?>





            <div class="container-fluid">

                <!-- Page Heading -->
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header">
                            Blank Page
                            <small><?php echo $_SESSION['username']; ?></small>
                    </div>
                </div>
                <!-- /.row -->

                                <!-- /.row -->

                <div class="row">
                    <div class="col-lg-3 col-md-6">
                        <div class="panel panel-primary">
                            <div class="panel-heading">
                                <div class="row">
                                    <div class="col-xs-3">
                                        <i class="fa fa-file-text fa-5x"></i>
                                    </div>
<?php
$query="SELECT * FROM posts";
$selected_query=mysqli_query($connction,$query);
$postsCount=mysqli_num_rows($selected_query);

 ?>



                                    <div class="col-xs-9 text-right">
                                  <div class='huge'><?php echo $postsCount; ?></div>
                                        <div>Posts</div>
                                    </div>
                                </div>
                            </div>
                            <a href="posts.php?source=view">
                                <div class="panel-footer">
                                    <span class="pull-left">View Details</span>
                                    <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                                    <div class="clearfix"></div>
                                </div>
                            </a>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-6">
                        <div class="panel panel-green">
                            <div class="panel-heading">
                                <div class="row">
                                    <div class="col-xs-3">
                                        <i class="fa fa-comments fa-5x"></i>
                                    </div>
                                    <?php
                                    $query="SELECT * FROM comments";
                                    $selected_query=mysqli_query($connction,$query);
                                    $commentsCount=mysqli_num_rows($selected_query);

                                     ?>
                                    <div class="col-xs-9 text-right">
                                     <div class='huge'><?php echo $commentsCount; ?></div>
                                      <div>Comments</div>
                                    </div>
                                </div>
                            </div>
                            <a href="comments.php">
                                <div class="panel-footer">
                                    <span class="pull-left">View Details</span>
                                    <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                                    <div class="clearfix"></div>
                                </div>
                            </a>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-6">
                        <div class="panel panel-yellow">
                            <div class="panel-heading">
                                <div class="row">
                                    <div class="col-xs-3">
                                        <i class="fa fa-user fa-5x"></i>
                                    </div>
                                    <?php
                                    $query="SELECT * FROM users";
                                    $selected_query=mysqli_query($connction,$query);
                                    $usersCount=mysqli_num_rows($selected_query);

                                     ?>
                                    <div class="col-xs-9 text-right">
                                    <div class='huge'><?php echo $usersCount; ?></div>
                                        <div> Users</div>
                                    </div>
                                </div>
                            </div>
                            <a href="users.php?source=view">
                                <div class="panel-footer">
                                    <span class="pull-left">View Details</span>
                                    <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                                    <div class="clearfix"></div>
                                </div>
                            </a>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-6">
                        <div class="panel panel-red">
                            <div class="panel-heading">
                                <div class="row">
                                    <div class="col-xs-3">
                                        <i class="fa fa-list fa-5x"></i>
                                    </div>
                                    <?php
                                    $query="SELECT * FROM category";
                                    $selected_query=mysqli_query($connction,$query);
                                    $categoryCount=mysqli_num_rows($selected_query);

                                     ?>
                                    <div class="col-xs-9 text-right">
                                        <div class='huge'><?php echo   $categoryCount; ?></div>
                                         <div>Categories</div>
                                    </div>
                                </div>
                            </div>
                            <a href="categories.php">
                                <div class="panel-footer">
                                    <span class="pull-left">View Details</span>
                                    <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                                    <div class="clearfix"></div>
                                </div>
                            </a>
                        </div>
                    </div>
                </div>
                                <!-- /.row -->
<?php
$query="SELECT * FROM users WHERE role='subscriber'";
$selected_query=mysqli_query($connction,$query);
$usersroleCount=mysqli_num_rows($selected_query);

$query="SELECT * FROM comments WHERE comment_status='unapproved'";
$selected_query=mysqli_query($connction,$query);
$unapprovedCommentsCount=mysqli_num_rows($selected_query);
$query="SELECT * FROM posts WHERE post_status='publish'";
$selected_published_query=mysqli_query($connction,$query);
$publishedpostsCount=mysqli_num_rows($selected_published_query);

 ?>
                                   <script type="text/javascript">
                                     google.charts.load('current', {'packages':['bar']});
                                     google.charts.setOnLoadCallback(drawChart);

                                     function drawChart() {
                                       var data = google.visualization.arrayToDataTable([
                                         ['Data', 'Count'],

                                         <?php
                                        $element_text=['Active Posts','Published Posts','Comments','Users','Subscribers','unapproved Comments','Category'];
                                        $element_count=[$postsCount,$publishedpostsCount,$commentsCount,$usersCount,$usersroleCount,$unapprovedCommentsCount,$categoryCount];
                                           for ($i=0; $i <6 ; $i++) {
                                            echo "['$element_text[$i]',$element_count[$i]],";
                                           }
                                          ?>
                                         // ['Posts', 1000],
                                       ]);

                                       var options = {
                                         chart: {
                                           title: 'Company Performance',
                                           subtitle: 'Sales, Expenses, and Profit: 2014-2017',
                                         }
                                       };

                                       var chart = new google.charts.Bar(document.getElementById('columnchart_material'));

                                       chart.draw(data, google.charts.Bar.convertOptions(options));
                                     }
                                   </script>
                                <div id="columnchart_material" style="width: 800px; height: 500px;"></div>
            </div>
            <!-- /.container-fluid -->

        </div>
        <!-- /#page-wrapper -->

    </div>
    <?php include "includes/admin_footer.php" ?>
