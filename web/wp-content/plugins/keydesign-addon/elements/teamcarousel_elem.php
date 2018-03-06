<?php
if (class_exists('WPBakeryShortCodesContainer')) {
    class WPBakeryShortCode_tek_teamcarousel extends WPBakeryShortCodesContainer {
    }
}
if (class_exists('WPBakeryShortCode')) {
    class WPBakeryShortCode_tek_teamcarousel_single extends WPBakeryShortCode {
    }
}
if (!class_exists('tek_teamcarousel')) {
    class tek_teamcarousel extends KEYDESIGN_ADDON_CLASS
    {
        function __construct() {
            add_action('init', array($this, 'kd_teamcarousel_init'));
            add_shortcode('tek_teamcarousel', array($this, 'kd_teamcarousel_container'));
            add_shortcode('tek_teamcarousel_single', array($this, 'kd_teamcarousel_single'));
        }
        // Element configuration in admin
        function kd_teamcarousel_init() {
            // Container element configuration
            if (function_exists('vc_map')) {
                vc_map(array(
                    "name" => esc_html__("Team Carousel", "keydesign"),
                    "description" => esc_html__("List all your team members in a carousel.", "keydesign"),
                    "base" => "tek_teamcarousel",
                    "class" => "",
                    "show_settings_on_create" => true,
                    "content_element" => true,
                    "as_parent" => array('only' => 'tek_teamcarousel_single'),
                    "icon" => plugins_url('assets/element_icons/team-carousel.png', dirname(__FILE__)),
                    "category" => esc_html__("KeyDesign Elements", "keydesign"),
                    "js_view" => 'VcColumnView',
                    "params" => array(
                        array(
                            "type"			=>	"dropdown",
                            "class"			=>	"",
                            "heading"		=>	esc_html__("Elements per row", "keydesign"),
                            "param_name"	=>	"tc_elements",
                            "value"			=>	array(
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
                            "param_name"    =>  "tc_autoplay",
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
                            "param_name"    =>  "tc_autoplay_speed",
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
                                "element" => "tc_autoplay",
                                "value" => array("auto_on")
                            ),
                            "description"   =>  esc_html__("Carousel autoplay speed.", "keydesign")
                        ),

                        array(
                            "type"          =>  "dropdown",
                            "class"         =>  "",
                            "heading"       =>  esc_html__("Stop on hover","keydesign"),
                            "param_name"    =>  "tc_stoponhover",
                            "value"         =>  array(
                                    "Off"   => "hover_off",
                                    "On"    => "hover_on"
                                ),
                            "save_always" => true,
                            "dependency" =>	array(
                                "element" => "tc_autoplay",
                                "value" => array("auto_on")
                            ),
                            "description"   =>  esc_html__("Stop sliding carousel on mouse over.", "keydesign")
                        ),

                        array(
                            "type" => "textfield",
                            "class" => "",
                            "heading" => esc_html__("Extra class name", "keydesign"),
                            "param_name" => "tc_extra_class",
                            "value" => "",
                            "description" => esc_html__("If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file.", "keydesign")
                        ),
                    )
                ));
                // Shortcode configuration
                vc_map(array(
                    "name" => esc_html__("Team member", "keydesign"),
                    "base" => "tek_teamcarousel_single",
                    "content_element" => true,
                    "as_child" => array('only' => 'tek_teamcarousel'),
                    "icon" => plugins_url('assets/element_icons/team-member.png', dirname(__FILE__)),
                    "params" => array(
                        array(
                            "type" => "textfield",
                            "class" => "",
                            "heading" => esc_html__("Team member name", "keydesign"),
                            "param_name" => "tm_title",
                            "value" => "",
                            "admin_label" => true,
                            "description" => esc_html__("Enter team member name.", "keydesign")
                        ),

                        array(
                            "type" => "textfield",
                            "class" => "",
                            "heading" => esc_html__("Team member position", "keydesign"),
                            "param_name" => "tm_position",
                            "value" => "",
                            "description" => esc_html__("Enter team member position.", "keydesign")
                        ),

                        array(
                            "type" => "textarea",
                            "class" => "",
                            "heading" => esc_html__("Team member description", "keydesign"),
                            "param_name" => "tm_description",
                            "value" => "",
                            "description" => esc_html__("Enter team member short description.", "keydesign")
                        ),

                        array(
                            "type" => "attach_image",
                            "heading" => esc_html__("Team member image", "keydesign"),
                            "param_name" => "tm_image",
                            "description" => esc_html__("Upload team member image.")
                        ),

                        array(
                            "type" => "colorpicker",
                            "class" => "",
                            "heading" => esc_html__("Team member color", "keydesign"),
                            "param_name" => "tm_color",
                            "value" => "",
                            "description" => esc_html__("Choose team member color ( default is theme main color )", "keydesign")
                        ),

                        array(
            							 "type" => "vc_link",
            							 "class" => "",
            							 "heading" => esc_html__("Facebook Link", "keydesign"),
            							 "param_name" => "tm_facebook",
            							 "value" => "",
            							 "description" => esc_html__("Set Facebook address and target.", "keydesign"),
            						),

                        array(
            							 "type" => "vc_link",
            							 "class" => "",
            							 "heading" => esc_html__("Twitter Link", "keydesign"),
            							 "param_name" => "tm_twitter",
            							 "value" => "",
            							 "description" => esc_html__("Set Twitter address and target.", "keydesign"),
            						),

                        array(
            							 "type" => "vc_link",
            							 "class" => "",
            							 "heading" => esc_html__("Google Plus Link", "keydesign"),
            							 "param_name" => "tm_google",
            							 "value" => "",
            							 "description" => esc_html__("Set Google Plus address and target.", "keydesign"),
            						),

                        array(
            							 "type" => "vc_link",
            							 "class" => "",
            							 "heading" => esc_html__("LinkedIn Link", "keydesign"),
            							 "param_name" => "tm_linkedin",
            							 "value" => "",
            							 "description" => esc_html__("Set LinkedIn address and target.", "keydesign"),
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
                            "param_name" => "tmc_extra_class",
                            "value" => "",
                            "description" => esc_html__("If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file.", "keydesign")
                        ),

                    )
                ));
            }
        }

        public function kd_teamcarousel_container($atts, $content = null) {
            extract(shortcode_atts(array(
                    'tc_elements'           => '',
                    'tc_autoplay'           => '',
                    'tc_autoplay_speed'     => '',
                    'tc_stoponhover'        => '',
                    'tc_extra_class'        => '',
                ), $atts));

                $output = '';

                $kd_tcunique_id = "kd-teamc-".uniqid();

                $output = '
                <div class="team-carousel '.$kd_tcunique_id.' tc-parent '.$tc_extra_class.'">
                    <div class="tc-content">'.do_shortcode($content).'</div>
                </div>';

                $output .= '<script type="text/javascript">
          				jQuery(document).ready(function($){
                    if ($(".team-carousel.'.$kd_tcunique_id.' .tc-content").length) {
                      $(".team-carousel.'.$kd_tcunique_id.' .tc-content").owlCarousel({
                        itemsDesktop: [1199,3],
                    	  itemsTablet: [768,2],
                    	  itemsMobile: [479,1],
                          navigation: false,
                          pagination: true,';

                        if($tc_autoplay == "auto_on" && $tc_autoplay_speed !== "") {
                  				$output .= 'autoPlay: '.$tc_autoplay_speed.',';
                  			} else {
                  				$output .= 'autoPlay: false,';
                        }

                        if($tc_autoplay == "auto_on" && $tc_stoponhover == "hover_on") {
                          $output .= 'stopOnHover: true,';
                        } else {
                  				$output .= 'stopOnHover: false,';
                        }

                        if($tc_elements !== "") {
                          $output .= 'items: '.$tc_elements.',';
                        }

                        $output .='
                        addClassActive: true,
                      });
                    }
          				});
          			</script>';

                return $output;
        }

        public function kd_teamcarousel_single($atts, $content = null) {
            extract(shortcode_atts(array(
                'tm_title'                  => '',
                'tm_position'               => '',
                'tm_description'            => '',
                'tm_image'                  => '',
                'tm_color'                  => '',
                'tm_facebook'               => '',
                'tm_twitter'                => '',
                'tm_google'                 => '',
                'tm_linkedin'               => '',
                'css_animation'             => '',
                'elem_animation_delay'       => '',
                'tmc_extra_class'           => '',
            ), $atts));

            $team_image = $link_target_fb = $link_title_fb = $link_target_tw = $link_title_tw = $link_target_go = $link_title_go = $link_target_li = $link_title_li = $href_facebook = $href_twitter = $href_google = $href_linkedin = $animation_delay = '';

            $team_image  = wpb_getImageBySize($params = array(
                'post_id' => NULL,
                'attach_id' => $tm_image,
                'thumb_size' => 'full',
                'class' => ""
            ));

            $href_facebook = vc_build_link($tm_facebook);
      			if($href_facebook['url'] !== '') {
      				$link_target_fb = (isset($href_facebook['target'])) ? 'target="'.$href_facebook['target'].'"' : '';
      				$link_title_fb = (isset($href_facebook['title'])) ? 'title="'.$href_facebook['title'].'"' : '';
      			}

            $href_twitter = vc_build_link($tm_twitter);
      			if($href_twitter['url'] !== '') {
      				$link_target_tw = (isset($href_twitter['target'])) ? 'target="'.$href_twitter['target'].'"' : '';
      				$link_title_tw = (isset($href_twitter['title'])) ? 'title="'.$href_twitter['title'].'"' : '';
      			}

            $href_google = vc_build_link($tm_google);
      			if($href_google['url'] !== '') {
      				$link_target_go = (isset($href_google['target'])) ? 'target="'.$href_google['target'].'"' : '';
      				$link_title_go = (isset($href_google['title'])) ? 'title="'.$href_google['title'].'"' : '';
      			}

            $href_linkedin = vc_build_link($tm_linkedin);
      			if($href_linkedin['url'] !== '') {
      				$link_target_li = (isset($href_linkedin['target'])) ? 'target="'.$href_linkedin['target'].'"' : '';
      				$link_title_li = (isset($href_linkedin['title'])) ? 'title="'.$href_linkedin['title'].'"' : '';
      			}

            //CSS Animation
            if ($css_animation == "no_animation") {
                $css_animation = "";
            }

            // Animation delay
            if ($elem_animation_delay) {
                $animation_delay = 'data-animation-delay='.$elem_animation_delay;
            }

            $output = '<div class="team-member '.$css_animation.' '.$tmc_extra_class.'" '.$animation_delay.'>
                            <div class="team-content">
                                <div class="team-image">'.$team_image['thumbnail'].'
                                <div class="team-content-hover">
                                <div class="gradient-overlay"></div>
                                <h5>'.$tm_title.'</h5>
                                <span class="team-subtitle">'.$tm_position.'</span>
                                <p>'.$tm_description.'</p>
                                <div class="team-socials">';
              									if(isset($tm_facebook) && $tm_facebook !== '') {
              										$output .='<a href="'.$href_facebook['url'].'"'.$link_target_fb.''.$link_title_fb.'><span class="fa fa-facebook"></span></a>';
              										}
              									if(isset($tm_twitter) && $tm_twitter !== '') {
              										$output .='<a href="'.$href_twitter['url'].'"'.$link_target_tw.''.$link_title_tw.'><span class="fa fa-twitter"></span></a>';
              										}
              									if(isset($tm_google) && $tm_google !== '') {
              										$output .='<a href="'.$href_google['url'].'"'.$link_target_go.''.$link_title_go.'><span class="fa fa-google-plus"></span></a>';
              										}
              									if(isset($tm_linkedin) && $tm_linkedin !== '') {
              										$output .='<a href="'.$href_linkedin['url'].'"'.$link_target_li.''.$link_title_li.'><span class="fa fa-linkedin"></span></a>';
              										}
                                $output .='</div>
                            </div></div>
                                <h5>'.$tm_title.'</h5>
                                <span class="team-subtitle">'.$tm_position.'</span>
                            </div>
                        </div>';
            return $output;
        }
    }
}
if (class_exists('tek_teamcarousel')) {
    $tek_teamcarousel = new tek_teamcarousel;
}
?>
