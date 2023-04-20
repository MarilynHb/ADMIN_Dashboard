<?php
require('top.php');
isAdmin();
if(isset($_GET['type']) && $_GET['type']!=''){
	echo $type;
	$type=get_safe_value($con,$_GET['type']);
	if($type=='delete'){
		$id=get_safe_value($con,$_GET['id']);
		$delete_sql="delete from Skill where Id='$id'";
		mysqli_query($con,$delete_sql);
	}
}

$sql="select * from Skill";
$res=mysqli_query($con,$sql);
?>
<div class="content pb-0">
	<div class="orders">
	   <div class="row">
		  <div class="col-xl-12">
			 <div class="card">
				<div class="card-body">
				   <h4 class="box-title">SKILLS </h4>
				   <h4 class="box-link"><a href="manage_skills.php">ADD SKILLS</a> </h4>
				</div>
				<div class="card-body--">
				   <div class="table-stats order-table ov-h">
					  <table class="table ">
						 <thead>
							<tr>
							   <th>#</th>
							   <th>SKILL</th>
							   <th></th>
							</tr>
						 </thead>
						 <tbody>
							<?php 
							$i=1;
							while($row=mysqli_fetch_assoc($res)){?>
							<tr>
							   <td><?php echo $row['Id']?></td>
							   <td><?php echo $row['Description']?></td>
							   <td>
								<?php
								echo "<span class='badge badge-edit'><a href='manage_skills.php?id=".$row['Id']."'>Edit</a></span>&nbsp;";
								
								echo "<span class='badge badge-delete'><a href='?type=delete&id=".$row['Id']."'>Delete</a></span>";
								
								?> 
							   </td>
							</tr>
							<?php } ?>
						 </tbody>
					  </table>
				   </div>
				</div>
			 </div>
		  </div>
	   </div>
	</div>
</div>
<?php
require('footer.php');
?>