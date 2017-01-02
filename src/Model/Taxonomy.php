<?php

namespace Sober\Models\Model;

use Sober\Models\Model;

class Taxonomy extends Model
{
    // data req for register_taxonomy()
    protected $links = 'post';

    public function run()
    {
        // configs
        $this->setConfigDefaults();
        $this->setConfig();
        $this->setLinks();
        // labels
        $this->setLabelDefaults();
        $this->setLabels();
        // args and register
        $this->mergeArgs();
        $this->registerTaxonomy();
    }

    /**
     * Set config defaults
     *
     * Make public and change menu position
     */
    protected function setConfigDefaults()
    {
        if ($this->data['config']) {
            $this->config = $this->data['config'];
        }
    }

    /**
     * Set links
     *
     * Place array keys into a single value array if value is true
     */
    protected function setLinks()
    {
        if ($this->data['links']) {
            $this->links = $this->data['links'];
        }
    }

    /**
     * Set default labels
     *
     * Create an labels array and implement default singular and plural labels
     */
    protected function setLabelDefaults()
    {
        $this->labels = [
            'name'                       => _x($this->many, 'Taxonomy general name', $this->i18n),
            'singular_name'              => _x($this->one, 'Taxonomy singular name', $this->i18n),
            'search_items'               => __('Search ' . $this->many, $this->i18n),
            'popular_items'              => __('Popular ' . $this->many, $this->i18n),
            'all_items'                  => __('All ' . $this->many, $this->i18n),
            'parent_item'                => __('Parent ' . $this->one, $this->i18n),
            'parent_item_colon'          => __('Parent ' . $this->one . ':', $this->i18n),
            'edit_item'                  => __('Edit ' . $this->one, $this->i18n),
            'view_item'                  => __('View ' . $this->one, $this->i18n),
            'update_item'                => __('Update ' . $this->one, $this->i18n),
            'add_new_item'               => __('Add New ' . $this->one, $this->i18n),
            'new_item_name'              => __('New ' . $this->one . ' Name', $this->i18n),
            'separate_items_with_commas' => __('Separate ' . strtolower($this->many) . ' with commas', $this->i18n),
            'add_or_remove_items'        => __('Add or remove '. strtolower($this->many), $this->i18n),
            'choose_from_most_used'      => __('Choose from the most used ' . strtolower($this->many), $this->i18n),
            'not_found'                  => __('No ' . strtolower($this->many) . ' found.', $this->i18n),
            'no_terms'                   => __('No ' . strtolower($this->many), $this->i18n),
            'items_list_navigation'      => __($this->many . ' list navigation', $this->i18n),
            'items_list'                 => __($this->many . ' list', $this->i18n)
        ];
    }

    /**
     * Merge arguments
     *
     * Array to be passed to WP register_taxonomy()
     */
    protected function mergeArgs()
    {
        $this->args = [
            'labels' => $this->labels
        ];
        $this->args = array_merge($this->args, $this->config);
    }

    /**
     * Register Post Type
     *
     * Run WP register_taxonomy()
     */
    protected function registerTaxonomy()
    {
        register_taxonomy($this->name, $this->links, $this->args);
    }
}