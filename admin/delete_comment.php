<?php include("includes/header.php"); ?>
<?php if(!$session->is_signed_in()) { redirect("login.php"); } ?>

<?php 

if(empty($_GET['id'])) {
	redirect('comments.php');
}

$comment = comment::find_by_id($_GET['id']);

if($comment) {
	$comment->delete();
	$session->message("The comment has been deleted");
	redirect('comments.php');
} else {
	redirect("comments.php");
}

 ?>
