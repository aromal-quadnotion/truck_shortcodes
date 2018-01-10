<?php



add_action('init', 'quad_team_block_init', 99 );
function quad_team_block_init(){


    global $kc;
    $kc->add_map(
        array(
            'quad_team_block' => array(
                'name' => 'Team Block',
                'description' => __('', 'kingcomposer'),
                'icon' => 'sc-icon sc-icon-showcase',
                'category' => 'Quadnotion',
                'preview_editable' => true,
                'is_container' => true,// this line works for the editor section. If it is not here. Content html editor will not work.
                'params' => array(
                    'Notion Elements' => array( //if we did't give this option. The KC will generate an default General option
                      array(
                          'name' => 'image',
                          'label' => 'person image',
                          'type' => 'attach_image',
                      ),
                      array(
                          'name' => 'name',
                          'label' => 'Name',
                          'type' => 'text',
                          'value' => '',
                          'admin_label' => true,
                      ),
                      array(
                          'name' => 'designation',
                          'label' => 'Designation',
                          'type' => 'text',
                          'value' => '',
                          'admin_label' => true,
                      ),
                      array(
                          'name' => 'description',
                          'label' => 'Description',
                          'type' => 'textarea',
                          'value' => '',
                      ),

                      array(
                        'type'			=> 'group',
                        'label'			=> __('Link Social Page', 'KingComposer'),
                        'name'			=> 'social',
                        'description'	=> __( '', 'KingComposer' ),
                        'options'		=> array('add_text' => __('Add new social page', 'kingcomposer')),
                        'value' => base64_encode( json_encode(array(
                          "1" => array(
                            "ar_icon" => "fa-facebook-f",
                            "ar_link" => "#"
                          ),

                        ) ) ),
                        'params' => array(
                          array(
                              'name' => 'icon',
                              'label' => 'Select Icon',
                              'type' => 'icon_picker',
                              'admin_label' => true,
                          ),
                          array(
                              'name' => 'link',
                              'label' => 'Icon Link',
                              'type' => 'text',
                              'value' => '#',
                          ),

                        ),
                      ),
                    )
                )
            )
        )
    );
}
// Register Before After Shortcode
function render_quad_team_block($atts, $content = null){
    extract( shortcode_atts( array(
        'image' => '',
        'name' => '',
        'designation' => '',
        'description' => '',
        'social' => '',

    ), $atts) );


    $image_markup = '';
    if($image != ''){
        $img = wp_get_attachment_image_src( $image , 'full');
        $image_url = $img[0];
        $image_markup = '<img src="'.esc_url($image_url).'">';
    }


    $social_icon ='';
  foreach ($atts['social'] as $key => $item) {

        $ar_ico = $item->icon;
        $ar_lin = $item->link;

        $social_icon .= '<li><a href="http://'.$ar_lin.'"><i class="fa '.$ar_ico.'"></i></a></li>';

    }


    $tem_blck = '<div class="animate-box" data-animate-effect="fadeIn">
      <div class="gtco-staff">
        '.$image_markup.'
        <h3>'.$name.'</h3>
        <strong class="role">'.$designation.'</strong>
        <p>'.$description.'</p>
        <ul class="gtco-social-icons">
          '.$social_icon.'
        </ul>
      </div>
    </div>';



    $output= $tem_blck;


    return $output;
}

add_shortcode('quad_team_block', 'render_quad_team_block');
