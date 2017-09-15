<?php
/**
 * The template for displaying the footer.
 *
 * Contains the closing of the id=main div and all content after
 */
?>
			<div class="clear-both"></div>
		</div><!-- #main -->
	</div><!-- .wrapper -->

	<footer id="colophon" class="wrapper" role="contentinfo">
		<div id="footer-left">
			<nav id="access-footer" role="navigation">
				<?php wp_nav_menu( array( 'theme_location' => 'footer' ) ); ?>
			</nav>
			<div id="copyright">&copy;2012 College Park Church. All Rights Reserved.</div>
		</div>
		<div id="connect">
			<a href="<?php echo 'http://'.$_SERVER[HTTP_HOST].$_SERVER[REQUEST_URI].'feed'; ?>"><img src="<?php echo dirname( get_bloginfo('stylesheet_url')); ?>/images/rss_icon.png" alt="Subscribe" /></a>
			<!-- icons credited to http://paulrobertlloyd.com/ -->
			<a href="https://www.facebook.com/cpubchurch" target="_blank"><img src="<?php echo dirname( get_bloginfo('stylesheet_url')); ?>/images/facebook_icon.png" alt="Facebook"/></a>
			<a href="http://twitter.com/cpubchurch" target="_blank"><img src="<?php echo dirname( get_bloginfo('stylesheet_url')); ?>/images/twitter_icon.png" alt="Twitter"/></a>
		</div>
		
		<div class="clear-both"></div>
	</footer>
</div><!-- #page -->

<?php wp_footer(); ?>

</body>
</html>