<?php

if (!class_exists('KD_ELEM_PHOTO_BOX')) {

    class KD_ELEM_PHOTO_BOX extends KEYDESIGN_ADDON_CLASS {

        function __construct() {
            add_action('init', array($this, 'kd_photobox_init'));
            add_shortcode('tek_photobox', array($this, 'kd_photobox_shrt'));
        }

        // Element configuration in admin

        function kd_photobox_init() {
            if (function_exists('vc_map')) {
                vc_map(array(
                    "name" => esc_html__("Photo Box", "keydesign"),
                    "description" => esc_html__("Simple photo box with link.", "keydesign"),
                    "base" => "tek_photobox",
                    "class" => "",
                    "icon" => plugins_url('assets/element_icons/photo-box.png', dirname(__FILE__)),
                    "category" => esc_html__("KeyDesign Elements", "keydesign"),
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



		// Render the element on front-end

        public function kd_photobox_shrt($atts, $content = null)
        {
            extract(shortcode_atts(array(
                'phb_title'		               => '',
                'phb_title_color'            => '',
                'phb_description'		         => '',
                'phb_description_color'      => '',
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
                  $output .= '<a href="'.$href['url'].'" '.$link_target.' '.$link_title.'>';
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

if (class_exists('KD_ELEM_PHOTO_BOX')) {
    $KD_ELEM_PHOTO_BOX = new KD_ELEM_PHOTO_BOX;
}

?>
