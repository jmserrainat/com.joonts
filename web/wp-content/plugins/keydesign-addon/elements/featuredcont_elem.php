<?php

if (class_exists('WPBakeryShortCodesContainer')) {

    class WPBakeryShortCode_tek_featured_elem extends WPBakeryShortCodesContainer {

    }

}

if (class_exists('WPBakeryShortCode')) {

    class WPBakeryShortCode_tek_featured_elem_single extends WPBakeryShortCode {

    }

}

if (!class_exists('tek_featured_elem')) {

    class tek_featured_elem extends KEYDESIGN_ADDON_CLASS

    {

        function __construct() {

            add_action('init', array($this, 'kd_featured_init'));

            add_shortcode('tek_featured_elem', array($this, 'kd_featured_container'));

            add_shortcode('tek_featured_elem_single', array($this, 'kd_featured_single'));

        }

        // Element configuration in admin

        function kd_featured_init() {

            // Container element configuration

            if (function_exists('vc_map')) {

                vc_map(array(

                    "name" => esc_html__("Featured content", "keydesign"),

                    "description" => esc_html__("Advanced featured content with smooth animations.", "keydesign"),

                    "base" => "tek_featured_elem",

                    "class" => "",

                    "show_settings_on_create" => true,

                    "content_element" => true,

                    "as_parent" => array('only' => 'tek_featured_elem_single'),

                    "icon" => plugins_url('assets/element_icons/featured-content.png', dirname(__FILE__)),

                    "category" => esc_html__("KeyDesign Elements", "keydesign"),

                    "js_view" => 'VcColumnView',

                    "params" => array(

                        array(

                            "type" => "textfield",

                            "class" => "",

                            "heading" => esc_html__("Extra class name", "keydesign"),

                            "param_name" => "featured_extra_class",

                            "value" => "",

                            "description" => esc_html__("If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file.", "keydesign")

                        ),

                    )

                ));

                // Shortcode configuration

                vc_map(array(

                    "name" => esc_html__("Featured item", "keydesign"),

                    "base" => "tek_featured_elem_single",

                    "content_element" => true,

                    "as_child" => array('only' => 'tek_featured_elem'),

                    "icon" => plugins_url('assets/element_icons/child-tabs.png', dirname(__FILE__)),

                    "params" => array(

                        array(

                            "type" => "textfield",

                            "class" => "",

                            "heading" => esc_html__("Title", "keydesign"),

                            "param_name" => "featured_title",

                            "admin_label" => true,

                            "value" => "",

                            "description" => esc_html__("Enter item title here.", "keydesign")

                        ),



                        array(

                            "type" => "textarea",

                            "class" => "",

                            "heading" => esc_html__("Description", "keydesign"),

                            "param_name" => "featured_description",

                            "value" => "",

                            "description" => esc_html__("Enter item description here.", "keydesign")

                        ),



                        array(

                            "type" => "attach_image",

                            "class" => "",

                            "heading" => esc_html__("Upload image", "keydesign"),

                            "param_name" => "featured_img",

                            "value" => "",

                            "description" => esc_html__("Upload your own custom image.", "keydesign"),

                        ),



                        array(

                             "type"	=>	"dropdown",

                             "class" =>	"",

                             "heading" => esc_html__("Link type", "keydesign"),

                             "param_name" => "custom_link",

                             "value" =>	array(

                                    esc_html__( 'No link', 'keydesign' ) => '#',

                                    esc_html__( 'Add a custom link', 'keydesign' )	=> '1',

                                ),

                             "save_always" => true,

                             "description" => esc_html__("You can add/remove custom link", "keydesign"),

                        ),



                        array(

                             "type"	=>	"vc_link",

                             "class" =>	"",

                             "heading" => esc_html__("Link settings", "keydesign"),

                             "param_name" => "featured_link",

                             "value" =>	"",

                             "description" => esc_html__("You can add or remove the existing link from here.", "keydesign"),

                             "dependency" => array(

                                "element" => "custom_link",

                                "value"	=> array( "1" ),

                            ),

                        ),



                        array(

                            "type" =>	"dropdown",

                            "class"	=>	"",

                            "heading" =>	esc_html__("Active element","keydesign"),

                            "param_name" =>	"featured_active",

                            "value" =>	array(

                                    "No" => "active_no",

                                    "Yes" => "active_yes",

                                ),

                            "save_always" => true

                        ),

                    )

                ));

            }

        }



        public function kd_featured_container($atts, $content = null) {

            extract(shortcode_atts(array(

                'featured_extra_class'          => '',

            ), $atts));

            $output = '

            <div class="featured_content_parent row '.$featured_extra_class.'"><div class="container">'.do_shortcode($content).'</div></div>';

            return $output;

        }



        public function kd_featured_single($atts, $content = null) {

            extract(shortcode_atts(array(

                'featured_title'            => '',

                'featured_description'      => '',

                'featured_img'              => '',

                'custom_link'               => '',

                'featured_link'             => '',

                'featured_active'           => '',

            ), $atts));



            $featured_active_class = $link_title = $link_target = '';



            $image  = wpb_getImageBySize($params = array(

                'post_id' => NULL,

                'attach_id' => $featured_img,

                'thumb_size' => 'full',

                'class' => ""

            ));



            // Active element

            if( $featured_active == 'active_no' ) {

                $featured_active_class = '';

            }

            elseif ( $featured_active == 'active_yes' ) {

                $featured_active_class = 'active-elem';

            }



            $output = '<div class="featured_content_child col-xs-12 col-sm-12 col-md-4 col-lg-4 '.$featured_active_class.'">';

                        if($custom_link !== '#'){

                            $href = vc_build_link($featured_link);

                            if($href['url'] !== "") {

                                $link_target = (isset($href['target']) && ($href['target'] != '')) ? ' target="'.$href['target'].'"' : '';

                                $link_title = (isset($href['title'])) ? ' title="'.$href['title'].'"' : '';

                            }

                            $output .= '<a href="'.$href['url'].'"'.$link_target.''.$link_title.'>';

                            $output .= '<h4>'.$featured_title.'</h4>';
                            $output .= '<p>'.$featured_description.'</p>';
                            $output .= '<div class="featured_content_img">'.$image['thumbnail'].'</div>';

                            $output .= '</a>';

                        } else {

                            $output .= '<h4>'.$featured_title.'</h4>';
                            $output .= '<p>'.$featured_description.'</p>';
                            $output .= '<div class="featured_content_img">'.$image['thumbnail'].'</div>';

                        }

                        $output .= '</div>';

            return $output;

        }

    }

}

if (class_exists('tek_featured_elem')) {

    $tek_featured_elem = new tek_featured_elem;

}

?>
