



<table class="table table-bordered table-hover">
  <thead>
    <th>Id</th>
    <th>username</th>
    <th>firstname</th>
    <th>lastname</th>
    <th>Role</th>
    <th>Email</th>
    <th>Image</th>
    <th>Date</th>


  </thead>
  <tbody>
<?php
$query="SELECT * FROM users ";
$selected_query=mysqli_query($connction,$query);
while ($row=mysqli_fetch_assoc($selected_query)) {

$user_id=$row['user_id'];
$user_name=$row['user_name'];
$user_firstname=$row['user_firstname'];
$user_lastname=$row['user_lastname'];
$user_email=$row['user_email'];
$user_image=$row['user_image'];
$user_date=$row['user_date'];
$role=$row['role'];
?>

  <tr>
    <td><?php echo$user_id; ?></td>
    <td><?php echo $user_name ; ?></td>
    <td><?php echo $user_firstname ; ?></td>
    <td><?php echo $user_lastname ; ?></td>
      <td><?php echo $role ; ?></td>
    <td><?php echo $user_email ; ?></td>
    <td><img class="img-responsive" width=100  src= "<?php echo'../images/'.$user_image;?>" alt="images"/></td>
    <td><?php echo $user_date ; ?></td>
    <td><a href="users.php?source=view&delete=<?php echo $user_id; ?>">Delete</a></td>
    <td><a href="users.php?source=edit&u_id=<?php echo $user_id; ?>">Edit</a></td>
    <td><a href="users.php?source=view&changetoadmin=<?php echo $user_id; ?>">Admin</a></td>
      <td><a href="users.php?source=view&changetosubscriber=<?php echo $user_id; ?>">Subscriber</a></td>

  </tr>

<?php } ?>
</tbody>
</table>


<?php
if(isset($_GET['changetoadmin'])){
$adminchanging=$_GET['changetoadmin'];
$query="UPDATE users SET role='Admin' WHERE user_id=$adminchanging ";
$selected_approved_query=mysqli_query($connction,$query);
header("location:users.php?source=view");
if (!$selected_query) {
  die("f".mysqli_error($connction));
}
}
if(isset($_GET['changetosubscriber'])){
$subchanging=$_GET['changetosubscriber'];
$query="UPDATE users SET role='subscriber' WHERE user_id=$subchanging ";
$selected_unapproved_query=mysqli_query($connction,$query);
header("location:users.php?source=view");
if (!$selected_query) {
  die("f".mysqli_error($connction));
}

}

if ($_SESSION['user_name']) {


if(isset($_GET['delete'])){
$deleted=mysqli_real_escape_string($_GET['delete']);
$query="DELETE FROM users WHERE user_id=$deleted";
$selected_query=mysqli_query($connction,$query);
if (!$selected_query) {
  die("f".mysqli_error($connction));
}
header("location:users.php?source=view");

}
}
 ?>
