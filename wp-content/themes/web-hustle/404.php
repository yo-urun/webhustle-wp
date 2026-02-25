<?php
/**
 * The template for displaying 404 pages (not found)
 *
 * @package Web_Hustle
 */

defined( 'ABSPATH' ) || exit;

get_header();
?>

<main id="primary" class="site-main container mx-auto px-4 py-32 flex flex-col items-center justify-center text-center">
	<div class="error-404-content max-w-2xl">
		<div class="error-code text-[12rem] font-black text-[var(--wh-surface)] leading-none mb-8 select-none">
			404
		</div>
		
		<h1 class="text-4xl md:text-5xl font-bold tracking-tight text-[var(--wh-primary)] mb-6">
			<?php esc_html_e( 'Oops! Page Not Found', 'web-hustle' ); ?>
		</h1>
		
		<p class="text-lg text-[var(--wh-secondary)] mb-12 leading-relaxed">
			<?php esc_html_e( 'The page you are looking for might have been removed, had its name changed, or is temporarily unavailable.', 'web-hustle' ); ?>
		</p>

		<div class="flex flex-col sm:flex-row gap-4 justify-center">
			<a href="<?php echo esc_url( home_url( '/' ) ); ?>" class="inline-flex items-center justify-center px-8 py-4 bg-[var(--wh-accent)] text-white font-bold rounded-xl shadow-lg hover:opacity-90 transition-all duration-300 transform hover:-translate-y-1">
				<svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
					<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6" />
				</svg>
				<?php esc_html_e( 'Back to Home', 'web-hustle' ); ?>
			</a>
			
			<button onclick="history.back()" class="inline-flex items-center justify-center px-8 py-4 border-2 border-[var(--wh-surface)] text-[var(--wh-primary)] font-bold rounded-xl hover:bg-[var(--wh-surface)] transition-all duration-300">
				<svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
					<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
				</svg>
				<?php esc_html_e( 'Go Back', 'web-hustle' ); ?>
			</button>
		</div>
	</div>
</main>

<?php
get_footer();
