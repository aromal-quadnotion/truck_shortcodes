<?php



add_action('init', 'quad_feature_block_init', 99 );
function quad_feature_block_init(){


    global $kc;
    $kc->add_map(
        array(
            'quad_feature_block' => array(
                'name' => 'Features Block',
                'description' => __('', 'kingcomposer'),
                'icon' => 'sc-icon sc-icon-showcase',
                'category' => 'Quadnotion',
                'preview_editable' => true,
                'is_container' => true,// this line works for the editor section. If it is not here. Content html editor will not work.
                'params' => array(
                    'Notion Elements' => array( //if we did't give this option. The KC will generate an default General option
                      array(
                          'name' => 'icon',
                          'label' => 'Select Icon',
                          'type' => 'icon_picker',
                          'admin_label' => true,
                      ),
                      array(
                          'name' => 'title',
                          'label' => 'Heading',
                          'type' => 'text',
                          'value' => '',
                          'admin_label' => true,
                      ),
                      array(
                          'name' => 'text',
                          'label' => 'Text',
                          'type' => 'textarea',
                          'value' => '',
                      ),


                    )
                )
            )
        )
    );
}
// Register Before After Shortcode
function render_quad_feature_block($atts, $content = null){
    extract( shortcode_atts( array(
        'icon' => '',
        'title' => '',
        'text' => '',

    ), $atts) );


    $tit_txt = '<div class="feature-center animate-box" data-animate-effect="fadeIn">
      <span class="icon">
        <i class="'.$icon.'"></i>
      </span>
      <h3>'.$title.'</h3>
      <p>'.$text.'</p>
    </div>';



    $output= $tit_txt;


    return $output;
}

add_shortcode('quad_feature_block', 'render_quad_feature_block');
