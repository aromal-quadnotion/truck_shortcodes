<?php

//$options = get_option( 'quadnotion-portfolio' );
//var_dump($options);

add_action('init', 'quad_portfolio_block_init', 99 );
function quad_portfolio_block_init(){


    global $kc;
    $kc->add_map(
        array(
            'quad_portfolio_block' => array(
                'name' => 'Portfolio Block',
                'description' => __('', 'kingcomposer'),
                'icon' => 'sc-icon sc-icon-showcase',
                'category' => 'Quadnotion',
                'preview_editable' => true,
                'is_container' => true,// this line works for the editor section. If it is not here. Content html editor will not work.
                'css_box' => true,
                'params' => array(
                    'Notion Elements' => array( //if we did't give this option. The KC will generate an default General option
                      array(
                        'name' => 'display_full',
                        'label' => 'Show Complete Portfolio Items',
                        'type' => 'toggle',
                      ),
                      array(
                          'name' => 'count',
                          'label' => 'Specify Number of Portfolio item to be display',
                          'type' => 'text',
                          'value' => '5',
                          'admin_label' => true,
                          'relation' => array(
                            'parent' => 'display_full',
                            'hide_when' => 'yes',
                          )
                      ),


                    )
                )
            )
        )
    );
}
// Register Before After Shortcode
function render_quad_portfolio_block($atts, $content = null){
    extract( shortcode_atts( array(
        'display_full' => '',
        'count' => '',

    ), $atts) );

    $portfolio_items = '';
    $portfolio_cat= '';

        $item_count = $count;

        if($display_full == 'yes')
            $item_count = '-1';

            $portfolio_loop = new WP_Query( array( 'post_type' => 'quadnotion-portfolio', 'posts_per_page' => $item_count) );

            while ( $portfolio_loop->have_posts() )
                {

                    $portfolio_loop->the_post();
                    $cat_nam = get_post_meta( get_the_ID(), 'quadnotion_post_category', true );
                    $layout = get_post_meta( get_the_ID(), 'quadnotion_post_layout', true );
                    $img_url = get_the_post_thumbnail_url( get_the_ID(), 'full' );
                    $title = get_the_title();
                    $link = get_permalink();;

                    $portfolio_items .= '<li class="'.$layout.' animate-box" data-animate-effect="fadeIn" style="background-image: url('.$img_url.');" >
                                <a href="'.$link.'" class="color-1">
                                  <div class="case-studies-summary">
                                    <span>'.$cat_nam.'</span>
                                    <h2>'.$title.'</h2>
                                  </div>
                                </a>
                              </li>';

                }

                while ( $portfolio_loop->have_posts() )
                    {

                        $portfolio_loop->the_post();
                        $cat_name = get_post_meta( get_the_ID(), 'quadnotion_post_category', true );
                        //var_dump($cat_nam);

                        $portfolio_cat .= '<li style="padding-right: 10px;">
                                    <a href="#">
                                      '.$cat_name.'
                                    </a>
                                  </li>';

                    }


    // $portfolio_up ='';
    //   foreach ($atts['portfolio'] as $key => $item) {
    //     $col_md = $item->col;
    //     $category_md = $item->category;
    //     $title_md = $item->title;
    //     $image_md = $item->image;
    //
    //         $image_md_markup = '';
    //           if($image_md != ''){
    //             $img = wp_get_attachment_image_src( $image_md , 'full');
    //             $image_md_url = $img[0];
    //             $image_md_markup = $image_md_url;
    //           }
//var_dump($image_md_markup);
    //     $portfolio_up .= '<li class="'.$col_md.' animate-box" data-animate-effect="fadeIn" style="background-image: url('.$image_md_markup.'); ">
    //       <a href="#" class="color-1">
    //         <div class="case-studies-summary">
    //           <span>'.$category_md.'</span>
    //           <h2>'.$title_md.'</h2>
    //         </div>
    //       </a>
    //     </li>';
    //
    // }

    $out = '<div class="gtco-section">
              <div class="gtco-container">
                <div class="row row-pb-md">
                  <div class="col-md-12">
                    <ul id="navcontainer" style="list-style-type: none !important;">
                      <a href=""><span style="padding-right: 10px;">All Category</span></a>'.$portfolio_cat.'
                    </ul>
                    <ul id="gtco-portfolio-list">
                      '.$portfolio_items.'
                    </ul>
                  </div>
                </div>
              </div>
            </div> ';

            // $out_cat = '<div class="gtco-section">
            //           <div class="gtco-container">
            //             <div class="row">
            //               <div class="col-md-12">
            //                 <ul id="navcontainer">
            //                   '.$portfolio_cat.'
            //                 </ul>
            //               </div>
            //             </div>
            //           </div>
            //         </div> ';


    $output= $out;


    return $output;
}

add_shortcode('quad_portfolio_block', 'render_quad_portfolio_block');
