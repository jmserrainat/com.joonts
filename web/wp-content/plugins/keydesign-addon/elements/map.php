<?php
if (!class_exists('KD_ELEM_MAP')) {
    class KD_ELEM_MAP extends KEYDESIGN_ADDON_CLASS {
        function __construct() {
            add_action('init', array($this, 'kd_map_init'));
            add_shortcode('tek_map', array($this, 'kd_map_shrt'));
            add_action('wp_enqueue_scripts', array($this, 'kd_google_map_api'),1);
        }

        function kd_google_map_api() {
          $api = 'https://maps.googleapis.com/maps/api/js';
          $redux_ThemeTek = get_option( 'redux_ThemeTek' );
          $map_key = $redux_ThemeTek['tek-google-api'];
          if($map_key != false) {
    				$arr_params = array(
    					'key' => $map_key
    				);
    				$api = esc_url( add_query_arg( $arr_params, $api ));
    			}

          if (isset($redux_ThemeTek['tek-google-api']) && $redux_ThemeTek['tek-google-api'] != '' ) {
          wp_enqueue_script("googleapis",$api,null,null,false);
          }
        }



        // Element configuration in admin
        function kd_map_init() {

            if (function_exists('vc_map')) {
                vc_map(array(
                    "name" => esc_html__("Google Map", "keydesign"),
                    "description" => esc_html__("Custom Google Map", "keydesign"),
                    "base" => "tek_map",
                    "class" => "",
                    "icon" => plugins_url('assets/element_icons/google-map.png', dirname(__FILE__)),
                    "category" => esc_html__("KeyDesign Elements", "keydesign"),
                    "params" => array(
                        array(
                          "type" => "kd_param_notice",
                          "text" => "<span style='display: block;'>Google maps requires a valid API key in order to work. You can add it in Appearance > Theme Options > Global Options. You can generate a new API key from <a href='https://developers.google.com/maps/faq#new-key' target='_blank' title='Google Maps API'>here</a>.</span>",
                          "param_name" => "notification",
                          'edit_field_class' => 'vc_column vc_col-sm-12',
                        ),
                        array(
          								"type"			=>	"textfield",
          								"class"			=>	"",
          								"heading"		=>	esc_html__("Map name", "keydesign"),
          								"param_name"	=>	"map_name",
          								"value"			=>	"",
          								"description"	=>	esc_html__("Insert a unique map name.", "keydesign"),
          								"save_always"	=>	true,
          							),

                        array(
                            "type"          => "textfield",
                            "class"         => "",
                            "heading"       => esc_html__("Location latitude", "keydesign"),
                            "param_name"    => "map_latitude",
                            "value"         => "",
                            "description"   => esc_html__("Enter location latitude.", "keydesign")
                        ),

                        array(
                            "type"          => "textfield",
                            "class"         => "",
                            "heading"       => esc_html__("Location longitude", "keydesign"),
                            "param_name"    => "map_longitude",
                            "value"         => "",
                            "description"   => esc_html__("Enter location longitude.", "keydesign")
                        ),

                        array(
                            "type"          => "dropdown",
                            "class"         => "",
                            "heading"       => esc_html__("Map zoom", "keydesign"),
                            "param_name"    => "map_zoom",
                            "value"     =>  array(
                                "10 - City" => "10",
                                "11" => "11",
                                "12" => "12",
                                "13" => "13",
                                "14" => "14",
                                "15 - Streets" => "15",
                                "16" => "16",
                                "17" => "17",
                                "18" => "18",
                                "19" => "19",
                                "20 - Buildings" => "20",
                            ),
                            "description"   => esc_html__("Enter map zoom (default 14).", "keydesign")
                        ),
                        array(
            								"type"			=>	"dropdown",
            								"class"			=>	"",
            								"heading"		=>	esc_html__("Map style", "keydesign"),
            								"param_name"	=>	"map_style",
            								"value"			=>	array(
                                esc_html__( 'Grayscale', 'keydesign' ) 			=> 'gmap_style_grayscale',
            										esc_html__( 'Google preset colors', 'keydesign' )	=> 'gmap_style_normal',
            									),
            								"description"	=>	esc_html__("Choose map style.", "keydesign"),
            								"save_always"	=>	true,
          							),

                        array(
                            "type"          => "attach_image",
                            "heading"       => esc_html__("Map marker icon", "keydesign"),
                            "param_name"    => "map_icon",
                            "description"   => esc_html__("Upload Map marker icon.", "keydesign")
                        ),

                        array(
                            "type"			=>	"dropdown",
                            "class"			=>	"",
                            "heading"		=>	esc_html__("Display toggle on/off button","keydesign"),
                            "param_name"	=>	"map_toggle",
                            "value"			=>	array(
                                "Yes" => "map-toggle-on",
                                "No" => "map-toggle-off",
                            ),
                            "save_always" => true,
                            "description"	=>	esc_html__("The button will show/hide the map marker.", "keydesign"),
                        ),

                        array(
                            "type"          => "textfield",
                            "class"         => "",
                            "heading"       => esc_html__("Map button text", "keydesign"),
                            "param_name"    => "map_button_text",
                            "value"         => "",
                            "dependency" => array(
                                "element" => "map_toggle",
                                "value" => array("map-toggle-on"),
                            ),
                            "description"   => esc_html__("Enter the text displayed on the button.", "keydesign")
                        ),

                        array(
                            "type"          => "textfield",
                            "class"         => "",
                            "heading"       => esc_html__("Map height", "keydesign"),
                            "param_name"    => "map_height",
                            "value"         => "",
                            "dependency" => array(
                                "element" => "map_toggle",
                                "value" => array("map-toggle-off"),
                            ),
                            "description"   => esc_html__("Enter map height in pixels. Default is 400px.", "keydesign")
                        ),

                    )
                ));
            }
        }

        // Render the element on front-end
        public function kd_map_shrt($atts, $content = null) {

            // Declare empty vars
            $output = $gmap_style_var = '';

            extract(shortcode_atts(array(
                'map_name'              => '',
                'map_latitude'          => '',
                'map_zoom'              => '',
                'map_style'             => '',
                'map_icon'              => '',
                'map_longitude'         => '',
                'map_toggle'            => '',
                'map_button_text'       => '',
                'map_height'            => '',
            ), $atts));

            $img = wp_get_attachment_image_src($map_icon, "large");
            $imgSrc = $img[0];

            switch($map_style){
      				case 'gmap_style_grayscale':
      					$gmap_style_var = 'var featureOpts = [
      											{
      											  stylers: [
      												{ "visibility": "on" },
      												{ "weight": 1 },
      												{ "saturation": -100 },
      												{ "lightness": 2.2 },
      												{ "gamma": 2.2 }
      											  ]
      											}
      										];';
      				break;

      				case 'gmap_style_normal':
      					$gmap_style_var = 'var featureOpts = [
      											{
      											  stylers: [
      												{ "visibility": "on" },
      												{ "weight": 1.1 },
      												{ "saturation": 1 },
      												{ "lightness": 1 },
      												{ "gamma": 1 }
      											  ]
      											}
      										];';
      				break;
      			}

      			$id = "kd".uniqid();

      			$output .= '<script type="text/javascript">


                    function initialize() {
                      var map_'.$id.';
        							var gmap_location_'.$id.' = new google.maps.LatLng('.$map_latitude.', '.$map_longitude.');
        							var GMAP_MODULE_'.$id.' = "customMap";
      								'.$gmap_style_var.'
      								var mapOptions = {
      									zoom: '.$map_zoom.',
      									center: gmap_location_'.$id.',
                        scrollwheel: false,
      									mapTypeControlOptions: {
      										mapTypeIds: [google.maps.MapTypeId.ROADMAP, GMAP_MODULE_'.$id.']
      									},
      									mapTypeId: GMAP_MODULE_'.$id.'
      								};
      								map_'.$id.' = new google.maps.Map(document.getElementById("'.$id.'"), mapOptions);
      								marker_'.$id.' = new google.maps.Marker({
      									map: map_'.$id.',
      									draggable: false,
      									animation: google.maps.Animation.DROP,
      									position: gmap_location_'.$id.',
      									icon: "'.$imgSrc.'"
      								  });
      								google.maps.event.addListener(marker_'.$id.', "click", function() {
      									if (marker_'.$id.'.getAnimation() != null) {
      										marker_'.$id.'.setAnimation(null);
      									} else {
      										marker_'.$id.'.setAnimation(google.maps.Animation.BOUNCE);
      									}
      								});
      								var styledMapOptions = {
      									name: "'.$map_name.'"
      								};
      								var customMapType_'.$id.' = new google.maps.StyledMapType(featureOpts, styledMapOptions);
      								map_'.$id.'.mapTypes.set(GMAP_MODULE_'.$id.', customMapType_'.$id.');
      							}
                    google.maps.event.addDomListener(window, "load", initialize);

      						</script>';

            $output .= '<div class="contact-map-container '.$map_toggle.'" '.(!empty($map_height) ? 'style="height: '.$map_height.';"' : '').'>';
                if ($map_toggle == "map-toggle-on") {
                    $output .= '<a class="toggle-map">'.(!empty($map_button_text) ? $map_button_text : 'View full map').' <span class="fa fa-map-marker"></span></a>';
                }
                $output .= '<div id="'.$id.'" class="kd_map" '.(!empty($map_height) ? 'style="height: '.$map_height.';"' : '').'></div>
            </div>';

            return $output;
        }
    }
}

if (class_exists('KD_ELEM_MAP')) {
    $KD_ELEM_MAP = new KD_ELEM_MAP;
}
?>
