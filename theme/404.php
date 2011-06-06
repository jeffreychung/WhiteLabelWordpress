<?php
/**
 * @package WordPress
 * @subpackage ME_Theme
 */

if (isset($GLOBAL['badrequest']))
{
        header("HTTP/1.1 400 Bad Request");
} else {
        header("HTTP/1.1 404 Not Found");
}

//This is removed, so we can pass variables.
//get_header();
include(dirname(__FILE__) . "/header.php");
?>
<section id="content" class="main">
	<article>
<?php
if (isset($GLOBAL['badrequest'])) {
?>
<h3>Hibás lekérdezés</h3>
<p>Sajnos az általad küldött címet (<?php echo($GLOBAL['badrequest']); ?>) az oldal nem tudta értelmezni. Esetleg
próbáld meg a <a href="/">főoldalt</a>.
<strong>Ha úgy érzed, hogy ennek működnie kellene, <a href="/kapcsolat">lépj kapcsolatba velem</a>!</strong></p>
<?php } else { ?>
<h3>Az oldal nem található</h3>
<p>Sajnos az oldal, amit keresel, nem található. Esetleg próbáld meg a <a href="/">főoldalt</a>. <strong>Ha úgy érzed,
hogy itt hiányzik egy cikk egy érdekes témában és szeretnéd, hogy ha megírnám, <a href="/kapcsolat">lépj kapcsolatba
velem</a>!</strong></p>
<?php } ?>
	</article>
</section>
<?php get_footer(); ?>
