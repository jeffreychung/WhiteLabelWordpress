<form class="search" method="get" action="<?php echo(get_option('home')); ?>/" >
<?php $id = "s-" . md5(rand(1,10000)); ?>
	<label for="<?php echo($id); ?>"><?php echo(__('Search for:')); ?></label>
	<input class="text" id="<?php echo($id); ?>" name="s" type="text" placeholder="Search for what?"<?php if (apply_filters('the_search_query', get_search_query())) : ?> 
value="<?php 
esc_attr(apply_filters('the_search_query', get_search_query())) 
?>"<?php
endif;
if (!isset($GLOBALS['firstform'])) {
$GLOBALS['firstform'] = false;
?> autofocus="autofocus"<?php } ?> />
        <input type="submit" class="submit" value="<?php echo(esc_attr__('Search')); ?>" />
</form>
