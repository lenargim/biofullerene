<div class="not-find block">
	<div class="container">
		<h2 class="not-find__title">Can not find your answer?</h2>
		<div class="not-find__wrap">
			<a href="<?php echo get_permalink( get_page_by_path( 'shipping' ) ); ?>" class="not-find__item">
				<svg><use xlink:href="<?php echo IMAGES_PATH; ?>/sprite-found.svg#shipping"></use></svg>
				<div class="not-find__name">Shipping</div>
			</a>
			<a href="<?php echo get_page_link(327); ?>" class="not-find__item">
				<svg><use xlink:href="<?php echo IMAGES_PATH; ?>/sprite-found.svg#billing"></use></svg>
				<div class="not-find__name">Terms and Service</div>
			</a>
			<a href="<?php echo get_page_link(65) ?>" class="not-find__item">
				<svg><use xlink:href="<?php echo IMAGES_PATH; ?>/sprite-found.svg#return"></use></svg>
				<div class="not-find__name">Return Policy</div>
			</a>
			<a href="<?php echo get_post_type_archive_link('faq') ?>" class="not-find__item">
				<svg><use xlink:href="<?php echo IMAGES_PATH; ?>/sprite-found.svg#message"></use></svg>
				<div class="not-find__name">FAQ</div>
			</a>
		</div>
	</div>
</div>