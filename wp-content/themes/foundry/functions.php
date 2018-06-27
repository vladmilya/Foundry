<?php
function foundry_style() {
    wp_register_style( 'bootstrap', get_template_directory_uri() . '/css/main-bootstrap.css');
    wp_enqueue_style( 'bootstrap');
    wp_register_style( 'maincss', get_template_directory_uri() . '/css/style.css');
    wp_enqueue_style( 'maincss');
    
}
add_action( 'wp_enqueue_scripts', 'foundry_style' );

function foundry_scripts() {   
    wp_register_script( 'init', get_template_directory_uri() . '/js/init.js', array(), false, false );
    wp_enqueue_script( 'init');
    wp_register_script( 'bootstrap', get_template_directory_uri() . '/js/bootstrap.min.js', array(), false, true );
    wp_enqueue_script( 'bootstrap');
}
add_action( 'wp_enqueue_scripts', 'foundry_scripts' );

function foundry_widgets_init() {
    register_sidebar( array(
		'name'          => __( 'News Side Bar', 'foundry' ),
		'id'            => 'news',
		'description'   => __( 'Add widgets here to appear on the news pages.', 'foundry' ),
		'before_widget' => '',
		'after_widget'  => '',
		'before_title'  => '<h2>',
		'after_title'   => '</h2>',
	) );
}
add_action( 'widgets_init', 'foundry_widgets_init' );

//featured images on
add_theme_support( 'post-thumbnails' );

//categories extra fields
add_action ( 'edit_category_form_fields', 'extra_category_fields');

function extra_category_fields( $cat ) {
	$t_id = @$cat->term_id;
	$cat_meta = get_option( "category_$t_id");
?>
<tr class="form-field">
<th scope="row" valign="top"><label for="extra1"><?php _e('Short Description'); ?></label></th>
<td>
    <textarea name="Cat_meta[short_description]" id="Cat_meta[short_description]"><?php echo $cat_meta['short_description']?></textarea>
<br />
            <span class="description"><?php _e('Short description for main page'); ?></span>
        </td>
</tr>
<?php
}

add_action ( 'edited_category', 'save_extra_category_fields');

function save_extra_category_fields( $term_id ) {
	if ( isset( $_POST['Cat_meta'] ) ) {
		$t_id = $term_id;
		$cat_meta = get_option( "category_$t_id");
		$cat_keys = array_keys($_POST['Cat_meta']);
			foreach ($cat_keys as $key){
			if (isset($_POST['Cat_meta'][$key])){
				$cat_meta[$key] = $_POST['Cat_meta'][$key];
			}
		}
		//save the option array
		update_option( "category_$t_id", $cat_meta );
	}
}

function trim_string($mess, $length){
    if(strlen($mess) > $length){
        $mess = substr($mess, 0, $length) . '...';
    }
    echo '<td>'.$mess.'</td>';
}

function getAdjascentKey( $key, $hash = array(), $increment ) {
    $keys = array_keys( $hash );
    $found_index = array_search( $key, $keys );
    if ( $found_index === false ) {
        return false;
    }
    return $keys[$found_index+$increment];
}

function facebookShareLink($url, $title, $description, $img){
    $link = 'https://www.facebook.com/dialog/feed?app_id=184683071273';
    if(!empty($url)){
        $link.= '&link='.urlencode($url);
    }
    if(!empty($img)){
        $link.= '&picture='.urlencode($img);
    }
    if(!empty($title)){
        $link.= '&name='.urlencode(trim(strip_tags($title)));
    }
    if(!empty($description)){
        $link.= '&description='.urlencode(trim(strip_tags($description)));
    }
    $link.= '&caption=%20&redirect_uri=http%3A%2F%2Fwww.facebook.com%2F';
    return $link;
}

function  twitterShareLink($text, $url=''){
    if($url){
        $text.= ' '.$url;
    }
    $link = 'http://twitter.com/intent/tweet?text='.urlencode(trim(strip_tags($text)));
    return $link;
}

function  emailLink($subject, $body, $url=''){
    if($url){
        $body.= ' '.$url;
    }
    $link = 'mailto:?subject='.trim(strip_tags($subject)).'&body='.trim(strip_tags($body));
    return $link;
}


function dump($var){
    echo "<pre>";
    print_r($var);
    echo "</pre>";
    echo "<hr />";
}
