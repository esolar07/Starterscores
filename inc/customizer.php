<?php
/**
 * Starterscores Theme Customizer.
 *
 * @package Starterscores
 */

/**
 * Add postMessage support for site title and description for the Theme Customizer.
 *
 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
 */
function starterscores_customize_register( $wp_customize ) {
	$wp_customize->get_setting( 'blogname' )->transport         = 'postMessage';
	$wp_customize->get_setting( 'blogdescription' )->transport  = 'postMessage';
	$wp_customize->get_setting( 'header_textcolor' )->transport = 'postMessage';
	
	//customizer setting for header color
	$wp_customize->add_setting( 'header_color', array(
		'default' => '#000000',
		'type' => 'theme_mod',
		'sanitize_callback' => 'sanitize_hex_color',
		'transport' => 'postMessage',
	));
	
	//customizer control for header color
	$wp_customize->add_control(
		new WP_Customize_Color_Control(
			$wp_customize,
			'header_color', array(
				'label' => __('Header Background Color', 'starterscores'),
				'section' => 'colors'
			)
		)
	);
	
	//customizer new section
	$wp_customize->add_section( 'starterscores-options', array(
		'title' => __( 'Theme Options', 'starterscores' ),
		'capability' => 'edit_theme_options',
		'description' => __( 'Change the default display options for the theme.', 'starterscores' ),
	));
	
	
	//customizer setting for sidebar
	
	$wp_customize->add_setting(	'layout_setting',
		array(
			'default' => 'no-sidebar',
			'type' => 'theme_mod',
			'sanitize_callback' => 'starterscores_sanitize_layout', 
			'transport' => 'postMessage'
		)
	);
	
	
	//customizer control for sidebar
	// Add sidebar layout controls
	$wp_customize->add_control(	'layout_control',
		array(
			'settings' => 'layout_setting',
			'type' => 'radio',
			'label' => __( 'Sidebar position', 'starterscores' ),
			'choices' => array(
				'no-sidebar' => __( 'No sidebar (default)', 'starterscores' ),
				'sidebar-left' => __( 'Left sidebar', 'starterscores' ),
				'sidebar-right' => __( 'Right sidebar', 'starterscores' )
			),
			'section' => 'starterscores-options',
		)
	);
	
}
add_action( 'customize_register', 'starterscores_customize_register' );

/**
 * Binds JS handlers to make Theme Customizer preview reload changes asynchronously.
 */
function starterscores_customize_preview_js() {
	wp_enqueue_script( 'starterscores_customizer', get_template_directory_uri() . '/js/customizer.js', array( 'customize-preview' ), '20151215', true );
}
add_action( 'customize_preview_init', 'starterscores_customize_preview_js' );


/**
* sanitize layout options
*/
function starterscores_sanitize_layout ($value){
	if (!in_array( $value, array('sidebar-left', 'sidebar-right', 'no-sidebar'))){
		$value = 'no-sidebar';
	}
	return $value;
}


/**
* injects color from header customizer 
*/
function starterscores_customizer_css(){
	$header_color = get_theme_mod('header_color');
	?>
	<style type="text/css">
		.site-header{
			background-color: <?php echo $header_color; ?>
		}
	</style>
	<?php 
}

add_action('wp_head', 'starterscores_customizer_css');