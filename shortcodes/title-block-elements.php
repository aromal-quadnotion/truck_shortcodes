<?php



add_action('init', 'quad_title_block_init', 99 );
function quad_title_block_init(){


    global $kc;
    $kc->add_map(
        array(
            'quad_title_block' => array(
                'name' => 'Title Block',
                'description' => __('', 'kingcomposer'),
                'icon' => 'sc-icon sc-icon-showcase',
                'category' => 'Quadnotion',
                'preview_editable' => true,
                'is_container' => true,// this line works for the editor section. If it is not here. Content html editor will not work.
                'params' => array(
                    'Notion Elements' => array( //if we did't give this option. The KC will generate an default General option
                      array(
                          'name' => 'title_color',
                          'label' => 'Select Heading Color',
                          'type' => 'color_picker',
                          'value' => '#000000',
                          'admin_label' => true,
                      ),
                      array(
                          'name' => 'qn_title',
                          'label' => 'Heading',
                          'type' => 'text',
                          'value' => '',
                          'admin_label' => true,
                      ),

                      array(
                          'name' => 'text_color',
                          'label' => 'Select Promo Text Color',
                          'type' => 'color_picker',
                          'value' => '#000000',
                          'admin_label' => true,
                      ),
                      array(
                          'name' => 'qn_text',
                          'label' => 'Promo Text',
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
function render_quad_title_block($atts, $content = null){
    extract( shortcode_atts( array(
        'qn_title' => '',
        'title_color' => '',
        'qn_text' => '',
        'text_color' => '',

    ), $atts) );

      $options = get_option( 'aromal_demo' );
      //var_dump($options['opt-typography-body']);
      $font = $options['opt-typography-body']['font-family'];
      //var_dump($font);

    $tit_txt = '<div class="col-md-8 col-md-offset-2 gtco-section text-center gtco-heading animate-box" data-animate-effect="fadeIn">
      <h2 style="color: '.$title_color.'; font-family: '.$font.';">'.$qn_title.'</h2>
      <p style="color: '.$text_color.'">'.$qn_text.'</p>
    </div>';



    $output= $tit_txt;


    return $output;
}

add_shortcode('quad_title_block', 'render_quad_title_block');
