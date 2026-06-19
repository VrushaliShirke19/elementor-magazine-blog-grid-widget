<?php

if (!defined('ABSPATH')) {
    exit;
}

class MBGW_Magazine_Grid_Widget extends \Elementor\Widget_Base {

    public function get_name() {
        return 'magazine_grid';
    }

    public function get_title() {
        return 'Magazine Blog Grid';
    }

    public function get_icon() {
        return 'eicon-post-list';
    }

    public function get_categories() {
        return ['general'];
    }

    protected function register_controls() {

        /*
        |--------------------------------------------------------------------------
        | Content Settings
        |--------------------------------------------------------------------------
        */

        $categories = get_categories();
        $options = [];

        foreach ($categories as $category) {
            $options[$category->slug] = $category->name;
        }

        $this->start_controls_section(
            'content_section',
            [
                'label' => 'Content',
                'tab'   => \Elementor\Controls_Manager::TAB_CONTENT,
            ]
        );

        $this->add_control(
            'category',
            [
                'label'   => 'Category',
                'type'    => \Elementor\Controls_Manager::SELECT,
                'options' => $options,
            ]
        );

        $this->add_control(
            'show_date',
            [
                'label'        => 'Show Date',
                'type'         => \Elementor\Controls_Manager::SWITCHER,
                'label_on'     => 'Yes',
                'label_off'    => 'No',
                'return_value' => 'yes',
                'default'      => 'yes',
            ]
        );

        $this->add_control(
            'show_pagination',
            [
                'label'        => 'Show Pagination',
                'type'         => \Elementor\Controls_Manager::SWITCHER,
                'label_on'     => 'Yes',
                'label_off'    => 'No',
                'return_value' => 'yes',
                'default'      => 'yes',
            ]
        );

        $this->end_controls_section();

        /*
        |--------------------------------------------------------------------------
        | Layout Style
        |--------------------------------------------------------------------------
        */

        $this->start_controls_section(
            'layout_style_section',
            [
                'label' => 'Layout',
                'tab'   => \Elementor\Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_responsive_control(
            'card_height',
            [
                'label' => 'Card Height',
                'type'  => \Elementor\Controls_Manager::SLIDER,

                'size_units' => ['px', 'vh'],

                'range' => [
                    'px' => [
                        'min' => 100,
                        'max' => 800,
                    ],
                    'vh' => [
                        'min' => 10,
                        'max' => 100,
                    ],
                ],

                'default' => [
                    'unit' => 'px',
                    'size' => 320,
                ],

                'selectors' => [
                    '{{WRAPPER}} .mag-card' => 'height: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'grid_gap',
            [
                'label' => 'Grid Gap',
                'type'  => \Elementor\Controls_Manager::SLIDER,

                'size_units' => ['px'],

                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 100,
                    ],
                ],

                'default' => [
                    'unit' => 'px',
                    'size' => 10,
                ],

                'selectors' => [
                    '{{WRAPPER}} .magazine-grid' => 'gap: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->end_controls_section();

        /*
        |--------------------------------------------------------------------------
        | Overlay Style
        |--------------------------------------------------------------------------
        */

        $this->start_controls_section(
            'overlay_style_section',
            [
                'label' => 'Overlay',
                'tab'   => \Elementor\Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_control(
            'overlay_color',
            [
                'label' => 'Overlay Color',
                'type'  => \Elementor\Controls_Manager::COLOR,

                'selectors' => [
                    '{{WRAPPER}} .overlay' => 'background: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'overlay_hover_color',
            [
                'label' => 'Hover Overlay Color',
                'type'  => \Elementor\Controls_Manager::COLOR,

                'selectors' => [
                    '{{WRAPPER}} .mag-card:hover .overlay' => 'background: {{VALUE}};',
                ],
            ]
        );

        $this->end_controls_section();

        /*
        |--------------------------------------------------------------------------
        | Title Style
        |--------------------------------------------------------------------------
        */

        $this->start_controls_section(
            'title_style_section',
            [
                'label' => 'Title',
                'tab'   => \Elementor\Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_group_control(
            \Elementor\Group_Control_Typography::get_type(),
            [
                'name'     => 'title_typography',
                'selector' => '{{WRAPPER}} .mag-card h2, {{WRAPPER}} .mag-card h3',
            ]
        );

        $this->add_control(
            'title_color',
            [
                'label' => 'Color',
                'type'  => \Elementor\Controls_Manager::COLOR,

                'selectors' => [
                    '{{WRAPPER}} .mag-card h2, {{WRAPPER}} .mag-card h3' => 'color: {{VALUE}};',
                ],
            ]
        );

             $this->add_group_control(
                \Elementor\Group_Control_Text_Shadow::get_type(),
                [
                    'name' => 'title_text_shadow',
                    'selector' => '{{WRAPPER}} .mag-card h2, {{WRAPPER}} .mag-card h3',
                ]
            );

        $this->end_controls_section();

        /*
        |--------------------------------------------------------------------------
        | Date Style
        |--------------------------------------------------------------------------
        */

        $this->start_controls_section(
            'date_style_section',
            [
                'label' => 'Date',
                'tab'   => \Elementor\Controls_Manager::TAB_STYLE,

                'condition' => [
                    'show_date' => 'yes',
                ],
            ]
        );

        $this->add_group_control(
            \Elementor\Group_Control_Typography::get_type(),
            [
                'name'     => 'date_typography',
                'selector' => '{{WRAPPER}} .post-date',
            ]
        );

        $this->add_control(
            'date_color',
            [
                'label' => 'Color',
                'type'  => \Elementor\Controls_Manager::COLOR,

                'selectors' => [
                    '{{WRAPPER}} .post-date' => 'color: {{VALUE}};',
                ],
            ]
        );

            $this->add_group_control(
                \Elementor\Group_Control_Text_Shadow::get_type(),
                [
                    'name' => 'date_text_shadow',
                    'selector' => '{{WRAPPER}} .post-date',
                ]
            );
    
        $this->end_controls_section();

            /*
        |--------------------------------------------------------------------------
        | Pagination Style
        |--------------------------------------------------------------------------
        */

        $this->start_controls_section(
            'pagination_style_section',
            [
                'label' => 'Pagination',
                'tab'   => \Elementor\Controls_Manager::TAB_STYLE,

                'condition' => [
                    'show_pagination' => 'yes',
                ],
            ]
        );

        /* Typography */

        $this->add_group_control(
            \Elementor\Group_Control_Typography::get_type(),
            [
                'name'     => 'pagination_typography',
                'selector' => '{{WRAPPER}} .mag-pagination .page-numbers',
            ]
        );

        /* Tabs */

        $this->start_controls_tabs('pagination_tabs');

        /* ---------------------------
        Normal Tab
        --------------------------- */

        $this->start_controls_tab(
            'pagination_normal_tab',
            [
                'label' => 'Normal',
            ]
        );

        $this->add_control(
            'pagination_text_color',
            [
                'label' => 'Text Color',
                'type'  => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .mag-pagination .page-numbers' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'pagination_bg_color',
            [
                'label' => 'Background Color',
                'type'  => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .mag-pagination .page-numbers' => 'background-color: {{VALUE}};',
                ],
            ]
        );

        $this->end_controls_tab();

        /* ---------------------------
        Hover Tab
        --------------------------- */

        $this->start_controls_tab(
            'pagination_hover_tab',
            [
                'label' => 'Hover',
            ]
        );

        $this->add_control(
            'pagination_hover_text_color',
            [
                'label' => 'Text Color',
                'type'  => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .mag-pagination .page-numbers:hover' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'pagination_hover_bg_color',
            [
                'label' => 'Background Color',
                'type'  => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .mag-pagination .page-numbers:hover' => 'background-color: {{VALUE}};',
                ],
            ]
        );

        $this->end_controls_tab();

        /* ---------------------------
        Active Tab
        --------------------------- */

        $this->start_controls_tab(
            'pagination_active_tab',
            [
                'label' => 'Active',
            ]
        );

        $this->add_control(
            'pagination_active_text_color',
            [
                'label' => 'Text Color',
                'type'  => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .mag-pagination .current' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'pagination_active_bg_color',
            [
                'label' => 'Background Color',
                'type'  => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .mag-pagination .current' => 'background-color: {{VALUE}};',
                ],
            ]
        );

        $this->end_controls_tab();

        $this->end_controls_tabs();

        /* Padding */

        $this->add_responsive_control(
            'pagination_padding',
            [
                'label' => 'Padding',
                'type'  => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px'],
                'selectors' => [
                    '{{WRAPPER}} .mag-pagination .page-numbers' =>
                        'padding: {{TOP}}px {{RIGHT}}px {{BOTTOM}}px {{LEFT}}px;',
                ],
            ]
        );

        /* Border Radius */

        $this->add_responsive_control(
            'pagination_border_radius',
            [
                'label' => 'Border Radius',
                'type'  => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px'],
                'selectors' => [
                    '{{WRAPPER}} .mag-pagination .page-numbers' =>
                        'border-radius: {{TOP}}px {{RIGHT}}px {{BOTTOM}}px {{LEFT}}px;',
                ],
            ]
        );

        /* Spacing */

        $this->add_responsive_control(
            'pagination_margin',
            [
                'label' => 'Spacing Between Items',
                'type'  => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px'],
                'selectors' => [
                    '{{WRAPPER}} .mag-pagination .page-numbers' =>
                        'margin: {{TOP}}px {{RIGHT}}px {{BOTTOM}}px {{LEFT}}px;',
                ],
            ]
        );  

         $this->end_controls_section();

    }
    protected function render() {

        $settings = $this->get_settings_for_display();

        $paged = max(
            1,
            get_query_var('paged'),
            get_query_var('page')
        );

        $args = [
            'post_type'      => 'post',
            'posts_per_page' => 5,
            'paged'          => $paged,
            'post_status'    => 'publish',
            'category_name'  => !empty($settings['category']) ? $settings['category'] : '',
        ];

        $query = new WP_Query($args);

        if (!$query->have_posts()) {
            echo '<p>No posts found.</p>';
            return;
        }

        $posts = $query->posts;

        echo '<div class="magazine-grid">';

        foreach ($posts as $index => $post) {

            $class = 'small';

            if ($index == 0) {
                $class = 'large';
            } elseif ($index == 1) {
                $class = 'top-small';
            }

            echo '<div class="mag-card ' . esc_attr($class) . '">';

            echo '<a href="' . esc_url(get_permalink($post->ID)) . '">';

                    if (has_post_thumbnail($post->ID)) {

                echo get_the_post_thumbnail(
                    $post->ID,
                    'large',
                    [
                        'alt' => esc_attr($post->post_title)
                    ]
                );

            } else {

            echo '<img src="' .
                plugin_dir_url(dirname(__FILE__)) .
                'assets/images/placeholder.jpg" alt="Placeholder">';
        }

            echo '<div class="overlay">';

            if ($index == 0) {
                echo '<h2>' . esc_html($post->post_title) . '</h2>';
            } else {
                echo '<h3>' . esc_html($post->post_title) . '</h3>';
            }

            if (
                isset($settings['show_date']) &&
                $settings['show_date'] === 'yes'
            ) {

                echo '<span class="post-date">';
                echo esc_html(
                    get_the_date('F j, Y', $post->ID)
                );
                echo '</span>';
            }

            echo '</div>';

            echo '</a>';

            echo '</div>';
        }

        echo '</div>';

        if (
            isset($settings['show_pagination']) &&
            $settings['show_pagination'] === 'yes'
        ) {

            echo '<div class="mag-pagination">';

            echo paginate_links([
                'total'     => $query->max_num_pages,
                'current'   => $paged,
                'prev_text' => '&laquo; Previous',
                'next_text' => 'Next &raquo;',
            ]);

            echo '</div>';
        }



        wp_reset_postdata();
    }
}