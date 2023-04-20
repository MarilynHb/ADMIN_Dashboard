<?php
require('top.php');
isAdmin();
$industry='';
$msg='';
if(isset($_GET['Id']) && $_GET['Id']!=''){
	$id=get_safe_value($con,$_GET['Id']);
	$res=mysqli_query($con,"select * from Industry where Id='$id'");
	$check=mysqli_num_rows($res);
	if($check>0){
		$row=mysqli_fetch_assoc($res);
		$industry=$row['Description'];
	}else{
		header('location:industries.php');
		die();
	}
}

if(isset($_POST['submit'])){
	$industry=get_safe_value($con,$_POST['industry']);
	$res=mysqli_query($con,"select * from Industry where Description='$industry'");
	$check=mysqli_num_rows($res);
	if($check>0){
		if(isset($_GET['Id']) && $_GET['Id']!=''){
			$getData=mysqli_fetch_assoc($res);
			if($id==$getData['Id']){
			
			}else{
				$msg="INDUSTRY ALREADY EXIST";
			}
		}else{
			$msg="INDUSTRY ALREADY EXIST";
		}
	}
	
	if($msg==''){
		if(isset($_GET['Id']) && $_GET['Id']!=''){
			mysqli_query($con,"update Industry set Description='$industry' where Id='$id'");
		}else{
			mysqli_query($con,"insert into Industry(Description) values('$industry')");
		}
		header('location:industries.php');
		die();
	}
}
?>
<div class="content pb-0">
            <div class="animated fadeIn">
               <div class="row">
                  <div class="col-lg-12">
                     <div class="card">
                        <div class="card-header"><strong>INDUSTRIES FORM</strong> </div>
                        <form method="post">
							<div class="card-body card-block">
							   <div class="form-group">
									<label for="industries" class=" form-control-label">Industries</label>
									<input type="text" name="industry" placeholder="ENTER INDUSTRY NAME" class="form-control" required value="<?php echo $industry?>">
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