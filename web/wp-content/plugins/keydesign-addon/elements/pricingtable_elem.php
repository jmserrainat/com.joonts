<?php

if (!class_exists('KD_ELEM_PRICING_TABLE')) {

    class KD_ELEM_PRICING_TABLE extends KEYDESIGN_ADDON_CLASS {

        function __construct() {

            add_action('init', array($this, 'kd_pricingtable_init'));

            add_shortcode('tek_pricing', array($this, 'kd_pricingtable_shrt'));

        }

        // Element configuration in admin

        function kd_pricingtable_init() {

            if (function_exists('vc_map')) {

                vc_map(array(

                    "name" => esc_html__("Pricing Table", "keydesign"),

                    "description" => esc_html__("Pricing table with extended settings.", "keydesign"),

                    "base" => "tek_pricing",

                    "class" => "",

                    "icon" => plugins_url("assets/element_icons/pricing-table.png", dirname(__FILE__)),

                    "category" => esc_html__("KeyDesign Elements", "keydesign"),

                    "params" => array(

                        array(

                            "type" => "textfield",

                            "class" => "",

                            "heading" => esc_html__("Plan title", "keydesign"),

                            "param_name" => "pricing_title",

                            "admin_label" => true,

                            "value" => "",

                            "description" => esc_html__("Enter your pricing plan title.", "keydesign")

                        ),

                        array(

                            "type" => "textfield",

                            "class" => "",

                            "heading" => esc_html__("Plan value", "keydesign"),

                            "param_name" => "pricing_price",

                            "value" => "",

                            "description" => esc_html__("Enter price for this plan.", "keydesign")

                        ),

                        array(

                            "type" => "textfield",

                            "class" => "",

                            "heading" => esc_html__("Plan period", "keydesign"),

                            "param_name" => "pricing_time",

                            "value" => "",

                            "description" => esc_html__("Enter your pricing plan period (ex. /month)", "keydesign")

                        ),

                        array(

                            "type" => "dropdown",

                            "class" => "",

                            "heading" => esc_html__("Plan currency", "keydesign"),

                            "param_name" => "pricing_currency",

                            "value" => array(

                                "Dollar" => "currency-dollar",

                                "Euro" => "currency-euro",

                                "Pound" => "currency-pound"

                            ),

                            "save_always" => true,

                            "description" => esc_html__("Select pricing plan currency.", "keydesign")

                        ),

                        array(

                            "type" => "textfield",

                            "class" => "",

                            "heading" => esc_html__("Other currency", "keydesign"),

                            "param_name" => "pricing_other_currency",

                            "value" => "",

                            "description" => esc_html__("Pricing plan custom currency.", "keydesign")

                        ),

                        array(

                            "type" => "dropdown",

                            "class" => "",

                            "heading" => esc_html__("Currency position", "keydesign"),

                            "param_name" => "pricing_currency_position",

                            "value" => array(

                                "Left" => "currency-position-left",

                                "Right" => "currency-position-right"

                            ),

                            "save_always" => true,

                            "description" => esc_html__("Select pricing plan currency.", "keydesign")

                        ),

                        array(

                            "type" => "textfield",

                            "class" => "",

                            "heading" => esc_html__("Pricing subtitle", "keydesign"),

                            "param_name" => "pricing_other_text",

                            "value" => "",

                            "description" => esc_html__("Pricing plan subtitle", "keydesign")

                        ),

                        array(

                            "type" => "dropdown",

                            "class" => "",

                            "heading" => esc_html__("Highlight plan", "keydesign"),

                            "param_name" => "highlight_plan",

                            "value" => array(

                                "No" => "",

                                "Yes" => "active"

                            ),

                            "save_always" => true,

                            "description" => esc_html__("Select if pricing plan is highlighted", "keydesign")

                        ),

                        array(

                            "type" => "dropdown",

                            "class" => "",

                            "heading" => esc_html__("Color Scheme", "keydesign"),

                            "param_name" => "pricing_scheme",

                            "value" => array(

                                "Normal" => "",

                                "Transparent" => "transparent-scheme"

                            ),

                            "save_always" => true,

                            "description" => esc_html__("Pricing Plan Color Scheme", "keydesign")

                        ),

                        array(

                            "type" => "textfield",

                            "class" => "",

                            "heading" => esc_html__("Button text", "keydesign"),

                            "param_name" => "pricing_button_text",

                            "value" => "",

                            "description" => esc_html__("Pricing table submit button text.", "keydesign")

                        ),

            						array(

            							 "type" => "vc_link",

            							 "class" => "",

            							 "heading" => esc_html__("Button link", "keydesign"),

            							 "param_name" => "pricing_button_link",

            							 "value" => "",

            							 "description" => esc_html__("Set link address, title and target.", "keydesign"),

            						),

                        array(

                            "type" => "attach_image",

                            "class" => "",

                            "heading" => esc_html__("Pricing Plan Image", "keydesign"),

                            "param_name" => "pricing_img",

                            "value" => "",

                            "description" => esc_html__("Upload your own custom image.", "keydesign"),

                        ),

                        array(

                            "type" => "dropdown",

                            "class" => "",

                            "heading" => esc_html__("Button CSS Animation", "keydesign"),

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

                            "save_always" => true,

                            "description" => esc_html__("Select type of animation for element to be animated when it enters the browsers viewport (Note: works only in modern browsers).", "keydesign"),

                        ),

                         array(

                            "type" => "dropdown",

                            "class" => "",

                            "heading" => esc_html__("Button Animation Delay:", "keydesign"),

                            "param_name" => "elem_animation_delay",

                            "value" => array(

                                "0 ms"              => "",

                                "200 ms"            => "200",

                                "400 ms"            => "400",

                                "600 ms"            => "600",

                            ),

                            "save_always" => true,

                            "dependency" =>	array(

                                "element" => "css_animation",

                                "value" => array("kd-animated fadeIn", "kd-animated fadeInDown", "kd-animated fadeInLeft", "kd-animated fadeInRight", "kd-animated fadeInUp", "kd-animated zoomIn")

                            ),

                            "description" => esc_html__("Enter animation delay in ms", "keydesign")

                        ),

                        array(

                            "type" => "textfield",

                            "class" => "",

                            "heading" => esc_html__("Option 1 value", "keydesign"),

                            "param_name" => "pricing_option1_value",

                            "value" => "",

                            "description" => esc_html__("Enter your option 1 value.", "keydesign")

                        ),

                        array(

                            "type" => "textfield",

                            "class" => "",

                            "heading" => esc_html__("Option 2 value", "keydesign"),

                            "param_name" => "pricing_option2_value",

                            "value" => ""

                        ),

                        array(

                            "type" => "textfield",

                            "class" => "",

                            "heading" => esc_html__("Option 3 value", "keydesign"),

                            "param_name" => "pricing_option3_value",

                            "value" => ""

                        ),

                        array(

                            "type" => "textfield",

                            "class" => "",

                            "heading" => esc_html__("Option 4 value", "keydesign"),

                            "param_name" => "pricing_option4_value",

                            "value" => ""

                        ),

                        array(

                            "type" => "textfield",

                            "class" => "",

                            "heading" => esc_html__("Option 5 value", "keydesign"),

                            "param_name" => "pricing_option5_value",

                            "value" => ""

                        ),

                        array(

                            "type" => "textfield",

                            "class" => "",

                            "heading" => esc_html__("Option 6 value", "keydesign"),

                            "param_name" => "pricing_option6_value",

                            "value" => ""

                        ),

                        array(

                            "type" => "textfield",

                            "class" => "",

                            "heading" => esc_html__("Option 7 value", "keydesign"),

                            "param_name" => "pricing_option7_value",

                            "value" => ""

                        ),

                        array(

                            "type" => "textfield",

                            "class" => "",

                            "heading" => esc_html__("Option 8 value", "keydesign"),

                            "param_name" => "pricing_option8_value",

                            "value" => ""

                        ),

                        array(

                            "type" => "textfield",

                            "class" => "",

                            "heading" => esc_html__("Option 9 value", "keydesign"),

                            "param_name" => "pricing_option9_value",

                            "value" => ""

                        ),

                        array(

                            "type" => "textfield",

                            "class" => "",

                            "heading" => esc_html__("Option 10 value", "keydesign"),

                            "param_name" => "pricing_option10_value",

                            "value" => ""

                        ),

                        array(

                            "type" => "textfield",

                            "class" => "",

                            "heading" => esc_html__("Option 11 value", "keydesign"),

                            "param_name" => "pricing_option11_value",

                            "value" => ""

                        ),

                        array(

                            "type" => "textfield",

                            "class" => "",

                            "heading" => esc_html__("Option 12 value", "keydesign"),

                            "param_name" => "pricing_option12_value",

                            "value" => ""

                        ),

                        array(

                            "type" => "textfield",

                            "class" => "",

                            "heading" => esc_html__("Option 13 value", "keydesign"),

                            "param_name" => "pricing_option13_value",

                            "value" => ""

                        ),

                        array(

                            "type" => "textfield",

                            "class" => "",

                            "heading" => esc_html__("Option 14 value", "keydesign"),

                            "param_name" => "pricing_option14_value",

                            "value" => ""

                        ),

                        array(

                            "type" => "textfield",

                            "class" => "",

                            "heading" => esc_html__("Option 15 value", "keydesign"),

                            "param_name" => "pricing_option15_value",

                            "value" => ""

                        ),

                        array(

                            "type" => "textfield",

                            "class" => "",

                            "heading" => esc_html__("Extra class name", "keydesign"),

                            "param_name" => "pricing_extra_class",

                            "value" => "",

                            "description" => esc_html__("If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file.", "keydesign")

                        ),

                    )

                ));

            }

        }



		// Render the element on front-end

        public function kd_pricingtable_shrt($atts, $content = null)

        {



			      $output = $link_target = $link_title = $pricing_button_link = $secodary_link = $tt_pricing_img = $tt_pricing_img_array = $animation_delay = $currency_symbol = '';



            extract(shortcode_atts(array(

                'pricing_title'                 => '',

                'pricing_price' 			          => '',

                'pricing_time' 				          => '',

                'pricing_currency' 			        => '',

                'pricing_other_currency'        => '',

                'pricing_currency_position'     => '',

                'pricing_other_text' 	          => '',

                'pricing_button_text' 		      => '',

                'pricing_button_link'           => '',

                'highlight_plan'                => '',

                'pricing_scheme'                => '',

                'pricing_img'                   => '',

                'css_animation'                 => '',

                'elem_animation_delay'          => '',

                'pricing_option1_value' 	      => '',

                'pricing_option2_value' 	      => '',

                'pricing_option3_value' 	      => '',

                'pricing_option4_value' 	      => '',

                'pricing_option5_value'         => '',

                'pricing_option6_value'         => '',

                'pricing_option7_value'         => '',

                'pricing_option8_value'         => '',

                'pricing_option9_value'         => '',

                'pricing_option10_value'        => '',

                'pricing_option11_value'        => '',

                'pricing_option12_value'        => '',

                'pricing_option13_value'        => '',

                'pricing_option14_value'        => '',

                'pricing_option15_value' 	      => '',

                'pricing_extra_class'           => ''

            ), $atts));



            switch($pricing_currency){

                    case 'currency-dollar':

                        $currency_symbol = "&#36;";

                    break;



                    case 'currency-euro':

                        $currency_symbol = "&#128;";

                    break;



              case 'currency-pound':

                        $currency_symbol = "&#163;";

                    break;



                    default:

                }



            if (!empty($pricing_other_currency)) {

                $currency_symbol = $pricing_other_currency;

            }



            if (($highlight_plan) != "active") {

                $secodary_link = "secondary-button-inverse";

            }



      			$href = vc_build_link($pricing_button_link);

      			if($href['url'] !== '') {

      				$link_target = (isset($href['target'])) ? 'target="'.$href['target'].'"' : '';

      				$link_title = (isset($href['title'])) ? 'title="'.$href['title'].'"' : '';

      			}



            if (!empty($pricing_img)) {

            $tt_pricing_img_array = wpb_getImageBySize ( $params = array( 'post_id' => NULL, 'attach_id' => $pricing_img, 'thumb_size' => 'full', 'class' => "" ) );

            $tt_pricing_img = '<div class="pricing-image">'. $tt_pricing_img_array['thumbnail'].'</div>';

            }



            //CSS Animation

            if ($css_animation == "no_animation") {

                $css_animation = "";

            }



            // Animation delay

            if ($elem_animation_delay) {

                $animation_delay = 'data-animation-delay='.$elem_animation_delay;

            }



            $output = '

				<div class="pricing-table '.$highlight_plan.' '.$pricing_scheme.' ' .$pricing_extra_class.'">

					<div class="row pricing-title">

					<div class="row pricing-title-content">'.$pricing_title.'</div>

						<div class="other-text">'.$pricing_other_text.'</div>

					</div>

					<div class="row pricing">

						<div class="col-lg-3 col-md-3 col-sm-3">

							<div class="row">

								<div class="pricing-img">'.$tt_pricing_img.'</div>';

                if ($pricing_currency_position == "currency-position-left") {

				          $output .= '<span class="pricing-price"><span class="currency">'.$currency_symbol.'</span>'.$pricing_price.'</span>';

                } elseif ($pricing_currency_position == "currency-position-right") {

                  $output .= '<span class="pricing-price">'.$pricing_price.'<span class="currency">'.$currency_symbol.'</span></span>';

                }

							$output .= '</div>

						</div>

						<div class="pricing-meta">

							<span class="pricing-time">'.$pricing_time.'</span>';

					$output .=	'</div>

						<div class="pricing-options-container">';



						if ($pricing_option1_value)  $output .= '<div class="pricing-row"><span class="pricing-value"><span class="pricing-option"><i class="fa fa-check"></i>'.$pricing_option1_value.'</span></span></div>';

						if ($pricing_option2_value)  $output .= '<div class="pricing-row"><span class="pricing-value"><span class="pricing-option"><i class="fa fa-check"></i>'.$pricing_option2_value.'</span></span></div>';

						if ($pricing_option3_value)  $output .= '<div class="pricing-row"><span class="pricing-value"><span class="pricing-option"><i class="fa fa-check"></i>'.$pricing_option3_value.'</span></span></div>';

						if ($pricing_option4_value)  $output .= '<div class="pricing-row"><span class="pricing-value"><span class="pricing-option"><i class="fa fa-check"></i>'.$pricing_option4_value.'</span></span></div>';

						if ($pricing_option5_value)  $output .= '<div class="pricing-row"><span class="pricing-value"><span class="pricing-option"><i class="fa fa-check"></i>'.$pricing_option5_value.'</span></span></div>';

						if ($pricing_option6_value)  $output .= '<div class="pricing-row"><span class="pricing-value"><span class="pricing-option"><i class="fa fa-check"></i>'.$pricing_option6_value.'</span></span></div>';

						if ($pricing_option7_value)  $output .= '<div class="pricing-row"><span class="pricing-value"><span class="pricing-option"><i class="fa fa-check"></i>'.$pricing_option7_value.'</span></span></div>';

						if ($pricing_option8_value)  $output .= '<div class="pricing-row"><span class="pricing-value"><span class="pricing-option"><i class="fa fa-check"></i>'.$pricing_option8_value.'</span></span></div>';

						if ($pricing_option9_value)  $output .= '<div class="pricing-row"><span class="pricing-value"><span class="pricing-option"><i class="fa fa-check"></i>'.$pricing_option9_value.'</span></span></div>';

						if ($pricing_option10_value)  $output .= '<div class="pricing-row"><span class="pricing-value"><span class="pricing-option"><i class="fa fa-check"></i>'.$pricing_option10_value.'</span></span></div>';

						if ($pricing_option11_value)  $output .= '<div class="pricing-row"><span class="pricing-value"><span class="pricing-option"><i class="fa fa-check"></i>'.$pricing_option11_value.'</span></span></div>';

						if ($pricing_option12_value)  $output .= '<div class="pricing-row"><span class="pricing-value"><span class="pricing-option"><i class="fa fa-check"></i>'.$pricing_option12_value.'</span></span></div>';

						if ($pricing_option13_value)  $output .= '<div class="pricing-row"><span class="pricing-value"><span class="pricing-option"><i class="fa fa-check"></i>'.$pricing_option13_value.'</span></span></div>';

						if ($pricing_option14_value)  $output .= '<div class="pricing-row"><span class="pricing-value"><span class="pricing-option"><i class="fa fa-check"></i>'.$pricing_option14_value.'</span></span></div>';

						if ($pricing_option15_value)  $output .= '<div class="pricing-row"><span class="pricing-value"><span class="pricing-option"><i class="fa fa-check"></i>'.$pricing_option15_value.'</span></span></div>';



						$output .= '</div>';

                                        if ($pricing_button_text) $output .= '<a href="'.$href['url'].'"'.$link_target.''.$link_title.' class="tt_button '.$css_animation.'" '.$animation_delay.'>'.$pricing_button_text.'</a>';



					$output .= '</div>

				</div>';



			return $output;

        }

    }

}

if (class_exists('KD_ELEM_PRICING_TABLE')) {

    $KD_ELEM_PRICING_TABLE = new KD_ELEM_PRICING_TABLE;

}

?>
