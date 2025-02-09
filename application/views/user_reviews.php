<?php include 'head.php';?>
<?php include 'navigation.php'; ?>

<link rel="stylesheet" href="<?php echo asset_url() . "css/user_navigation_bar.css";?>" type="text/css" />
<script src="<?php echo asset_url() . "js/edit_user_info.js";?>"></script>
<script src="<?php echo asset_url() . "js/reviews.js";?>"></script>

<?php
	if(isset($this->session->userdata['is_logged_in']) and ($this->session->userdata['username'] == $user['username'])) {
		$is_you = TRUE;
	} else {
		$is_you = FALSE;
	}
?>

<script type="text/javascript">
	var user_id = <?php echo $user['id'];?>;
	$(document).ready(function() {	
		var total_groups = <?php echo $total_groups;?>;
		var site_url = "<?php echo site_url("reviews/load_reviews_user/");?>";
		
		initScroll(total_groups, site_url, user_id);
		
		<?php if(!$is_you) {?>
			$('head').append('<script src="<?php echo asset_url() . "js/follow.js";?>">');	
		<?php }?>
		
	});	
	<?php if($is_you) { ?>
	function showEditFields() {
			editUserInfo(false, 0);		
			$('head').append('<link rel="stylesheet" href="<?php echo asset_url() . "css/temp_disable_selection.css";?>" type="text/css" />');		
	}

	var delete_url = "<?php echo site_url("reviews/delete_review");?>";

	function getUserId() {
		return <?php echo $user['id'];?>;
	}

	function getDeleteUrl() {
		return delete_url;
	}

	<?php }?>

	function getFollowUrl() {
		var follow_url = "<?php echo site_url("follow/follow_user")?>";
		return follow_url;
	}

	function getUnfollowUrl() {
		var unfollow_url = "<?php echo site_url("follow/unfollow_user")?>";
		return unfollow_url;
	}
</script>

<div id="wrap">
	<?php include 'user_profile_top.php';?>
	<div class="container-fluid scrollable" id="user_content">	
		<h1 class="main_title2">Reviews</h1>	
		
		<div id = "reviews_div"></div>
		<div id = "loader_image_div">
			<img src="<?php echo asset_url() . "imgs/loading_records.gif";?>" class="loader_image">
		</div>
	</div>
</div>
	
<?php include 'footer.php';?>

<div id="confirm_delete_modal" class="modal fade" role="dialog">
	<div class="wrap_modal_elements">
	<div class="modal-dialog">
        <div class="modal-content">
		    <div class="modal-header">
		        <a href="#" data-dismiss="modal" class="close">&times;</a>
		         <h3>Delete Review</h3>
		    </div>
		    <div class="modal-body">
		        <p>You are about to delete your review, this procedure is irreversible.</p>
		        <p>Do you want to proceed?</p>
		        <p id="review_name"></p>
		    </div>
		    <div class="modal-footer">
		        <a class="btn danger">Yes</a>
		        <a data-dismiss="modal" class="btn secondary">No</a>
		    </div>
	    </div>
    </div>
    </div>
</div>