<?php include("includes/header.php"); ?>
<?php if(!$session->is_signed_in()) { redirect("login.php"); } ?>

<?php 

$photos = Photo::find_all();

 ?>
        
        <nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
            
            
            <?php include('includes/top_nav.php'); ?>

            <?php include('includes/side_nav.php'); ?>
        
        </nav>

        <div id="page-wrapper">

        	<div class="container-fluid">

        	    <!-- Page Heading -->
        	    <div class="row">
        	        <div class="col-lg-12">
        	            <h1 class="page-header">
        	                Photos
        	            </h1>

                        <p class="bg-success"><?php echo $message; ?></p>
        	            <div class="col-md-12">
                            <table class="table table-hover">
                                <thead>
                                    <tr>
                                        <th>Photo</th>
                                        <th>ID</th>
                                        <th>File Name</th>
                                        <th>Title</th>
                                        <th>Size</th>
                                        <th>Comments</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    
                                    <?php foreach ($photos as $photo) : ?>
                                    
                                    <tr>
                                        <td><img class="small-pic admin-photo-thumbnail" src="<?php echo $photo->picture_path(); ?>" >
                                            <div class="action_links">
                                                <a href="../photo.php?id=<?php echo $photo->id ?>">View</a> | 
                                                <a href="edit_photo.php?id=<?php echo $photo->id ?>">Edit</a> |
                                                <a href="delete_photo.php?id=<?php echo $photo->id ?>">Delete</a>
                                            </div>
                                        </td>
                                        <td><?php echo $photo->id ?></td>
                                        <td><?php echo $photo->filename ?></td>
                                        <td><?php echo $photo->title ?></td>
                                        <td><?php echo $photo->size ?></td>
                                        <td><a href="photo_comments.php?id=<?php echo $photo->id ?>">
                                            <?php 
                                                $comments = Comment::find_the_comments($photo->id);

                                                echo count($comments);
                                             ?></a>
                                        </td>
                                    </tr>

                                    <?php endforeach; ?>
                                </tbody>

                            </table>   
                       </div>
        	        </div>
        	    </div>
        	    <!-- /.row -->

        	</div>            

        </div>
        

<?php include("includes/footer.php"); ?>