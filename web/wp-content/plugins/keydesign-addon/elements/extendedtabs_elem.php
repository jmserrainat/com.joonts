<?php
  
	if (class_exists('WPBakeryShortCodesContainer')) {
		class WPBakeryShortCode_tek_extended_tabs extends WPBakeryShortCodesContainer {
		}
	}
	if (class_exists('WPBakeryShortCode')) {
		class WPBakeryShortCode_tek_extended_tabs_single extends WPBakeryShortCode {
		}
	}

	if (!class_exists('tek_extended_tabs')) {
		class tek_extended_tabs extends KEYDESIGN_ADDON_CLASS {
			function __construct() {
				add_action('init', array($this, 'kd_extended_tabs_init'));
				add_shortcode('tek_extended_tabs', array($this, 'kd_extended_tabs_container'));
				add_shortcode('tek_extended_tabs_single', array( $this, 'kd_extended_tabs_single'));
			}
			/* VC Elements render in admin */
			function kd_extended_tabs_init() {
				if (function_exists('vc_map')) {
					vc_map(array(
						"name" => esc_html__("Extended tabs", "keydesign"),
						"description" => __("Vertical tabs with extended features.", "keydesign"),
						"base" => "tek_extended_tabs",
						"class" => "",
						"show_settings_on_create" => true,
						"content_element" => true,
						"as_parent" => array('only' => 'tek_extended_tabs_single'),
						"icon" => plugins_url('assets/element_icons/extended-tabs.png', dirname(__FILE__)),
						"category" => esc_html__("KeyDesign Elements", "keydesign"),
						"js_view" => 'VcColumnView',
						"params" => array(
							array(
								"type" => "textfield",
								"class" => "",
								"heading" => esc_html__("Extra class name", "keydesign"),
								"param_name" => "services_extra_class",
								"value" => "",
								"description" => esc_html__("If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file.", "keydesign"),
							),
						)
					));
					vc_map(array(
						"name" => esc_html__("Tab", "keydesign"),
						"base" => "tek_extended_tabs_single",
						"content_element" => true,
						"as_child" => array('only' => 'tek_extended_tabs'),
						"icon" => plugins_url('assets/element_icons/child-tabs.png', dirname(__FILE__)),
						"params" => array(
							array(
								"type" => "textfield",
								"heading" => esc_html__("Tab Title", "keydesign"),
								"param_name" => "services_title",
								"holder" => "tab_title",
								"value" => "",
								"description" => esc_html__("Enter tab title / tab anchor here.", "keydesign"),
							),
							array(
								"type" => "attach_image",
								"heading" => esc_html__("Tab Image", "keydesign"),
								"param_name" => "services_image",
								"value" => "",
								"description" => esc_html__("You can display one image per tab.", "keydesign")
							),
						)
					));
				}
			}

			public function kd_extended_tabs_container($atts, $content = null) {
				extract(shortcode_atts(array(
					'services_extra_class' => '',
				), $atts));
				$output = '<div class="features-tabs '.$services_extra_class.'">'.do_shortcode($content).'
					<ul class="tabs"></ul>
				</div>';
				return $output;
			}

			public function kd_extended_tabs_single($atts, $content = null) {
				extract(shortcode_atts(array(
					'services_title' => '',
					'services_image' => '',
				), $atts));

				$image = '';

				$image  = wpb_getImageBySize($params = array( 'post_id' => NULL, 'attach_id' => $services_image, 'thumb_size' => 'full', 'class' => ""));
				$service_title_trim = str_replace(' ', '', $services_title);
				$service_title_trim = preg_replace('/[^A-Za-z0-9\-]/', '', $service_title_trim);

				$output = '<div id="'.$service_title_trim.'">
					<div class="tab-image-container">'.$image['thumbnail'].'</div>
					<li class="tab col-md-4">
						<a href="#'.$service_title_trim.'">
							<span class="triangle"></span>
							<h5>'.$services_title.'</h5>
						</a>
					</li>
				</div>';
				
				return $output;
			}
		}
	}
	if (class_exists('tek_extended_tabs')) {
		$tek_extended_tabs = new tek_extended_tabs;
	}
?>