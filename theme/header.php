<?php
/**
 * @package WordPress
 * @subpackage ME_Theme
 */

$languages = array(
	"hu" => array(
		"text" => "Magyar",
		"link" => "http://blog.janoszen.hu"
	)
);

if (isset($meta) && $meta)
{
	$authors=array();
	$tags=array();
	$categories=array();
	$desc = array();
	if (have_posts())
	{
		while (have_posts())
		{
			$post = $posts[0];
			the_post();
			foreach (explode(",", strip_tags(get_the_category_list(','))) as $category)
			{
				$category = trim($category);
				if ($category)
				{
					$categories[$category] = $category;
				}
			}
			foreach (explode(",", strip_tags(get_the_tag_list("", ","))) as $tag)
			{
				$tag = trim($tag);
				if ($tag)
				{
					$tags[$tag] = $tag;
				}
			}
			$author = apply_filters('the_author_display_name', get_the_author_meta('display_name'));
			if ($author)
			{
				$authors[$author] = $author;
			}
			$desc[] = get_post_meta($post->ID, "description", true);
			$keyw[] = get_post_meta($post->ID, "keywords", true);
		}
		if (count($desc) == 1 && !isset($description))
		{
			$description = $desc[0];
		}
		if (count($desc) == 1 && !isset($keywords))
                {
                        $keywords = $keyw[0];
                }
	}
	if (isset($keywords))
	{
		foreach (explode(",", $keywords) as $k)
		{
			if (trim($k))
			{
				$tags[trim($k)] = trim($k);
			}
		}
	}
}

function jz_get_related_posts($before_title="",$after_title="") {
        global $wpdb, $post,$table_prefix;
        if(!$post->ID){return;}
        $now = current_time('mysql', 1);
        $tags = wp_get_post_tags($post->ID);
        $taglist = "'" . $tags[0]->term_id. "'";
        $tagcount = count($tags);
        if ($tagcount > 1) {
                for ($i = 1; $i < $tagcount; $i++) {
                        $taglist = $taglist . ", '" . $tags[$i]->term_id . "'";
                }
        }
        $limitclause = "LIMIT 5";
        $q = "SELECT p.ID, p.post_title, p.post_content,p.post_excerpt, p.post_date,  p.comment_count, count(t_r.object_id) as cnt FROM $wpdb->term_taxonomy t_t, $wpdb->term_relationships t_r, $wpdb->posts p WHERE t_t.taxonomy ='post_tag' AND t_t.term_taxonomy_id = t_r.term_taxonomy_id AND t_r.object_id  = p.ID AND (t_t.term_id IN ($taglist)) AND p.ID != $post->ID AND p.post_status = 'publish' AND p.post_date_gmt < '$now' GROUP BY t_r.object_id ORDER BY cnt DESC, p.post_date_gmt DESC $limitclause;";
        $related_posts = $wpdb->get_results($q);
        return $related_posts;
}

function jz_get_alternate_languages() {
	global $post, $languages;
	$linklangs = array();
	foreach ($languages as $lang => $prop)
	{
		$link = get_post_meta($post->ID, "lang_" . $lang, true);
		if ($link)
		{
			$linklangs[$lang] = array('link' => $prop['link'] . $link, 'text' => $prop['text']);
		}
	}
	return $linklangs;
}

include(dirname(__FILE__) . "/revision.php");

?>
<!DOCTYPE html>
<html lang="en">
	<head>
	<!-- head profile="http://gmpg.org/xfn/11" -->
		<meta http-equiv="Content-Type" content="<?php bloginfo('html_type'); ?>; charset=<?php bloginfo('charset'); ?>" />
		<title><?php wp_title('&laquo;', true, 'right'); ?> <?php bloginfo('name'); ?></title>

		<link rel="meta" href="http://blog.janoszen.com/labels.rdf" type="application/rdf+xml" title="ICRA labels" />

<?php if (isset($meta) && $meta) : ?>
<?php if (count($tags)) : ?>
		<meta name="keywords" content="<?php echo(htmlspecialchars(implode(", ", $tags))); ?>" />
<?php endif; ?>
<?php if (count($categories)) : ?>
		<meta name="subject" content="<?php echo(htmlspecialchars(implode(", ", $categories))); ?>" />
		<meta name="abstract" content="<?php echo(htmlspecialchars(implode(", ", $categories))); ?>" />
		<meta name="DC.Subject" content="<?php echo(htmlspecialchars(implode(", ", $categories))); ?>" />
