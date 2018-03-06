<?php

if (!class_exists('KD_ELEM_PROMO_BOX')) {

    class KD_ELEM_PROMO_BOX extends KEYDESIGN_ADDON_CLASS {

        function __construct() {
            add_action('init', array($this, 'kd_promobox_init'));
            add_shortcode('tek_promobox', array($this, 'kd_promobox_shrt'));
        }

        // Element configuration in admin

        function kd_promobox_init() {
            if (function_exists('vc_map')) {
                vc_map(array(
                    "name" => esc_html__("Service Box", "keydesign"),
                    "description" => esc_html__("Service box with image and button.", "keydesign"),
                    "base" => "tek_promobox",
                    "class" => "",
                    "icon" => plugins_url('assets/element_icons/promo-box.png', dirname(__FILE__)),
                    "category" => esc_html__("KeyDesign Elements", "keydesign"),
                    "params" => array(

                        array(
                            "type" => "textfield",
                            "class" => "",
                            "heading" => esc_html__("Box title", "keydesign"),
                            "param_name" => "prb_title",
                            "value" => "",
                            "description" => esc_html__("Enter box title here.", "keydesign")
                        ),
                        array(
                            "type" => "textarea",
                            "class" => "",
                            "heading" => esc_html__("Box content text", "keydesign"),
                            "param_name" => "prb_description",
                            "value" => "",
                            "description" => esc_html__("Enter box content text here.", "keydesign")
                        ),
                        array(
                            "type" => "attach_image",
                            "class" => "",
                            "heading" => esc_html__("Upload box image", "keydesign"),
                            "param_name" => "prb_image",
                            "value" => "",
                            "description" => esc_html__("Upload your own custom image.", "keydesign"),
                        ),
                        array(
                            "type"			=>	"dropdown",
                            "class"			=>	"",
                            "heading"		=>	esc_html__("Image position","keydesign"),
                            "param_name"	=>	"prb_image_position",
                            "value"			=>	array(
                                    "Left" => "prb_image_left",
                                    "Right" => "prb_image_right",
                                ),
                            "save_always" => true,
                            "description"	=>	esc_html__("Choose image position relative to the box title and description.", "keydesign")
                        ),
                        array(
                             "type"	=>	"dropdown",
                             "class" =>	"",
                             "heading" => esc_html__("Box link type", "keydesign"),
                             "param_name" => "prb_custom_link",
                             "value" =>	array(
                                    esc_html__( 'No link', 'keydesign' ) => '#',
                                    esc_html__( 'Add a custom button', 'keydesign' )	=> '1',
                                ),
                             "save_always" => true,
                             "description" => esc_html__("You can add or remove the custom link.", "keydesign"),
                        ),
                        array(
                             "type"	=>	"vc_link",
                             "class" =>	"",
                             "heading" => esc_html__("Link settings", "keydesign"),
                             "param_name" => "prb_box_link",
                             "value" =>	"",
                             "description" => esc_html__("You can add or remove the existing link from here.", "keydesign"),
                             "dependency" => array(
                                "element" => "prb_custom_link",
                                "value"	=> array( "1" ),
                            ),
                        ),
                        array(
                            "type" => "textfield",
                            "class" => "",
                            "heading" => esc_html__("Button text", "keydesign"),
                            "param_name" => "prb_button_text",
                            "value" => "",
                            "description" => esc_html__("Write the text displayed on the button.", "keydesign"),
                            "dependency" => array(
                               "element" => "prb_custom_link",
                               "value"	=> array( "1" ),
                           ),
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
                            "type" => "textfield",
                            "class" => "",
                            "heading" => esc_html__("Extra class name", "keydesign"),
                            "param_name" => "prb_extra_class",
                            "value" => "",
                            "description" => esc_html__("If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file.", "keydesign")
                        ),

                    )
                ));
            }
        }



		// Render the element on front-end

        public function kd_promobox_shrt($atts, $content = null)
        {
            extract(shortcode_atts(array(
                'prb_title'		                   => '',
                'prb_description'		             => '',
                'prb_image'		                   => '',
                'prb_image_position'		         => '',
                'prb_custom_link'		             => '',
                'prb_box_link'		               => '',
                'prb_button_text'                => '',
                'css_animation'                  => '',
                'prb_extra_class'		             => '',
            ), $atts));

            $content_image = $prb_img_array = $href = $link_target = $link_title = '';

      			if(!empty($prb_image)){
        				$prb_img_array = wpb_getImageBySize ( $params = array( 'post_id' => NULL, 'attach_id' => $prb_image, 'thumb_size' => 'full', 'class' => "" ) );
        				$content_image = '<div class="prb-img">'.$prb_img_array['thumbnail'].'</div>';
      			}

            $href = vc_build_link($prb_box_link);
        			if($href['url'] !== '') {
        				$link_target = (isset($href['target']) && ($href['target'] != '')) ? 'target="'.$href['target'].'"' : '';
        				$link_title = (isset($href['title'])) ? 'title="'.$href['title'].'"' : '';
      			}

            //CSS Animation
            if ($css_animation == "no_animation") {
                $css_animation = "";
            }


            $output = '<div class="kd-promobox '.$prb_image_position.' '.$prb_extra_class.' '.$css_animation.'">';
              $output .= $content_image;
              $output .= '<div class="prb-content">
              <h3>'.$prb_title.'</h3>
              <p>'.$prb_description.'</p>';
              if ($prb_custom_link == "1") {
                  $output .= '<div class="prb-btncontainer">
                      <a href="'.$href['url'].'" '.$link_target.' '.$link_title.' class="prb-button tt_secondary_button tt_button">'.$prb_button_text.'</a>
                  </div>';
              }
              $output .= '</div>';
            $output .= '</div>';

            return $output;

        }
    }
}

if (class_exists('KD_ELEM_PROMO_BOX')) {
    $KD_ELEM_PROMO_BOX = new KD_ELEM_PROMO_BOX;
}

?>
