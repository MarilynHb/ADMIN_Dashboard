<?php
require('top.php');
isAdmin();
$skill='';
$msg='';
if(isset($_GET['Id']) && $_GET['Id']!=''){
	$id=get_safe_value($con,$_GET['Id']);
	$res=mysqli_query($con,"select * from Skill where Id='$id'");
	$check=mysqli_num_rows($res);
	if($check>0){
		$row=mysqli_fetch_assoc($res);
		$skill=$row['Description'];
	}else{
		header('location:skills.php');
		die();
	}
}

if(isset($_POST['submit'])){
	$skill=get_safe_value($con,$_POST['skill']);
	$res=mysqli_query($con,"select * from Skill where Description='$skill'");
	$check=mysqli_num_rows($res);
	if($check>0){
		if(isset($_GET['Id']) && $_GET['Id']!=''){
			$getData=mysqli_fetch_assoc($res);
			if($id==$getData['Id']){
			
			}else{
				$msg="SKILL ALREADY EXIST";
			}
		}else{
			$msg="SKILL ALREADY EXIST";
		}
	}
	
	if($msg==''){
		if(isset($_GET['Id']) && $_GET['Id']!=''){
			mysqli_query($con,"update Skill set Description='$skill' where Id='$id'");
		}else{
			mysqli_query($con,"insert into Skill(Description) values('$skill')");
		}
		header('location:skills.php');
		die();
	}
}
?>
<div class="content pb-0">
            <div class="animated fadeIn">
               <div class="row">
                  <div class="col-lg-12">
                     <div class="card">
                        <div class="card-header"><strong>SKILLS FORM</strong> </div>
                        <form method="post">
							<div class="card-body card-block">
							   <div class="form-group">
									<label for="skills" class=" form-control-label">Skills</label>
									<input type="text" name="skill" placeholder="Skill" class="form-control" required value="<?php echo $skill?>">
								</div>
							   <button id="payment-button" name="submit" type="submit" class="btn btn-lg btn-info btn-block">
							   <span id="payment-button-amount">SUBMIT</span>
							   </button>
							   <div class="field_error"><?php echo $msg?></div>
							</div>
						</form>
                     </div>
                  </div>
               </div>
            </div>
         </div>
         
<?php
require('footer.php');
?>