<?php endif; ?>
<?php if (count($authors)) : ?>
		<meta name="author" content="<?php echo(htmlspecialchars(implode(", ", $authors))); ?>"/>
		<meta name="DC.Creator" content="<?php echo(htmlspecialchars(implode(", ", $authors))); ?>" />
<?php endif; ?>
<?php endif; ?>
<?php if (isset($description)) : ?>
		<meta name="description" content="<?php echo(htmlspecialchars($description)); ?>" />
		<meta name="DC.Description" content="<?php echo(htmlspecialchars($description)); ?>" />
<?php endif; ?>

		<meta name="publisher" content="J&aacute;nos P&aacute;sztor" />
		<meta name="DC.Publisher" content="J&aacute;nos P&aacute;sztor" />
		<meta name="copyright" content="Design by Anilla - Copyright &copy; 2010 Janoszen" />
		<meta name="DC.Rights" content="Design by Anilla - Copyright &copy; 2010 Janoszen" />
		<meta name="language" content="English,en" />

		<meta name="document-type" content="Public" />
		<meta name="document-rating" content="Safe for Kids" />
		<meta name="rating" content="Safe For Kids" />
		<meta name="document-distribution" content="Global" />
		<meta name="document-state" content="Dynamic" />

		<meta name="DC.Identifier" content="http://blog.janoszen.com" />
		<meta name="DC.Language" content="en" />

<?php
/**
 * Prevent pagerank loss by page scraping / proxying
 */
if ($_SERVER['HTTP_HOST'] == "blog.janoszen.com" && (
	(stripos($_SERVER['HTTP_USER_AGENT'], "google") !== false)
	|| (stripos($_SERVER['HTTP_USER_AGENT'], "slurp") !== false)
	|| (stripos($_SERVER['HTTP_USER_AGENT'], "yahoo") !== false)
	|| (stripos($_SERVER['HTTP_USER_AGENT'], "msnbot") !== false)
	|| (stripos($_SERVER['HTTP_USER_AGENT'], "teoma") !== false)
        || (stripos($_SERVER['HTTP_USER_AGENT'], "archive_crawler ") !== false))
)
{
?>
		<meta name="robots" content="index, follow" />
<?php
} else {
?>
		<meta name="robots" content="noindex, nofollow" />
<?php
}
?>


<?php if (isset($_GET['debug'])) { ?>
		<link rel="stylesheet" href="http://static.janoszen.com/b<?php echo($revision); ?>/css/screen.css" type="text/css" media="screen,tv,projection" />
		<link rel="stylesheet" href="http://static.janoszen.com/b<?php echo($revision); ?>/css/reset.css" type="text/css" media="screen,tv,projection" />
		<link rel="stylesheet" href="http://static.janoszen.com/b<?php echo($revision); ?>/css/960gs.css" type="text/css" media="screen,tv,projection" />
		<link rel="stylesheet" href="http://static.janoszen.com/b<?php echo($revision); ?>/css/typography.css" type="text/css" media="screen,tv,projection" />
		<link rel="stylesheet" href="http://static.janoszen.com/b<?php echo($revision); ?>/css/layout.css" type="text/css" media="screen,tv,projection" />
		<link rel="stylesheet" href="http://static.janoszen.com/b<?php echo($revision); ?>/css/forms.css" type="text/css" media="screen,tv,projection" />
		<link rel="stylesheet" href="http://static.janoszen.com/b<?php echo($revision); ?>/css/skin.css" type="text/css" media="screen,tv,projection" />
		<link rel="stylesheet" href="http://static.janoszen.com/b<?php echo($revision); ?>/css/flowbox.css" type="text/css" media="screen,tv,projection" />
		<link rel="stylesheet" href="http://static.janoszen.com/b<?php echo($revision); ?>/css/filesystem.css" type="text/css" media="screen,tv,projection" />
<?php } else { ?>
		<link rel="stylesheet" href="http://static.janoszen.com/b<?php echo($revision); ?>/css/style.css" type="text/css" media="screen,tv,projection" />
<?php } ?>

		<link rel="stylesheet" href="http://static.janoszen.com/b<?php echo($revision); ?>/css/handheld.css" type="text/css" media="handheld,tv" />
		<link rel="stylesheet" href="http://static.janoszen.com/b<?php echo($revision); ?>/css/filesystem.css" type="text/css" media="handheld,tv" />

		<link rel="stylesheet" href="http://static.janoszen.com/b<?php echo($revision); ?>/css/print.css" type="text/css" media="print" />
		<link rel="stylesheet" href="http://static.janoszen.com/b<?php echo($revision); ?>/css/filesystem.css" type="text/css" media="print" />

		<link rel="stylesheet" href="http://static.janoszen.com/b<?php echo($revision); ?>/css/braille.css" type="text/css" media="braille,embossed" />
		<!--[if IE]>
			<link rel="stylesheet" href="http://static.janoszen.com/b<?php echo($revision); ?>/css/reset-ie.css" type="text/css" media="screen,tv,projection" />
			<script src="http://static.janoszen.com/b<?php echo($revision); ?>/js/html5.js"></script>
		<![endif]-->
		<?php if ( is_singular() ) wp_enqueue_script( 'comment-reply' ); ?> 
		<?php wp_head();
	$defaults = array(
                /* translators: Separator between blog name and feed type in feed links */
                'separator'     => _x('&raquo;', 'feed link'),
                /* translators: 1: blog title, 2: separator (raquo) */
                'feedtitle'     => __('%1$s %2$s Feed'),
                /* translators: %s: blog title, 2: separator (raquo) */
                'comstitle'     => __('%1$s %2$s Comments Feed'),
        );

        $args = wp_parse_args( $args, $defaults );

        echo '<link rel="alternate" type="' . feed_content_type() . '" title="' . esc_attr(sprintf( $args['feedtitle'], get_bloginfo('name'), $args['separator'] )) . '" href="' . get_feed_link() . "\" />\n";
