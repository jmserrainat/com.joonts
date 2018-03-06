<?php
if (!class_exists('KD_ELEM_VIDEO')) {
    class KD_ELEM_VIDEO extends KEYDESIGN_ADDON_CLASS {
        function __construct() {
            add_action('init', array($this, 'kd_video_init'));
            add_shortcode('tek_video', array($this, 'kd_video_shrt'));
        }

        // Element configuration in admin
        function kd_video_init() {
            if (function_exists('vc_map')) {
                vc_map(array(
                    "name" => esc_html__("Video Modal", "keydesign"),
                    "description" => esc_html__("Video modal", "keydesign"),
                    "base" => "tek_video",
                    "class" => "",
                    "icon" => plugins_url('assets/element_icons/video-modal.png', dirname(__FILE__)),
                    "category" => esc_html__("KeyDesign Elements", "keydesign"),
                    "params" => array(
						array(
							"type" => "kd_param_notice",
							"text" => "<span style='display: block;'>Please use the YouTube embed link for the video - eg: see the following <a href='".plugins_url('assets/img/youtube-embed.png', dirname(__FILE__))."' target='_blank'>image</a>.</span>",
							"param_name" => "notification",
							"edit_field_class" => "vc_column vc_col-sm-12",
                        ),
                        array(
                            "type" => "textfield",
                            "class" => "",
                            "heading" => esc_html__("Youtube URL", "keydesign"),
                            "param_name" => "video_url",
                            "value" => "",
							"description" => esc_html__("Copy youtube url here", "keydesign")
                        ),
                        array(
                            "type" => "attach_image",
                            "heading" => esc_html__("Video preview image:", "keydesign"),
                            "param_name" => "video_image",
                            "description" => esc_html__("Upload Video preview image", "keydesign")
                        ),
                        array(
                            "type" => "dropdown",
                            "class" => "",
                            "heading" => esc_html__("Open Video In", "keydesign"),
                            "param_name" => "video_location",
                            "value" => array(
                                "Modal ( Same Window )" => "",
                                "New Window" => "video_location_new",
                            ),
                        ),

                        array(
                            "type" => "textfield",
                            "class" => "",
                            "heading" => esc_html__("Extra class name", "keydesign"),
                            "param_name" => "video_extra_class",
                            "value" => "",
                            "description" => esc_html__("If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file.", "keydesign")
                        ),
                    )
                ));
            }
        }



		// Render the element on front-end
        public function kd_video_shrt($atts, $content = null)
        {
            extract(shortcode_atts(array(
                'video_url'             => '',
                'video_location' 		=> '',
                'video_image' 			=> '',
                'video_extra_class'     => '',
            ), $atts));

            $image  = wpb_getImageBySize($params = array(
                'post_id' => NULL,
                'attach_id' => $video_image,
                'thumb_size' => 'full',
                'class' => ""
            ));

            $new_video_url = substr($video_url, -3);

            $output = "<div class='video-container {$video_extra_class}'>
                        {$image['thumbnail']}";
            if ($video_location == 'video_location_new')  {
                $output .="<a href='{$video_url}' target='_blank'>";
            }
            else {
            $output .="<a data-toggle='modal' data-target='#video-modal-{$new_video_url}' data-backdrop='true'>";
            }

            $output .="<span class='play-video'><span class='fa fa-play'></span></span></a>

                        </div>";

            if ($video_location != 'video_location_new')  {
            $output .= "<div class='modal fade video-modal' id='video-modal-{$new_video_url}' role='dialog'>
                            <div class='modal-content'>
                                <div class='row'>
                                 <iframe width='712' height='400' src='{$video_url}' allowfullscreen></iframe>
                                </div>
                            </div>
                        </div>";
            }
            return $output;
        }
    }
}

if (class_exists('KD_ELEM_VIDEO')) {
    $KD_ELEM_VIDEO = new KD_ELEM_VIDEO;
}

?>
