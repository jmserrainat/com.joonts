<?php
if (!class_exists('KD_ELEM_BUTTON')) {
    class KD_ELEM_BUTTON extends KEYDESIGN_ADDON_CLASS {
        function __construct() {
            add_action('init', array($this, 'kd_button_init'));
            add_shortcode('tek_button', array($this, 'kd_button_shrt'));
        }
        // VC Elements render in admin

        function kd_button_init() {
            if (function_exists('vc_map')) {
                vc_map(array(
                    "name" => esc_html__("Button", "keydesign"),
                    "description" => esc_html__("Call to action button with extensive settings.", "keydesign"),
                    "base" => "tek_button",
                    "class" => "",
                    "icon" => plugins_url('assets/element_icons/button.png', dirname(__FILE__)),
                    "category" => esc_html__("KeyDesign Elements", "keydesign"),
                    "params" => array(

                        array(
                            "type" => "dropdown",
                            "class" => "",
                            "heading" => esc_html__("Button icon settings", "keydesign"),
                            "param_name" => "button_icon_bool",
                            "value" => array(
                                "Display icon" 	=> "yes",
                                "No icon" 		=> "no"
                            ),
                            "description" => esc_html__("Choose to display icon or not.", "keydesign")
                        ),
                         array(
                             "type" => "iconpicker",
                             "class" => "",
                             "heading" => esc_html__("Icon database:", "keydesign"),
                             "param_name" => "icons",
                             "dependency" => array(
                                 "element"  => "button_icon_bool",
                                 "value"    => array("yes")
                                 ),
                             "description" => esc_html__("Select your icon.", "keydesign")
                         ),
                        array(
                            "type" => "dropdown",
                            "class" => "",
                            "heading" => esc_html__("Button icon position", "keydesign"),
                            "param_name" => "button_icon_position",
                            "value" => array(
                                "Left" 	=> "button-left",
                                "Right" => "button-right"
                            ),
                            "description" => esc_html__("Choose icon position inside the button.", "keydesign"),
                            "dependency" =>	array("element" => "button_icon_bool", "value"	=> array( "yes" )),
                        ),
                        array(
                            "type" => "textfield",
                            "class" => "",
                            "heading" => esc_html__("Button text", "keydesign"),
                            "param_name" => "button_text",
                            "admin_label" => true,
                            "value" => "",
                            "description" => esc_html__("Enter button text.", "keydesign")
                        ),
                        array(
                            "type" => "textfield",
                            "class" => "",
                            "heading" => esc_html__("Secondary button text", "keydesign"),
                            "param_name" => "button_sec_text",
                            "value" => "",
                            "description" => esc_html__("This text will be displayed above the primary button text.", "keydesign")
                        ),
                        array(
            							 "type" => "vc_link",
            							 "class" => "",
            							 "heading" => esc_html__("Link settings", "keydesign"),
            							 "param_name" => "button_link",
            							 "value" => "",
            							 "description" => esc_html__("Set link address and target.", "keydesign"),
            						),
                        array(
                            "type" => "textfield",
                            "class" => "",
                            "heading" => esc_html__("Button width", "keydesign"),
                            "param_name" => "button_width",
                            "value" => "",
                            "description" => esc_html__("Button width in pixels", "keydesign")
                        ),
                        array(
                            "type" => "dropdown",
                            "class" => "",
                            "heading" => esc_html__("Button Style", "keydesign"),
                            "param_name" => "button_style",
                            "value" => array(
                                "Primary Color"  => "",
                                "Secondary Color"       => "tt_secondary_button"
                            ),
                            "description" => esc_html__("Choose button style", "keydesign")
                        ),
                        array(
                            "type" => "dropdown",
                            "class" => "",
                            "heading" => esc_html__("Button position", "keydesign"),
                            "param_name" => "button_position",
                            "value" => array(
                                "Center" => "button-center",
                                "Left" 	=> "pull-left",
                                "Right" => "pull-right",
                            ),
                            "save_always" => true,
                            "description" => esc_html__("Choose button position inside the content area.", "keydesign"),
                        ),
                        array(
                            "type" => "dropdown",
                            "class" => "",
                            "heading" => esc_html__("CSS Animation", "keydesign"),
                            "param_name" => "css_animation",
                            "value" => array(
                                "No"              => "no_animation",
                                "Fade In"         => "kd-animated fadeIn",
                                "Fade In Down"    => "kd-animated fadeInDown",
                                "Fade In Left"    => "kd-animated fadeInLeft",
                                "Fade In Right"   => "kd-animated fadeInRight",
                                "Fade In Up"      => "kd-animated fadeInUp",
                                "Zoom In"         => "kd-animated zoomIn",
                            ),
                            "description" => esc_html__("Select type of animation for element to be animated when it enters the browsers viewport (Note: works only in modern browsers).", "keydesign"),
                        ),

                         array(
                            "type" => "dropdown",
                            "class" => "",
                            "heading" => esc_html__("Animation Delay:", "keydesign"),
                            "param_name" => "elem_animation_delay",
                            "value" => array(
                                "0 s"              => "",
                                "0.2 s"            => "200",
                                "0.4 s"            => "400",
                                "0.6 s"            => "600",
                                "0.8 s"            => "800",
                                "1 s"              => "1000",
                            ),
                            "dependency" =>	array(
                                "element" => "css_animation",
                                "value" => array("kd-animated fadeIn", "kd-animated fadeInDown", "kd-animated fadeInLeft", "kd-animated fadeInRight", "kd-animated fadeInUp", "kd-animated zoomIn")
                            ),
                            "description" => esc_html__("Enter animation delay in ms", "keydesign")
                        ),
                        array(
                            "type" => "textfield",
                            "class" => "",
                            "heading" => esc_html__("Extra class name", "keydesign"),
                            "param_name" => "button_extra_class",
                            "value" => "",
                            "description" => esc_html__("If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file.", "keydesign")
                        ),
                    )
                ));
            }
        }

        // Render the element on front-end
        public function kd_button_shrt($atts, $content = null)
        {
			$output = $icons = $link_target = $link_title = $button_link = $second_style = $animation_delay = '';

            extract(shortcode_atts(array(
                'button_icon_bool' 			      => 'yes',
                'icons' 					            => '',
                'button_icon_position' 		    => '',
                'button_target' 		        	=> '_self',
                'button_text' 				        => '',
                'button_sec_text' 			      => '',
                'button_link'                 => '',
                'button_style'                => '',
                'button_position'             => '',
                'button_width' 				        => '',
                'css_animation'	              => '',
                'elem_animation_delay'        => '',
                'button_extra_class' 		      => '',
            ), $atts));

            $href = vc_build_link($button_link);
            if ($href['target'] == "") { $href['target'] = "_self"; }

      			if($href['url'] !== '') {
      				$link_target = (isset($href['target']) && ($href['target'] != '')) ? ' target="'.$href['target'].'"' : 'target="_self"';
      				$link_title = (isset($href['title'])) ? ' title="'.$href['title'].'"' : '';
      			}

            if(!empty($button_sec_text)) {
                $second_style = "second-style";
            } else {
                $second_style = "";
            }

            //CSS Animation
            if ($css_animation == "no_animation") {
                $css_animation = "";
            }

            // Animation delay
            if ($elem_animation_delay) {
                $animation_delay = 'data-animation-delay='.$elem_animation_delay;
            }

            if ($button_icon_position == 'button-right') {
                $output .= '<a '.(!empty($button_width) ? 'style="width: '.$button_width.'px;"' : '').' href="'.$href['url'].'" '.$link_target.' '.$link_title.' class="tt_button '.$button_icon_position.' '.$button_style.' '.$second_style.' '.$button_position.' '.$css_animation.' '.$button_extra_class.'" '.$animation_delay.'>';
                if(!empty($button_sec_text)) {
                    $output .= '<span class="sec_text">'.$button_sec_text.'</span>';
                }
                $output .= '<span class="prim_text">'.$button_text.'</span>';
                if ($icons != '') { $output .= '<span class="'.$icons.' iconita"></span>'; }
                $output .= '</a>';
            }
            else {
                $output .= '<a style="width:'.$button_width.'px" href="'.$href['url'].'" '.$link_target.' '.$link_title.' class="tt_button '.$button_style.' '.$second_style.' '.$button_position.' '.$css_animation.' '.$button_extra_class.'" '.$animation_delay.'>';
                if ($icons != '')  { $output .= '<span class="'.$icons.' iconita"></span>'; }
                if(!empty($button_sec_text)) {
                    $output .= '<span class="sec_text">'.$button_sec_text.'</span>';
                }
                $output .= '<span class="prim_text">'.$button_text.'</span>';
                $output .= '</a>';
            }


            return $output;
        }
    }
}

if (class_exists('KD_ELEM_BUTTON')) {
    $KD_ELEM_BUTTON = new KD_ELEM_BUTTON;
}
?>
