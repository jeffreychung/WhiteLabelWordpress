<?php
/**
 * @package WordPress
 * @subpackage ME_Theme
 */
include(dirname(__FILE__) . "/revision.php");
?>
	<aside class="main grid_3">
		<section>
			<header><h2>Search</h2></header>
			<article><?php get_search_form(); ?></article>
		</section>
<?php /*		<section>
			<header><h2>Paid advertisement</h2></header>
			<article>
			<script type="text/javascript">
			<!--
				google_ad_client = "pub-7025744359987435";
				google_ad_slot = "3388459064";
				google_ad_width = 200;
				google_ad_height = 200;
			//-->
			</script>
			<script type="text/javascript" src="http://pagead2.googlesyndication.com/pagead/show_ads.js"></script>
			</article>
		</section> */ ?>
		<section>
			<header><h2>Pages</h2></header>
			<nav><ul><?php echo(preg_replace("/ class=\"(.*?)\"/", "", wp_list_pages(array('title_li' => "", "echo" => false)))); ?></ul></nav>
		</section>
		<section>
			<header><h2>Categories</h2></header>
			<nav><ul><?php echo(preg_replace("/ class=\"(.*?)\"/", "", wp_list_categories(array('title_li' => "", "echo" => false)))); ?></ul></nav>
		</section>
<?php
global $wpdb;
$my_drafts = $wpdb->get_results("SELECT post_title FROM $wpdb->posts WHERE post_status = 'draft'");
$draftcount = 0;
if ($my_drafts) {

		$my_draft_list = "<section><header><h2>Coming soon</h2></header><article><ul>";
		foreach ($my_drafts as $my_draft) {
			$my_title = $my_draft->post_title;
			if ($my_title != '') {
				$my_draft_list .= "<li>" . $my_title . "</li>";
				$draftcount++;
			}
		}
		$my_draft_list = $my_draft_list . '<li>Got a good idea? <a href="/contact">Mail me about it!</a></li></ul></article></section>';
		if ($draftcount)
		{
			echo $my_draft_list;
		}
}

if (!$draftcount)
{
		$my_draft_list = '<section><header><h2>Comming soon</h2></header><article><p>Nothing to report. Got a good idea? <a href="/contact">Mail me about it!</a></p></article></section>';
		echo $my_draft_list;
}
?>
		<section>
			<header><h2>Archive</h2></header>
			<nav><ul><?php echo(preg_replace("/ class=\"(.*?)\"/", "", wp_get_archives(array('type' => 'monthly', 'echo' => false)))); ?></ul></nav>
		</section>
		<section itemscope  itemtype="http://data-vocabulary.org/Person">
			<header><h2>Friends, acquaintances</h2></header>
			<nav><ul>
				<li><a rel="friend met co-worker" href="http://blog.anilla.hu/">Anilla</a></li>
				<li><a rel="met co-worker" href="http://hogyanok.com/">Bugge</a></li>
				<li><a rel="met co-worker" href="http://hogyan.org/">Charlie</a></li>
				<li><a rel="met colleague" href="http://blog.djpetee.hu/">DjPetee</a></li>
				<li><a rel="met acquaintance" href="http://gorinevelde.com/">Görinevelde</a></li>
				<li><a rel="met co-worker" href="http://blog.mereszpingvin.hu/">Ricsi</a></li>
				<li><a rel="met colleague" href="http://blog.sanyoca.hu/">Sanyó</a></li>
				<li><a rel="met colleague" href="http://tyrael.hu/">Tyrael</a></li>
			</ul></nav>
		</section>
		<section>
                        <header><h2>Worth reading</h2></header>
                        <nav><ul>
				<?php
					require_once (ABSPATH . WPINC . '/rss-functions.php');
					$feeds = array(
						"Felho" => "http://feeds.feedburner.com/felho",
						"Smashing Magazine" => "http://rss1.smashingmagazine.com/feed/"
					);
					$entries = array();
					foreach ($feeds as $author => $feed)
					{
						$rss = @fetch_rss($feed);
						if (isset($rss->items) && 0 != count($rss->items) )
						{
							$rss->items = array_slice($rss->items, 0, 20);
							foreach ($rss->items as $item )
							{
								$time = strtotime($item['pubdate']);
								if ($time > 0)
								{
									if (!isset($rssentries[$time]))
									{
										$rssentries[$time] = array();
									}
									if (!isset($item['dc']['creator']))
									{
										$item['dc']['creator'] = $author;
									}
									if (stripos($item['link'], "?"))
									{
										$linksep = "&";
									} else {
										$linksep = "?";
									}
									$item['link'] .= $linksep . "utm_source=" . urlencode($_SERVER['HTTP_HOST']) . "&utm_medium=rss&utm_campaign=RSS%2Baggregator";
									$rssentries[$time][] = array(
										"link" => $item['link'],
										"title" => $item['title'],
										"time" => $time,
										"creator" => $item['dc']['creator']
									);
								}
							}
						}
					}
					krsort($rssentries);
					$rssentries = array_slice($rssentries, 0, 10);
					foreach ($rssentries as $rssentry)
					{
						foreach ($rssentry as $item)
						{
							?>
								<li>
                                                                        <a
										title="Author: <?php echo wp_specialchars($item['creator']); ?>"
										href="<?php echo wp_filter_kses($item['link']); ?>">
                                                                                <?php echo wp_specialchars($item['title']); ?>
                                                                        </a>
                                                                </li>
							<?php
						}
					}
				?>
			</ul></nav>
		</section>
	</aside>

