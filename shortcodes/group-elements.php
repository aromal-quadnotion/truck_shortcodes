<?php



add_action('init', 'group_aromal_init', 99 );
function group_aromal_init(){


    global $kc;
    $kc->add_map(
        array(
          'group_aromal' => array(
'name' => __('My Element', 'KingComposer'),
'description' => __('', 'KingComposer'),
'icon' => 'sc-icon sc-icon-groupabc',
'category' => 'Notion Shortcodes',
'css_box' => true,
'params' => array(

  array(
      'name' => 'ar_title',
      'label' => 'Image Title',
      'type' => 'text',
      'value' => '',
  ),
  array(
      'name' => 'ar_image',
      'label' => 'Fold One Image',
      'type' => 'attach_image',
      'admin_label' => true,
  ),

  //group starting section
  array(
    'type'			=> 'group',
    'label'			=> __('Link Social Page', 'KingComposer'),
    'name'			=> 'ar_social',
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
          'name' => 'ar_icon',
          'label' => 'Select Icon',
          'type' => 'icon_picker',
          'admin_label' => true,
      ),
      array(
          'name' => 'ar_link',
          'label' => 'Icon Link',
          'type' => 'text',
          'value' => '#',
      ),

    ),
  ),//group ending section

)

)
        )
    );
}
// Register Before After Shortcode
function render_group_aromal($atts, $content = null){
    extract( shortcode_atts( array(
        'ar_title' => '',
        'ar_image' => '',
        'ar_social' => '',

    ), $atts) );

    $ar_image_markup = '';
    if($ar_image != ''){
        $ar_img = wp_get_attachment_image_src( $ar_image , 'full');
        $ar_image_url = $ar_img[0];
        $ar_image_markup = '<img src="'.esc_url($ar_image_url).'">';
    }


    //foreach ($atts['ar_social'] as $key => $item) {
    //  $itemXML = $items->findItemInXML($item['itemId']);
  //  .$items->getIcon($itemXML).
  //  $ico1 = wp_get_icon ( $item , 'full');
  //  $ai_icon_url1 = $ico1[0];
    //$out1 = '<i class="'.esc_html($ai_icon_url1).'">';
//    $ai_icon_url2 = $ico1[1];
  //  }

//var_dump($ar_social);

  $ar_out_icon ='';
foreach ($atts['ar_social'] as $key => $item) {

      $ar_ico = $item->ar_icon;
      $ar_lin = $item->ar_link;

      $ar_out_icon .= '<a href="http://'.$ar_lin.'"><i class="fa '.$ar_ico.'"></i></a>';

  }


//FOR LOOP

// $ar_out_icon ='';
//     for($i = 1; $i <= count($ar_social); $i++){
//         foreach($ar_social[$i] as $key => $item)
//
//
//            echo $key . ' = ' . $item . '<br>';
//
//            $ar_ico = $item->ar_icon;
//            $ar_lin = $item->ar_link;
//            echo $ar_ico;
// $ar_lic = $item[0];
// $ar_ico = $item[1];
// echo $item;
           ////$ar_ico = $item[0];
          // $ar_lin = $item[$i];
//echo $ar_ico;

      //     $ar_out_icon .= '<a href="http://'.$ar_lic.'"><i class="fa '.$ar_ico.'"></i></a>';
//echo $ar_out_icon;
  //  }

//var_dump($ar_social);

//$ar_out_icon = '';
//echo count($ar_social);
//print_r($ar_social);
    //for ($i = 1; $i <= count($ar_social); $i++){
    //  for ($j = 0; $j <= count($ar_social[$i]); $j++){
    //    echo "\$ar_social[$i][$j] = ",
//$ar_out_ic = $ar_social[$i];
//echo ($ar_social[$i]);
    //for ($j = 0; $j <= count($ar_social[$i]); $j++){
     //echo ($ar_social[$i][$j]);
    //}

// to refer
//     $ar_myarray = array(
//                     array(
//                       array("one", "two", "three") ),
//                       array( "four", "five", "six" )
//                     );
// var_dump(($ar_myarray));
// for ($i = 0; $i < count($ar_myarray); $i++){
//
//   // echo $ar_myarray[$i];
//   for ($j =0; $j < count($ar_myarray[$i]); $j++){
//     for ($k =0; $k < count($ar_myarray[$i][$j]); $k++){
//
//     echo $ar_myarray[$i][$j][$k];
//   }}
// }




    $output = '<h1>'.esc_html($ar_title).'</h1>'.$ar_image_markup;


    return $output;
}

add_shortcode('group_aromal', 'render_group_aromal');
