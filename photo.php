<?php 
require_once("admin/includes/init.php");

if(empty($_GET['id'])) {
    redirect('index.php');
}
$photo = Photo::find_by_id(4);
// $user = User::find_by_id(8);
// echo $photo->title;

if(isset($_POST['submit'])) {
    $author = trim($_POST['author']);
    $body = trim($_POST['body']);

    $new_comment = Comment::create_comment($photo->id, $author, $body);

    if($new_comment && $new_comment->save()) {

        redirect("photo.php?id={$photo->id}");
    } else {
        $message = "There were some problems saving.";
    }
    
} else {
    $author = "";
    $body = "";
}

$comments = Comment::find_the_comments($photo->id);

 ?>
<?php include("includes/header.php"); ?>
    <!-- Navigation -->
    
    <!-- Page Content -->
    <div class="container">

        <div class="row">

            <!-- Blog Post Content Column -->
            <div class="col-lg-12 row">
                <h1><?php echo $photo->title; ?></h1>

                
                <!-- Preview Image -->
                <img class="img-responsive" src="<?php echo "admin/{$photo->picture_path()}"; ?>" alt="">

                <p class="lead"><?php echo $photo->caption ?></p>
                <p><?php echo $photo->description ?></p>








                <!-- Comments Form -->
                <div class="well" id="all-comments">
                    <h4>Leave a Comment:</h4>
                    <form role="form" method="post">
                        <div class="form-group">
                            <label for="author">Author</label>
                            <input type="text" name="author" class="form-control">
                        </div>
                        <div class="form-group">
                            <label for="body">Comment</label>
                            <textarea name="body" class="form-control" rows="3"></textarea>
                        </div>
                        <button type="submit" name="submit" class="btn btn-primary">Submit</button>
                    </form>
                </div>

                <hr>

                <!-- Posted Comments -->
                
                <?php foreach($comments as $comment): ?>

                
                <div class="media">
                    <a class="pull-left" href="#">
                        <img class="media-object" src="http://placehold.it/64x64" alt="">
                    </a>
                    <div class="media-body">
                        <h4 class="media-heading"><?php echo $comment->author; ?>
                        </h4>
                        <?php echo $comment->body; ?>
                    </div>
                </div>

                <?php endforeach; ?>

            </div>


        </div>
        <!-- /.row -->

        
        <?php require_once('includes/footer.php'); ?>

</body>

</html>
