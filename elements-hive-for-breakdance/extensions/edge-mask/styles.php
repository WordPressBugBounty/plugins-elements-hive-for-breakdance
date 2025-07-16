<?php

namespace ElementsHiveForBreakdance\Extensions\EdgeMask;

add_filter( 'breakdance_element_css_template', 'ElementsHiveForBreakdance\Extensions\EdgeMask\addStyles', 100, 1 );

/**
 * @param string $css_template
 * @return string
 */
function addStyles( $css_template ) {
  
	return $css_template . "\n\n" . '
        %%SELECTOR%% {
            --edge-mask-radial-fade-size: {{ design.elements_hive.edge_mask.mask_size.style }};
            --edge-mask-fade-size-left: {{ design.elements_hive.edge_mask.mask_size_left.style }};
            --edge-mask-fade-size-right: {{ design.elements_hive.edge_mask.mask_size_right.style }};  
            --edge-mask-fade-size-top: {{ design.elements_hive.edge_mask.mask_size_top.style }};
            --edge-mask-fade-size-bottom: {{ design.elements_hive.edge_mask.mask_size_bottom.style }};
   
        {% if design.elements_hive.edge_mask.enabled and design.elements_hive.edge_mask.axis == "horizontal" and design.elements_hive.edge_mask.style == "linear" %}
            -webkit-mask-image: linear-gradient(to right, transparent 0%, black var(--edge-mask-fade-size-left, 0%), black calc(100% - var(--edge-mask-fade-size-right, 0%)), transparent 100%);
            mask-image: linear-gradient(to right, transparent 0%, black var(--edge-mask-fade-size-left, 0%), black calc(100% - var(--edge-mask-fade-size-right, 0%)), transparent 100%);
        {% endif %}
        {% if design.elements_hive.edge_mask.enabled and design.elements_hive.edge_mask.axis == "vertical" and design.elements_hive.edge_mask.style == "linear" %}
            -webkit-mask-image: linear-gradient(to bottom, transparent 0%, black var(--edge-mask-fade-size-top, 0%), black calc(100% - var(--edge-mask-fade-size-bottom, 0%)), transparent 100%);
            mask-image: linear-gradient(to bottom, transparent 0%, black var(--edge-mask-fade-size-top, 0%), black calc(100% - var(--edge-mask-fade-size-bottom, 0%)), transparent 100%);
        {% endif %}
        {% if design.elements_hive.edge_mask.enabled and design.elements_hive.edge_mask.style == "radial" %}
            -webkit-mask-image: radial-gradient(circle, black 50%, transparent calc(100% - var(--edge-mask-radial-fade-size, 0%)));
            mask-image: radial-gradient(circle, black 50%, transparent calc(100% - var(--edge-mask-radial-fade-size, 0%)));
        {% endif %}
    }
    ';
}
