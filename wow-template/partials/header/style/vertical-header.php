<?php
/**
 * Vertical Header Style
 *
 * @package WooVina WordPress theme
 */

// Exit if accessed directly
if(! defined('ABSPATH')) {
    exit;
}

// Get template
$template = get_theme_mod('woovina_vertical_header_template');

// Check if template is created with Elementor
$elementor = get_post_meta($template, '_elementor_edit_mode', true);

// Get template content
if(! empty($template)) {

    $content = get_post($template);

    if($content && ! is_wp_error($content)) {
        $get_content = $content->post_content;
    }

}

// Get bottom template
$bottom_template = get_theme_mod('woovina_vertical_header_bottom_template');

// Check if template is created with Elementor
$bottom_elementor = get_post_meta($bottom_template, '_elementor_edit_mode', true);

// Get bottom template content
if(! empty($bottom_template)) {

    $bottom_content = get_post($bottom_template);

    if($bottom_content && ! is_wp_error($bottom_content)) {
        $get_bottom_content = $bottom_content->post_content;
    }

}

// Get classes
$classes = array('clr');

// If template
if(! empty($template)) {
    $classes[] = 'has-template';
}

// Add container class
if(true != get_theme_mod('woovina_header_full_width', false)) {
    $classes[] = 'container';
}

// Turn classes into space seperated string
$classes = implode(' ', $classes); ?>

<?php do_action('woovina_before_header_inner'); ?>

<div id="site-header-inner" class="<?php echo esc_attr($classes); ?>">

    <?php get_template_part('partials/header/logo'); ?>

    <?php
    // If template
    if(! empty($template)) {

        // If Elementor
        if(WOOVINA_ELEMENTOR_ACTIVE && $elementor) {

            WooVina_Elementor::get_vertical_header_content();

        }

        // If Beaver Builder
        else if(WOOVINA_BEAVER_BUILDER_ACTIVE && ! empty($template)) {

            echo woovina_shortcode('[fl_builder_insert_layout id="' . $template . '"]');

        }

        // Else
        else {

            // Display template content
            echo woovina_shortcode($get_content);

        }

    } else { ?>

        <?php get_template_part('partials/header/nav'); ?>

        <?php
        // Search form
        if(true == get_theme_mod('woovina_vertical_header_search_form', true)) {
            get_template_part('partials/header/style/vertical-header-search');
        } ?>
        
        <?php
        // Social menu
        if(true == get_theme_mod('woovina_menu_social', false)) {
            get_template_part('partials/header/social');
        } ?>

        <?php
        // If bottom template
        if(! empty($bottom_template)) {

            // If Elementor
            if(WOOVINA_ELEMENTOR_ACTIVE && $bottom_elementor) {

                WooVina_Elementor::get_vertical_header_bottom_content();

            }

            // If Beaver Builder
            else if(WOOVINA_BEAVER_BUILDER_ACTIVE && ! empty($bottom_template)) {

                echo woovina_shortcode('[fl_builder_insert_layout id="' . $bottom_template . '"]');

            }

            // Else
            else {

                // Display bottom template content
                echo woovina_shortcode($get_bottom_content);

            }

        } ?>

    <?php
    } ?>

    <?php get_template_part('partials/mobile/mobile-icon'); ?>

    <?php get_template_part('partials/header/style/vertical-header-toggle'); ?>

</div>

<?php get_template_part('partials/mobile/mobile-dropdown'); ?>

<?php do_action('woovina_after_header_inner'); ?>