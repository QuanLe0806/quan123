<?php

namespace DynamicContentForElementor\Includes\Skins;

if (!\defined('ABSPATH')) {
    exit;
    // Exit if accessed directly
}
class Metabox_Relationship_Skin_Timeline extends \DynamicContentForElementor\Includes\Skins\Skin_Timeline
{
    /**
     * Register Controls Actions
     *
     * @return void
     */
    protected function _register_controls_actions()
    {
        add_action('elementor/element/dce-metabox-relationship/section_query/after_section_end', [$this, 'register_controls_layout']);
        add_action('elementor/element/dce-metabox-relationship/section_dynamicposts/after_section_end', [$this, 'register_additional_timeline_controls']);
    }
}