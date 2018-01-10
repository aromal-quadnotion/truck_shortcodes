<?php



add_action('init', 'quad_highlight_box_init', 99 );
function quad_highlight_box_init(){


    global $kc;
    $kc->add_map(
        array(
            'quad_highlight_box' => array(
                'name' => 'Highlight Box',
                'description' => __('', 'kingcomposer'),
                'icon' => 'sc-icon sc-icon-showcase',
                'category' => 'Quadnotion',
                'preview_editable' => true,
                'is_container' => true,// this line works for the editor section. If it is not here. Content html editor will not work.
                'params' => array(
                    'Notion Elements' => array( //if we did't give this option. The KC will generate an default General option
                      array(
                        'name' => 'highlight_this',
                        'label' => 'Highlight This Block',
                        'type' => 'toggle',
                      ),
                      array(
                          'name' => 'title',
                          'label' => 'Heading',
                          'type' => 'text',
                          'value' => '',
                      ),
                      array(
                          'name' => 'text',
                          'label' => 'Text',
                          'type' => 'textarea',
                          'value' => '',
                      ),
                    array(
                        'name' => 'icon',
                        'label' => 'Select Icon',
                        'type' => 'icon_picker',
                        'admin_label' => true,
                    ),
                    array(
                        'name' => 'link',
                        'label' => 'Read More',
                        'type' => 'text',
                        'value' => '#',
                        'description' => '',
                    ),


                    )
                )
            )
        )
    );
}
// Register Before After Shortcode
function render_quad_highlight_box($atts, $content = null){
    extract( shortcode_atts( array(
        'highlight_this' => '',
        'title' => '',
        'text' => '',
        'icon' =>'',
        'link' =>'',

    ), $atts) );


    $highlightclass = 'feature-1';
    if ($highlight_this == 'yes') {
      $highlightclass = 'feature-2';
    }


    $output= '<div id="gtco-features-3">
  		          <div class="gtco-container">
  			          <div class="gtco-flex">
                    <div class="feature '.$highlightclass.' animate-box" data-animate-effect="fadeInUp">
                      <div class="feature-inner">
                        <span class="icon">
                          <i class="'.$icon.'"></i>
                        </span>
                        <h3>'.$title.'</h3>
                        <p>'.$text.'</p>
                        <p><a href="'.$link.'" class="btn btn-white btn-outline">Learn More</a></p>
                      </div>
                    </div>
                  </div>
                </div>
              </div>';

    return $output;
}

add_shortcode('quad_highlight_box', 'render_quad_highlight_box');
