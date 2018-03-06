<?php
if (class_exists('WPBakeryShortCodesContainer')) {
    class WPBakeryShortCode_tek_photocarousel extends WPBakeryShortCodesContainer {
    }
}
if (class_exists('WPBakeryShortCode')) {
    class WPBakeryShortCode_tek_photocarousel_single extends WPBakeryShortCode {
    }
}
if (!class_exists('tek_photocarousel')) {
    class tek_photocarousel extends KEYDESIGN_ADDON_CLASS
    {
        function __construct() {
            add_action('init', array($this, 'kd_photocarousel_init'));
            add_shortcode('tek_photocarousel', array($this, 'kd_photocarousel_container'));
            add_shortcode('tek_photocarousel_single', array($this, 'kd_photocarousel_single'));
        }
        // Element configuration in admin
        function kd_photocarousel_init() {
            // Container element configuration
            if (function_exists('vc_map')) {
                vc_map(array(
                    "name" => esc_html__("Photo Box Carousel", "keydesign"),
                    "description" => esc_html__("List photo boxes in a carousel.", "keydesign"),
                    "base" => "tek_photocarousel",
                    "class" => "",
                    "show_settings_on_create" => true,
                    "content_element" => true,
                    "as_parent" => array('only' => 'tek_photocarousel_single', 'tek_photobox'),
                    "icon" => plugins_url('assets/element_icons/photobox-carousel.png', dirname(__FILE__)),
                    "category" => esc_html__("KeyDesign Elements", "keydesign"),
                    "js_view" => 'VcColumnView',
                    "params" => array(
                        array(
                            "type"			=>	"dropdown",
                            "class"			=>	"",
                            "heading"		=>	esc_html__("Elements per row", "keydesign"),
                            "param_name"	=>	"pc_elements",
                            "value"			=>	array(
                                    "1 items" => "1",
                                    "2 items" => "2",
                                    "3 items" => "3",
                                    "4 items" => "4",
                                ),
                            "save_always" => true,
                            "description" => esc_html__("Amount of items displayed at a time with the widest browser width.", "keydesign")
                        ),

                        array(
                            "type"          =>  "dropdown",
                            "class"         =>  "",
                            "heading"       =>  esc_html__("Enable autoplay","keydesign"),
                            "param_name"    =>  "pbc_autoplay",
                            "value"         =>  array(
                                    "Off"   => "auto_off",
                                    "On"    => "auto_on"
                                ),
                            "save_always" => true,
                            "description"   =>  esc_html__("Carousel autoplay settings.", "keydesign")
                        ),

                        array(
                            "type"          =>  "dropdown",
                            "class"         =>  "",
                            "heading"       =>  esc_html__("Autoplay speed","keydesign"),
                            "param_name"    =>  "pbc_autoplay_speed",
                            "value"         =>  array(
                                    "10s"   => "10000",
                                    "9s"   => "9000",
                                    "8s"   => "8000",
                                    "7s"   => "7000",
                                    "6s"   => "6000",
                                    "5s"   => "5000",
                                    "4s"   => "4000",
                                    "3s"   => "3000",
                                ),
                            "save_always" => true,
                            "dependency" =>	array(
                                "element" => "pbc_autoplay",
                                "value" => array("auto_on")
                            ),
                            "description"   =>  esc_html__("Carousel autoplay speed.", "keydesign")
                        ),

                        array(
                            "type"          =>  "dropdown",
                            "class"         =>  "",
                            "heading"       =>  esc_html__("Stop on hover","keydesign"),
                            "param_name"    =>  "pbc_stoponhover",
                            "value"         =>  array(
                                    "Off"   => "hover_off",
                                    "On"    => "hover_on"
                                ),
                            "save_always" => true,
                            "dependency" =>	array(
                                "element" => "pbc_autoplay",
                                "value" => array("auto_on")
                            ),
                            "description"   =>  esc_html__("Stop sliding carousel on mouse over.", "keydesign")
                        ),

                        array(
                            "type" => "textfield",
                            "class" => "",
                            "heading" => esc_html__("Extra class name", "keydesign"),
                            "param_name" => "pb_extra_class",
                            "value" => "",
                            "description" => esc_html__("If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file.", "keydesign")
                        ),
                    )
                ));
                // Shortcode configuration
                vc_map(array(
                    "name" => esc_html__("Photo Box", "keydesign"),
                    "base" => "tek_photocarousel_single",
                    "content_element" => true,
                    "as_child" => array('only' => 'tek_photocarousel'),
                    "icon" => plugins_url('assets/element_icons/photo-box.png', dirname(__FILE__)),
                    "params" => array(
                      array(
                          "type" => "textfield",
                          "class" => "",
                          "heading" => esc_html__("Box title", "keydesign"),
                          "param_name" => "phb_title",
                          "value" => "",
                          "admin_label" => true,
                          "description" => esc_html__("Enter box title here.", "keydesign")
                      ),
                      array(
                          "type" => "colorpicker",
                          "class" => "",
                          "heading" => esc_html__("Title color", "keydesign"),
                          "param_name" => "phb_title_color",
                          "value" => "",
                          "description" => esc_html__("Choose title color. If none selected, the default theme color will be used.", "keydesign"),
                      ),
                      array(
                          "type" => "textarea",
                          "class" => "",
                          "heading" => esc_html__("Box description", "keydesign"),
                          "param_name" => "phb_description",
                          "value" => "",
                          "description" => esc_html__("Enter box content text here.", "keydesign")
                      ),
                      array(
                          "type" => "colorpicker",
                          "class" => "",
                          "heading" => esc_html__("Description color", "keydesign"),
                          "param_name" => "phb_description_color",
                          "value" => "",
                          "description" => esc_html__("Choose description color. If none selected, the default theme color will be used.", "keydesign"),
                      ),
                      array(
                           "type"	=>	"dropdown",
                           "class" =>	"",
                           "heading" => esc_html__("Box text align", "keydesign"),
                           "param_name" => "phb_text_align",
                           "value" =>	array(
                                  esc_html__( 'Left aligned', 'keydesign' ) => 'text-left',
                                  esc_html__( 'Center aligned', 'keydesign' )	=> 'text-center',
                              ),
                           "save_always" => true,
                           "description" => esc_html__("Text alignment in box.", "keydesign"),
                      ),
                      array(
                          "type" => "attach_image",
                          "class" => "",
                          "heading" => esc_html__("Upload box image", "keydesign"),
                          "param_name" => "phb_image",
                          "value" => "",
                          "description" => esc_html__("Upload your own custom image.", "keydesign"),
                      ),
                      array(
                           "type"	=>	"dropdown",
                           "class" =>	"",
                           "heading" => esc_html__("Box link type", "keydesign"),
                           "param_name" => "phb_custom_link",
                           "value" =>	array(
                                  esc_html__( 'No link', 'keydesign' ) => '#',
                                  esc_html__( 'Button link', 'keydesign' )	=> 'box-button-link',
                                  esc_html__( 'Full box link', 'keydesign' )	=> 'box-link',
                              ),
                           "save_always" => true,
                           "description" => esc_html__("You can add or remove the custom link.", "keydesign"),
                      ),
                      array(
                           "type"	=>	"vc_link",
                           "class" =>	"",
                           "heading" => esc_html__("Link settings", "keydesign"),
                           "param_name" => "phb_box_link",
                           "value" =>	"",
                           "description" => esc_html__("You can add or remove the existing link from here.", "keydesign"),
                           "dependency" => array(
                              "element" => "phb_custom_link",
                              "value"	=> array( "box-button-link", "box-link" ),
                          ),
                      ),
                      array(
                          "type" => "textfield",
                          "class" => "",
                          "heading" => esc_html__("Button text", "keydesign"),
                          "param_name" => "phb_button_text",
                          "value" => "",
                          "description" => esc_html__("Write the text displayed on the button.", "keydesign"),
                          "dependency" => array(
                             "element" => "phb_custom_link",
                             "value"	=> array( "box-button-link" ),
                         ),
                      ),
                      array(
                          "type" => "colorpicker",
                          "class" => "",
                          "heading" => esc_html__("Box background color", "keydesign"),
                          "param_name" => "phb_background_color",
                          "value" => "",
                          "description" => esc_html__("Choose box background color.", "keydesign"),
                      ),
                      array(
                           "type"	=>	"dropdown",
                           "class" =>	"",
                           "heading" => esc_html__("Image hover effect", "keydesign"),
                           "param_name" => "phb_image_effect",
                           "value" =>	array(
                                  esc_html__( 'No effect', 'keydesign' ) => 'no-effect',
                                  esc_html__( 'Shine', 'keydesign' )	=> 'shine-effect',
                                  esc_html__( 'Circle', 'keydesign' )	=> 'circle-effect',
                                  esc_html__( 'Flash', 'keydesign' )	=> 'flash-effect',
                                  esc_html__( 'Opacity', 'keydesign' )	=> 'opacity-effect',
                                  esc_html__( 'Gray scale', 'keydesign' )	=> 'grayscale-effect'
                              ),
                           "save_always" => true,
                           "description" => esc_html__("Choose a image effect.", "keydesign"),
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
                          "param_name" => "phb_extra_class",
                          "value" => "",
                          "description" => esc_html__("If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file.", "keydesign")
                      ),

                    )
                ));
            }
        }

        public function kd_photocarousel_container($atts, $content = null) {
            extract(shortcode_atts(array(
                'pc_elements'                     => '',
                'pbc_autoplay'                    => '',
                'pbc_autoplay_speed'              => '',
                'pbc_stoponhover'                 => '',
                'pb_extra_class'                  => '',
                ), $atts));

                $output = '';

                $kd_pbcunique_id = "kd-pbc-".uniqid();

                $output .= '
                <div class="photobox-carousel '.$kd_pbcunique_id.' pbc-parent '.$pb_extra_class.'">
                    <div class="pbc-content">'.do_shortcode($content).'</div>
                </div>';

                $output .= '<script type="text/javascript">
          				jQuery(document).ready(function($){
                    if ($(".photobox-carousel.'.$kd_pbcunique_id.' .pbc-content").length) {
                      $(".photobox-carousel.'.$kd_pbcunique_id.' .pbc-content").owlCarousel({
                        itemsDesktop: [1199,4],
                    	  itemsTablet: [768,2],
                    	  itemsMobile: [479,1],
                          navigation: false,
                          pagination: true,';

                        if($pbc_autoplay == "auto_on" && $pbc_autoplay_speed !== "") {
                  				$output .= 'autoPlay: '.$pbc_autoplay_speed.',';
                  			} else {
                  				$output .= 'autoPlay: false,';
                        }

                        if($pbc_autoplay == "auto_on" && $pbc_stoponhover == "hover_on") {
                          $output .= 'stopOnHover: true,';
                        } else {
                  				$output .= 'stopOnHover: false,';
                        }

                        if($pc_elements !== "") {
                          $output .= 'items: '.$pc_elements.',';
                        }

                        $output .='
                        addClassActive: true,
                      });
                    }
          				});
          			</script>';

                return $output;
        }

        public function kd_photocarousel_single($atts, $content = null) {
            extract(shortcode_atts(array(
                'phb_title'		               => '',
                'phb_title_color'		         => '',
                'phb_description'		         => '',
                'phb_description_color'		   => '',
                'phb_text_align'		         => '',
                'phb_image'		               => '',
                'phb_custom_link'		         => '',
                'phb_box_link'		           => '',
                'phb_button_text'            => '',
                'phb_background_color'       => '',
                'phb_image_effect'           => '',
                'css_animation'              => '',
                'elem_animation_delay'       => '',
                'phb_extra_class'		         => '',
            ), $atts));

            $content_image = $phb_img_array = $href = $link_target = $link_title = $animation_delay = '';

      			if(!empty($phb_image)){
      				$phb_img_array = wpb_getImageBySize ( $params = array( 'post_id' => NULL, 'attach_id' => $phb_image, 'thumb_size' => 'full', 'class' => "" ) );
      				$content_image = '<div class="photobox-img">'.$phb_img_array['thumbnail'].'</div>';
      			}

            $href = vc_build_link($phb_box_link);
      			if($href['url'] !== '') {
      				$link_target = (isset($href['target']) && ($href['target'] != '')) ? 'target="'.$href['target'].'"' : '';
      				$link_title = (isset($href['title'])) ? 'title="'.$href['title'].'"' : '';
      			}

            //CSS Animation
            if ($css_animation == "no_animation") {
                $css_animation = "";
            }

            // Animation delay
            if ($elem_animation_delay) {
                $animation_delay = 'data-animation-delay='.$elem_animation_delay;
            }

            $output = '<div class="kd-photobox '.$phb_image_effect.' '.$css_animation.' '.$phb_extra_class.'" '.$animation_delay.'>';
              if ($phb_custom_link == "box-link") {
                  $output .= '<a href="'.$href['url'].'"'.$link_target.''.$link_title.'>';
              }
                $output .= $content_image;
                $output .= '<div class="phb-content '.$phb_text_align.'" '.(!empty($phb_background_color) ? 'style="background-color: '.$phb_background_color.';"' : '').'>
                <h4 '.(!empty($phb_title_color) ? 'style="color: '.$phb_title_color.';"' : '').'>'.$phb_title.'</h4>
                <p '.(!empty($phb_description_color) ? 'style="color: '.$phb_description_color.';"' : '').'>'.$phb_description.'</p>';
                  if ($phb_custom_link == "box-button-link") {
                      $output .= '<div class="phb-btncontainer">
                          <a href="'.$href['url'].'" '.$link_target.' '.$link_title.' class="phb-button">'.$phb_button_text.'</a>
                      </div>';
                  }
                $output .= '</div>';
              if ($phb_custom_link == "box-link") {
                  $output .= '</a>';
              }
            $output .= '</div>';

            return $output;
        }
    }
}
if (class_exists('tek_photocarousel')) {
    $tek_photocarousel = new tek_photocarousel;
}
?>
