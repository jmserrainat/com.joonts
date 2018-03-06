<?php
if (class_exists('WPBakeryShortCodesContainer')) {
    class WPBakeryShortCode_tek_masonrygallery_elem extends WPBakeryShortCodesContainer {
    }
}
if (class_exists('WPBakeryShortCode')) {
    class WPBakeryShortCode_tek_masonrygallery_elem_single extends WPBakeryShortCode {
    }
}
if (!class_exists('tek_masonrygallery_elem')) {
    class tek_masonrygallery_elem extends KEYDESIGN_ADDON_CLASS
    {
        function __construct() {
            add_action('init', array( $this, 'kd_featured_init' ));
            add_shortcode('tek_masonrygallery_elem', array( $this, 'kd_masonrygallery_container' ));
            add_shortcode('tek_masonrygallery_elem_single', array( $this, 'kd_masonrygallery_single' ));
            add_action('wp_enqueue_scripts', array( $this, 'masonrygallery_scripts' ));
        }

        function masonrygallery_scripts() {
            wp_enqueue_style('photoswipe');
            wp_enqueue_style('photoswipe-skin');
            wp_enqueue_script('photoswipejs', array('jquery'), '', true );
            wp_enqueue_script('photoswipejs-ui', array('jquery'), '', true );
		}

        // Element configuration in admin
        function kd_featured_init() {
            // Container element configuration
            if (function_exists('vc_map')) {
                vc_map(array(
                    "name" => esc_html__("Masonry Gallery", "keydesign"),
                    "description" => esc_html__("Display a gallery with masonry effect.", "keydesign"),
                    "base" => "tek_masonrygallery_elem",
                    "class" => "",
                    "show_settings_on_create" => true,
                    "content_element" => true,
                    "as_parent" => array('only' => 'tek_masonrygallery_elem_single'),
                    "icon" => plugins_url('assets/element_icons/masonry-gallery.png', dirname(__FILE__)),
                    "category" => esc_html__("KeyDesign Elements", "keydesign"),
                    "js_view" => 'VcColumnView',
                    "params" => array(
                        array(
                            "type" => "textfield",
                            "class" => "",
                            "heading" => esc_html__("Extra class name", "keydesign"),
                            "param_name" => "mg_extra_class",
                            "value" => "",
                            "description" => esc_html__("If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file.", "keydesign")
                        ),
                    )
                ));
                // Shortcode configuration
                vc_map(array(
                    "name" => esc_html__("Gallery single image", "keydesign"),
                    "base" => "tek_masonrygallery_elem_single",
                    "content_element" => true,
                    "as_child" => array('only' => 'tek_masonrygallery_elem'),
                    "icon" => plugins_url('assets/element_icons/child-image.png', dirname(__FILE__)),
                    "params" => array(
                        array(
                            "type" => "attach_image",
                            "class" => "",
                            "heading" => esc_html__("Upload image", "keydesign"),
                            "param_name" => "mg_image",
                            "value" => "",
                            "description" => esc_html__("Upload your own custom image.", "keydesign"),
                        ),

                        array(
                            "type"			=>	"dropdown",
                            "class"			=>	"",
                            "heading"		=>	esc_html__("Image size","keydesign"),
                            "param_name"	=>	"mg_size",
                            "value"			=>	array(
                                    "Small" => "mg-small",
                                    "Big" => "mg-big",
                                ),
                            "save_always" => true
                        ),
                    )
                ));
            }
        }

        public function kd_masonrygallery_container($atts, $content = null) {

            // Include required JS and CSS files
			wp_enqueue_script( 'masonry' );

            // Declare empty vars
            $output = '';

            extract(shortcode_atts(array(
                'mg_extra_class'            => '',
            ), $atts));

            $output = '<div id="mg-gallery" class="mg-container row '.$mg_extra_class.'"><div class="mg-sizer"></div>' . do_shortcode($content) . '</div>';
            return $output;
        }

        public function kd_masonrygallery_single($atts, $content = null) {

            // Declare empty vars
            $output = $image = $mg_single_size = '';

            extract(shortcode_atts(array(
                'mg_image'            => '',
                'mg_size'             => '',
            ), $atts));

            $image  = wpb_getImageBySize($params = array(
                'post_id' => NULL,
                'attach_id' => $mg_image,
                'thumb_size' => 'full',
                'class' => ""
            ));

            $img = $image['thumbnail'];
            $pattern = '/src="([^"]*)"/';
            preg_match($pattern, $img, $matches);
            $src = $matches[1];
            unset($matches);
            list($width, $height) = getimagesize($src);

            // Active element
            if( $mg_size == 'mg-small' ) {
                $mg_single_size = 'small-masonry-img';
            }
            elseif ( $mg_size == 'mg-big' ) {
                $mg_single_size = 'big-masonry-img';
            }

            $output = '<div class="mg-single-img '.$mg_single_size.'"><a data-size="' . $width. 'x' .$height .'" href='. $src . '>' . $image['thumbnail'] . '</a></div>';
            return $output;
        }
    }
}
if (class_exists('tek_masonrygallery_elem')) {
    $tek_masonrygallery_elem = new tek_masonrygallery_elem;
}

function photoswipe_structure() {
    echo '<div class="pswp" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="pswp__bg"></div>
        <div class="pswp__scroll-wrap">
            <div class="pswp__container">
                <div class="pswp__item"></div>
                <div class="pswp__item"></div>
                <div class="pswp__item"></div>
            </div>
            <div class="pswp__ui pswp__ui--hidden">
                <div class="pswp__top-bar">
                    <div class="pswp__counter"></div>
                    <button class="pswp__button pswp__button--close" title="Close (Esc)"></button>
                    <button class="pswp__button pswp__button--fs" title="Toggle fullscreen"></button>
                    <button class="pswp__button pswp__button--zoom" title="Zoom in/out"></button>
                    <div class="pswp__preloader">
                        <div class="pswp__preloader__icn">
                          <div class="pswp__preloader__cut">
                            <div class="pswp__preloader__donut"></div>
                          </div>
                        </div>
                    </div>
                </div>
                <button class="pswp__button pswp__button--arrow--left" title="Previous (arrow left)">
                </button>
                <button class="pswp__button pswp__button--arrow--right" title="Next (arrow right)">
                </button>
                <div class="pswp__caption">
                    <div class="pswp__caption__center"></div>
                </div>
            </div>
        </div>
    </div>';
}
add_action( 'wp_footer', 'photoswipe_structure' );
?>
