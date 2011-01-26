</div><!-- end content -->

<div id="footer">
	<ul class="navigation">
		<?php echo public_nav_main(array('Sources Home' => uri(''), 'Browse Items' => uri('items'), 'Browse Collections'=>uri('collections')));
       	?>
	</ul>

	<div id="footer-text"> 
	        <p><?php echo get_theme_option('Footer Text'); ?></p>
            <?php if ((get_theme_option('Display Footer Copyright') == 1) && $copyright = settings('copyright')): ?>
                <p><?php echo $copyright; ?></p>
            <?php endif; ?>
	    <p>Proudly powered by <a href="http://omeka.org">Omeka</a></p>
		
	</div><!-- end footer-text -->
	<?php echo plugin_footer(); ?>
</div><!-- end footer -->

</div><!--end wrap-->
<!--- google analytics code --->
<script type="text/javascript">
var gaJsHost = (("https:" == document.location.protocol) ? "https://ssl." : "http://www.");
document.write(unescape("%3Cscript src='" + gaJsHost + "google-analytics.com/ga.js' type='text/javascript'%3E%3C/script%3E"));
</script>
<script type="text/javascript">
try {
var pageTracker = _gat._getTracker("UA-11680012-1");
pageTracker._trackPageview();
} catch(err) {}</script>
</body>

</html>
