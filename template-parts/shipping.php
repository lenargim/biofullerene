<?php $delivery_zones = WC_Shipping_Zones::get_zones( 'values' ); ?>

<div class="shipping" id="shipping" style="position: relative">
    <div class="shipping__title">
        <span>Shipping to:</span>
        <div class="tooltip__wrap">
            <svg width="16" height="16" viewBox="0 0 16 16" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path d="M6.05967 5.99998C6.21641 5.55442 6.52578 5.17872 6.93298 4.9394C7.34018 4.70009 7.81894 4.61261 8.28446 4.69245C8.74998 4.7723 9.17222 5.01433 9.47639 5.37567C9.78057 5.737 9.94705 6.19433 9.94634 6.66665C9.94634 7.99998 7.94634 8.66665 7.94634 8.66665M7.99967 11.3333H8.00634M14.6663 7.99998C14.6663 11.6819 11.6816 14.6666 7.99967 14.6666C4.31778 14.6666 1.33301 11.6819 1.33301 7.99998C1.33301 4.31808 4.31778 1.33331 7.99967 1.33331C11.6816 1.33331 14.6663 4.31808 14.6663 7.99998Z"
                      stroke="#8791A1" stroke-width="1.4" stroke-linecap="round" stroke-linejoin="round"/>
            </svg>
			<?php if ( get_field( 'title', 63 ) ): ?>
                <div class="tooltip">
                    <div class="tooltip__title"><?php the_field( 'title', 63 ) ?></div>
					<?php if ( get_field( 'description', 63 ) ): ?>
                        <div class="tooltip__description"><?php the_field( 'description', 63 ) ?></div>
					<?php endif; ?>
                </div>
			<?php endif; ?>
        </div>
    </div>
    <select class="shipping__list" id="shipping__list">
		<?php foreach ( (array) $delivery_zones as $key => $the_zone ): ?>
            <!--			--><?php //echo var_dump($the_zone) ?>
            <option value="<?php echo $the_zone['zone_name']; ?>"
                    class="shipping__item"><?php echo $the_zone['zone_name']; ?></option>
		<?php endforeach; ?>
    </select>
</div>
