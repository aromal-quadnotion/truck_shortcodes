<?php



add_action('init', 'test_aromal_init', 99 );
function test_aromal_init(){


    global $kc;
    $kc->add_map(
        array(
            'test_aromal' => array(
                'name' => 'Aromal Elements',
                'description' => __('', 'kingcomposer'),
                'icon' => 'sc-icon sc-icon-showcase',
                'category' => 'Notion Shortcodes',
                'preview_editable' => true,
                'is_container' => true,// this line works for the editor section. If it is not here. Content html editor will not work.
                'params' => array(
                    'Aromal' => array( //if we did't give this option. The KC will generate an default General option
                      array(
                          'name' => 'title',
                          'label' => 'Heading',
                          'type' => 'text',
                          'value' => '',
                      ),
                      array(
                          'name' => 'ae_image',
                          'label' => 'Fold One Image',
                          'type' => 'attach_image',
                          'admin_label' => true,
                      ),
                      array(
                          'name' => 'at_text',
                          'label' => 'Text',
                          'type' => 'textarea',
                          'value' => '',
                      ),
                      array(
                        'name' => 'as_parallax',
                        'label' => 'Drop Down',
                        'type' => 'select',
                        'options' => array(
                             'none' => 'None',
                             'bg_img' => 'Use Background Image',
                             'upload_img' => 'Upload New Image',
                        ),
                        'value' => 'bg_img',
                        'description' => '',
                        'admin_label' => true, // Show in admin_view, you can remove this if you dont want preview value
                      ),
                      array(
                        'name' => 'content',
                        'label' => 'HTML Code',
                        'type' => 'textarea_html',
                        'value' => '',
                        'admin_label' => true,
                    ),
                    array(
                        'name' => 'am_multiple',
                        'label' => 'Multiple Select',
                        'type' => 'multiple',  // USAGE MULTIPLE TYPE
                        'options' => array(    // REQUIRED
                            'option_1' => 'multiple 1',
                            'option_2' => 'multiple 2',
                            'option_3' => 'multiple 3',
                            'option_4' => 'multiple 4',
                            'option_5' => 'multiple 5',
                            'option_6' => 'multiple 6',
                        ),
                        'value' => '', // remove this if you do not need a default content
                        'description' => '',
                    ),
                    array(
                        'name'    => 'ao_checkbox',
                        'label'   => 'Select ur Option',
                        'type'    => 'checkbox',
                        'options' => array(
                            'option_1' => 'Option 1',
                            'option_2' => 'Option 2',
                            'option_3' => 'Option 3',
                        )
                    ),
                    array(
                        'name' => 'ai_image',
                        'label' => 'Upload Images',
                        'type' => 'attach_images',
                        'admin_label' => true,
                    ),
                    array(
                        'name' => 'ar_color',
                        'label' => 'Select Color',
                        'type' => 'color_picker',
                        'value' => '#ff0000',
                        'admin_label' => true,
                    ),
                    array(
                        'name' => 'ac_icon',
                        'label' => 'Select Icon',
                        'type' => 'icon_picker',
                        'admin_label' => true,
                    ),
                    array(
                        'name' => 'ar_date',
                        'label' => 'Yr DOB',
                        'type' => 'date_picker',  // USAGE DATE_PICKER TYPE
                        'description' => '',
                    ),
                    array(
                        'name' => 'ar_map',
                        'label' => 'Select Location',
                        'type' => 'google_map',
                        'admin_label' => true,
                    ),
                    array(
                        'name' => 'ar_post_count',
                        'label' => 'Number post show',
                        'type' => 'number_slider',
                        'options' => array(
                            'min' => 0,
                            'max' => 200,
                            'unit' => 'post',
                            'show_input' => true
                        ),
                        'description' => 'Display number of post'
                    ),
                    array(
                        'name' => 'ar_link',
                        'label' => 'Read More',
                        'type' => 'link',
                        'value' => 'link|caption|target',//refer#222
                        'description' => '',
                    ),


                    )
                )
            )
        )
    );
}
// Register Before After Shortcode
function render_test_aromal($atts, $content = null){
    extract( shortcode_atts( array(
        'title' => '',
        'ae_image' => '',
        'at_text' => '',
        'as_parallax' =>'',
        'content' =>'',
        'am_multiple' =>'',
        'ao_checkbox' =>'',
        'ai_image' => '',
        'ar_color' => '',
        'ac_icon' => '',
        'ar_date' => '',//Dont know how to add custom date field
        'ar_map' => '',//dont know
        'ar_post_count' => '',
        'ar_link' => '',


    ), $atts) );


    $ae_image_markup = '';
    if($ae_image != ''){
        $ae_img = wp_get_attachment_image_src( $ae_image , 'full');
        $ae_image_url = $ae_img[0];
        $ae_image_markup = '<img src="'.esc_url($ae_image_url).'">';
    }
// display group of images
    $ai_image_gallery_markup = '';
  // var_dump($ai_image);
//image is in string. move this values to array
    $ai_image_collection = explode(",", $ai_image);


    foreach ($ai_image_collection as $ai_image_item) {
      $ai_img = wp_get_attachment_image_src( $ai_image_item , 'full');
      $ai_image_item_url = $ai_img[0];
      $ai_image_gallery_markup .= '<img src="'.esc_url($ai_image_item_url).'">';
    }

//var_dump($ar_link);

$ar_linkattrs = explode("|", $ar_link);//refer #222

  // var_dump($ar_linkattrs[0]);
  // var_dump($ar_linkattrs[1]);
  // var_dump($ar_linkattrs[2]);

// to conver the color code to RGB
  $hex = $ar_color;
  list($r, $g, $b) = sscanf($hex, "#%02x%02x%02x");


    $output= '<h1 class="a-title">'.esc_html($title).'</h1>'.$ae_image_markup.'<p>'
             .esc_html($at_text).'</p>'.$as_parallax.$content.$am_multiple.$ao_checkbox.'<div>'
             .$ai_image_gallery_markup.'</div><span style="color:rgba('.$r.', '.$g.', '.$b.', 0.5)">Aromal</span>
             <i class="fa '.$ac_icon.'" aria-hidden="true"></i>Your Post Date:'.$ar_date.$ar_post_count.
             '<a title="'.$ar_linkattrs[1].'" target="'.$ar_linkattrs[2].'" href="'.esc_url($ar_linkattrs[0]).'">'.$ar_linkattrs[1].'</a>';


    return $output;
}

add_shortcode('test_aromal', 'render_test_aromal');
