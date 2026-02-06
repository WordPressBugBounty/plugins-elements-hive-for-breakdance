<?php

namespace ElementsHiveForBreakdance\Admin\Parts\InfoCard;

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

use function ElementsHiveForBreakdance\Admin\Parts\LinkButton\render as render_link_button;

function render( $classes, $title, $description, $has_button = false, $button_url = null, $button_text = null ) {
	?>
	<div class="eh-adm-info-card <?php echo esc_attr( $classes ); ?> eh-adm-flex eh-adm-flex-col eh-adm-items-start eh-adm-gap-lg eh-adm-bg-alt eh-adm-p-lg eh-adm-rounded-md">
		<h3 class="eh-adm-info-card__title eh-adm-card__heading"><?php echo esc_html( $title ); ?></h3>
		<p class="eh-adm-info-card__description eh-adm-m-0"><?php echo esc_html( $description ); ?></p>
		<?php if ( $has_button ) : ?>
			<span class="eh-adm-mt-auto">
				<?php render_link_button( $button_url, $button_text, 'secondary' ); ?>
			</span>
		<?php endif; ?>
	</div>
	<?php
}