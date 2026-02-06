<?php

namespace ElementsHiveForBreakdance\Admin\Pages\Home;

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

use function ElementsHiveForBreakdance\Admin\Parts\Header\render as render_header;
use function ElementsHiveForBreakdance\Admin\Parts\InfoCard\render as render_info_card;

function render() {
	?>

		<div class='eh-adm-body eh-adm-flex eh-adm-flex-col eh-adm-gap-lg eh-adm-p-lg eh-adm-bg eh-adm-rounded-xl'>

			<?php render_header(); ?>

			<div class="eh-adm-main eh-adm-flex eh-adm-flex-col eh-adm-p-lg eh-adm-text-alt eh-adm-flex-1 eh-adm-gap-lg">
				
				<div class="eh-adm-section eh-adm-flex eh-adm-flex-col eh-adm-gap-xl eh-adm-items-center eh-adm-justify-center">
				<h1 class="eh-adm-text-5xl eh-adm-text-center eh-adm-line-height-lg eh-adm-mt-lg"><span><?php esc_html_e( 'The Leading ', 'elements-hive-for-breakdance' ); ?></span><br><span class="eh-adm-text-accent"><?php esc_html_e( 'Breakdance', 'elements-hive-for-breakdance' ); ?></span><span> Add‑on</span></h1>
				<p class="eh-adm-w-60 eh-adm-text-center eh-adm-text-xl "><span><?php esc_html_e( 'Unlock even more creative possibilities with additional unique elements, extensions, and demo sections in ', 'elements-hive-for-breakdance' ); ?></span><a class="eh-adm-text-accent" href="https://elementshive.com/#pricing" target="_blank"><?php esc_html_e( 'Elements Hive Pro', 'elements-hive-for-breakdance' ); ?></a></p>
				<div class="eh-adm-video-container eh-adm-rounded-lg eh-adm-mb-lg">
						<iframe class="eh-adm-rounded-lg"width="100%" height="100%" src="https://www.youtube.com/embed/dvad_X3m7HY?si=wQUlBftxINM2HzdI" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" referrerpolicy="strict-origin-when-cross-origin" allowfullscreen></iframe>
					</div>
					
				</div>
				
				<div class="eh-adm-section eh-adm-flex eh-adm-flex-col eh-adm-gap-xl">
					<h2 class="eh-adm-text-4xl"><?php esc_html_e( 'Resources', 'elements-hive-for-breakdance' ); ?></h2>
					<div class="eh-adm-cards-grid eh-adm-grid eh-adm-grid-auto-fit eh-adm-gap-lg">
						<?php
							render_info_card(
								'eh-adm-cards-grid__item',
								__( 'Documentation Hub', 'elements-hive-for-breakdance' ),
								__( 'Explore detailed explanations of every setting across all Elements and Extensions, empowering you to harness the full potential of Elements Hive.', 'elements-hive-for-breakdance' ),
								true,
								'https://elementshive.com/documentation',
								__( 'Read', 'elements-hive-for-breakdance' )
							);
							render_info_card(
								'eh-adm-cards-grid__item',
								__( 'Community Hub', 'elements-hive-for-breakdance' ),
								__( 'Connect with a vibrant community of users in our official Facebook group. Get insider tips, share insights, and seek inspiration as you navigate your journey with Elements Hive. Engage with fellow users for support, collaboration.', 'elements-hive-for-breakdance' ),
								true, 'https://www.facebook.com/groups/elementshiveforbreakdance',
								__( 'Join', 'elements-hive-for-breakdance' )
							);
							render_info_card(
								'eh-adm-cards-grid__item',
								__( 'Youtube Channel', 'elements-hive-for-breakdance' ),
								__( 'Subscribe to our official YouTube channel for exclusive content and updates. Access walkthrough videos, informative tutorials, and exciting previews that offer a firsthand look into Elements Hive.', 'elements-hive-for-breakdance' ),
								true,
								'https://www.youtube.com/@elementshive',
								__( 'Subscribe', 'elements-hive-for-breakdance' )
							);
						?>
						
					</div>
				</div>
			</div>

		</div>
	<?php
}

