<?php
/**
 * Template Name: Prayer Request Template
 * Description: The page template for the prayer request page.
 *
 * @package WordPress
 * @subpackage cpubchurch
 */

get_header(); ?>

	<?php
    if("POST" == $_SERVER["REQUEST_METHOD"]) {
		$to       = "gary@cpubchurch.com";
		$subject  = "Prayer Request";
		$message  = "<p>From <strong>".$_POST["requester-name"]."</strong> to be shared with <strong>".$_POST["visible-by"]."</strong>.</p><p>".$_POST["request"]."</p>";
		$headers  = "MIME-Version: 1.0\r\n";
		$headers .= "Content-type: text/html; charset=iso-8859-1\r\n";
		$headers .= "From: ".$_POST["email"]."\r\n";
        mail($to, $subject, $message, $headers);
    }
?>

	<script src="<?php echo dirname( get_bloginfo('stylesheet_url')); ?>/scripts/jquery.validate.min.js" type="text/javascript"></script>
<script type="text/javascript">
	jQuery(document).ready(function($) {		
		$("#prayer-form").validate({
			errorPlacement: function(error, element) {
				error.insertAfter(element.prev("label"));
		   }
		});
	});
</script>
		<div id="primary">
			<div id="content" role="main">
				
				<?php while ( have_posts() ) : the_post(); ?>

					<?php get_template_part( 'content', 'page' ); ?>
						<?php if("POST" == $_SERVER["REQUEST_METHOD"]) { ?>
					<div class="form-message">Your request has been submitted!</div>
				<?php } ?>
					<?php comments_template( '', true ); ?>
					
					<form id="prayer-form" method="post" action="">
						<label for="requester-name">Name</label>
						<input id="requester-name" class="required" name="requester-name" type="text" />
						<label for="email">Email Address</label>
						<input id="email" class="required email" name="email" type="text" />
						<label for="request">Request</label>
						<textarea id="request" rows="6" class="required" name="request"></textarea>
						<label for="visible-by">How should this request be shared?</label>
						<select id="visible-by" name="visible-by">
							<option value="Pastoral Staff Only">Pastoral Staff Only</option>
							<option value="Email Prayer Chain">Email Prayer Chain</option>
						</select>
						<input class="button" type="submit" value="Submit" />
					</form>
					
				<?php endwhile; // end of the loop. ?>

			</div><!-- #content -->
		</div><!-- #primary -->

<?php get_sidebar(); ?>
<?php get_footer(); ?>