<?php include("includes/header.php"); ?>
<?php if(!$session->is_signed_in()) { redirect("login.php"); } ?>

<?php 


if(empty($_GET['id'])) {
	redirect("users.php");
} 

$user = User::find_by_id($_GET['id']);

if(isset($_POST['update'])) {

	if($user) {

		$user->username = $_POST['username'];
		$user->first_name = $_POST['first_name'];
		$user->last_name = $_POST['last_name'];
		$user->password = $_POST['password'];

		if(empty($_FILES['user_image'])) {
			$user->save();
		} else {
			$user->set_file($_FILES['user_image']);

			$user->upload_photo();
			
			$user->save();

			redirect("edit_user.php?id={$user->id}");	
		}

		
			
	}
		
}



 ?>       

        <nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
            
            
            <?php include('includes/top_nav.php'); ?>

            <?php include('includes/side_nav.php'); ?>
        
        </nav>

        <div id="page-wrapper">

			<?php 

			$photos = Photo::find_all();


			 ?>


        	<!-- Modal -->

        	<div class="modal fade" id="photo-modal">
        	  <div class="modal-dialog">
        	    <div class="modal-content">
        	      <div class="modal-header">
        	        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        	        <h4 class="modal-title">Gallery System Library</h4>
        	      </div>
        	      <div class="modal-body">
        	          <div class="col-md-9">
        	             <div class="thumbnails row">
        	            
        	                <?php foreach($photos as $photo): ?>
        	                
        	               <div class="col-xs-2">
        	                 <a role="checkbox" aria-checked="false" tabindex="0" id="" href="#" class="thumbnail">
        	                   <img class="modal_thumbnails img-responsive" src="<?php echo $photo->picture_path() ?>" data="">
        	                 </a>
        	                  <div class="photo-id hidden"></div>
        	               </div>

        	                <?php endforeach; ?>

        	             </div>
        	          </div><!--col-md-9 -->
        	  <div class="col-md-3">
        	    <div id="modal_sidebar"></div>
        	  </div>

        	   </div><!--Modal Body-->
        	      <div class="modal-footer">
        	        <div class="row">
        	               <!--Closes Modal-->
        	              <button id="set_user_image" type="button" class="btn btn-primary" disabled="true" data-dismiss="modal">Apply Selection</button>
        	        </div>
        	      </div>
        	    </div><!-- /.modal-content -->
        	  </div><!-- /.modal-dialog -->
        	</div><!-- /.modal -->

            	<div class="container-fluid">

            	    <!-- Page Heading -->
            	    <div class="row">
            	        <div class="col-lg-12">
            	            <h1 class="page-header">
            	                Add User
            	            </h1>

            	            <div class="col-md-3">
            	            	<a href="#" data-toggle="modal" data-target="#photo-modal"><img class="img-responsive" src="<?php echo $user->image_path_and_placeholder(); ?>" alt=""></a>
            	            </div>
            	            <form method="post" enctype="multipart/form-data">
	            	            
	            	            <div class="col-md-6">

	            	            	<div class="form-group">
	            	            		<label for="user_image">Upload Your Picture</label>
	            	            		<input type="file" name="user_image">
	            	            		
	            	            	</div>
	

	            	            	<div class="form-group">
	            	            		<label for="username">Username</label>
	            	            		<input type="text" name="username" class="form-control" value="<?php echo $user->username ?>">
	            	            		
	            	            	</div>

	            	            	<div class="form-group">
	            	            		<label for="first_name">First Name</label>
	            	            		<input type="text" name="first_name" class="form-control" value="<?php echo $user->first_name ?>" >
	            	            	</div>

	            	            	<div class="form-group">
	            	            		<label for="last_name">Last Name</label>
	            	            		<input type="text" name="last_name" class="form-control" value="<?php echo $user->last_name ?>">
	            	            	</div>

	            	            	<div class="form-group">
	            	            		<label for="password">Password</label>
	            	            		<input type="password" name="password" class="form-control" value="<?php echo $user->password ?>">
	            	            	</div>
									
									<div class="form-group">

										<a id="user-id" class="btn btn-danger" href="delete_user.php?id=<?php echo $user->id ?>">Delete</a>
	            	            		
	            	            		<input type="submit" name="update" class="btn btn-primary pull-right" value="Update">
	            	            	</div>



	            	            </div>

            	               

            	            </form>
                           
            	        </div>
            	    </div>
            	    <!-- /.row -->

            	</div>            

            
        </div>
        

<?php include("includes/footer.php"); ?>