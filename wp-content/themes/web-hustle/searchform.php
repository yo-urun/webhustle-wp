<?php
/**
 * The template for displaying search forms
 *
 * @package Web_Hustle
 */

?>
<form role="search" method="get" class="search-form relative" action="<?php echo esc_url( home_url( '/' ) ); ?>">
	<label>
		<span class="sr-only"><?php echo _x( 'Search for:', 'label', 'web-hustle' ); ?></span>
		<input type="search" class="search-field w-full px-6 py-4 bg-surface border border-transparent focus:border-accent rounded-xl outline-none transition-colors" placeholder="<?php echo esc_attr_x( 'Search &hellip;', 'placeholder', 'web-hustle' ); ?>" value="<?php echo get_search_query(); ?>" name="s" />
	</label>
	<button type="submit" class="search-submit absolute right-2 top-2 p-2 text-secondary hover:text-accent transition-colors">
		<svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
			<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
		</svg>
		<span class="sr-only"><?php echo _x( 'Search', 'submit button', 'web-hustle' ); ?></span>
	</button>
</form>