?>
		<link rel="ICON" href="http://blog.janoszen.com/favicon.ico" />
		<link rel="SHORTCUT ICON" href="http://blog.janoszen.com/favicon.ico" />

		<script type="text/javascript"></script>
		<script language="javascript" type="text/javascript" src="http://wr.readspeaker.com/webreader/webreader.js.php?cid=7HMUCQV6QNI177YX4W0PWWBGM0D591R6"></script>
	</head>
	<body>
		<div id="container">
			<a class="permalink" href="#top" id="top"></a>
			<p class="braille-only"><a href="#maincontent">Jump to content</a></p>
			<header class="main">
				<h1><a href="<?php echo get_option('home'); ?>/"><span class="headertext"><?php bloginfo('name'); ?></span></a></h1>
			</header>

			<nav class="main">
				<ul>
					<li><a href="/">Home</a></li>
					<li><a href="/categories/it/">IT</a></li>
					<li><a href="/categories/irl/">In real life</a></li>
					<li><a href="/categories/projects/">Projects</a></li>
				</ul>
			</nav>

			<div class="main container_12">
				<section id="content" class="main grid_9<?php if(isset($listing) && $listing) { ?> listing<?php } ?>">
					<!--[if lte IE 6]>
						<div class="iewarning">
							<strong>Warning!</strong>
							Your browser is unsupported, therefore visual elements may appear incorrectly.
						</div>
					<![endif]-->
					<div class="braille-only" id="maincontent"></div>
<?php
$referer = strtolower($_SERVER['HTTP_REFERER']);
$refererhost = explode("/", $referer);
$refererhost = $refererhost[2];
if (strpos($refererhost,"google"))
{
	$a = substr($referer, strpos($referer,"q="));
	$a = substr($a,2);
	if (strpos($a,"&"))
	{
		$a = substr($a, 0,strpos($a,"&"));
	}	
	$googlekeyword = urldecode($a);
	if ($googlekeyword && stripos($_SERVER['HTTP_USER_AGENT'], "bot") === false)
	{
?>
	<section class="searchkeyword">
		<p>
			You came from <a href="<?php echo(htmlspecialchars($_SERVER['HTTP_REFERER'])); ?>">Google</a> searching for <strong><?php 
echo(htmlspecialchars($googlekeyword)); ?></strong>.
			If you are not looking for this content, you may try to <a href="/contact">contact me</a> about this possible topic.
		</p>
	</section>
<?php
	}
}
?>
<a href="http://wr.readspeaker.com/webreader/webreader.php?cid=7HMUCQV6QNI177YX4W0PWWBGM0D591R6&amp;t=web_free&amp;title=readspeaker&amp;url=" onclick="readpage(this.href+escape(document.location.href),1); return false;">
<img src="http://media.readspeaker.com/images/webreader/listen_en_us.gif" style="border-style: none;"  title="" alt="" /></a>
<div id="WR_1"></div>
<!-- RSPEAK_START -->
