<footer class="container-fluid">
	<div class="container">
		<div class="row">
			<div class="col-sm-4">
				<?php dynamic_sidebar( 'footer-left' ); ?>
			</div>
			<div class="col-sm-4">
				<?php dynamic_sidebar( 'footer-middle' ); ?>
			</div>
			<div class="col-sm-4">
				<?php dynamic_sidebar( 'footer-right' ); ?>
			</div>
		</div>
		<div class="row copyright">
			&copy; <?php echo esc_html( date( 'Y' ) ) . ' ' . esc_html( get_bloginfo( 'name' ) ); ?>.
			All Rights Reserved.
		</div>
	</div>
</footer>

<?php wp_footer(); ?>
</body>
</html>
