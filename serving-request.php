<?php
/**
 * Template Name: Serving Request Template
 * Description: The page template for the serving request page.
 *
 * @package WordPress
 * @subpackage cpubchurch
 */

get_header(); ?>

	<?php
    if("POST" == $_SERVER["REQUEST_METHOD"]) {
		$to       = "paul@cpubchurch.com";
		$subject  = "Serving Request";
		$message  = "<p>From <strong>".$_POST["requester-name"]."</strong> to serve with <strong>".$_POST["ministry"]."</strong>.</p><p>".$_POST["comment"]."</p>";
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
						<label for="comment">Comment</label>
						<textarea id="comment" rows="6" class="required" name="comment"></textarea>
						<label for="ministry">Which ministry are you interested in?</label>
						<select id="ministry" name="ministry">
							<option value="Any">Any</option>
							<option value="Adult Ministry">Adult Ministry</option>
							<option value="Kids Ministry">Kids Ministry</option>
							<option value="Youth Ministry">Youth Ministry</option>
							<option value="Yount Adult Ministry">Young Adult Ministry</option>
							<option value="Worship Ministry">Worship Ministry</option>
						</select>
						<input class="button" type="submit" value="Submit" />
					</form>
					
				<?php endwhile; // end of the loop. ?>

			</div><!-- #content -->
		</div><!-- #primary -->

<?php get_sidebar(); ?>
<?php get_footer(); ?>