<?php
/**
 * @package WordPress
 * @subpackage ME_Theme
 */
?>
<!-- RSPEAK_STOP -->
					<p class="braille-only"><a href="#top">Back to top</a></p>
				</section>
				<?php get_sidebar(); ?>
				<div class="clear"></div>
			</div>
			<footer class="main no-print">
				<?php wp_footer(); ?>
			</footer>
			<footer class="print-only">
				<?php
					$url = $_SERVER['REQUEST_URI'];
					$url = explode("?", $url, 2);
				?>
				<p>This article comes from <a href="http://blog.janoszen.com<?php echo(htmlspecialchars($url[0])); 
?>">http://blog.janoszen.com<?php 
echo(htmlspecialchars($url[0])); ?></a>. The content may be used according to the legal and privacy notice issued at
<a href="http://blog.janoszen.com/legal-and-privacy-notice/">http://blog.janoszen.com/legal-and-privacy-notice/</a>.</p>
			</footer>
			<footer class="braille-only"><a href="#top">Back to top</a></footer>
		</div>
	</body>
</html>
