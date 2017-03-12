<?php
// $mang_sim_tax = get_terms( array(
//     'taxonomy' => 'mang_sim',
//     'hide_empty' => 0,
//     'fields' => 'ids',
//     ) );  // Array of tax ids.
// $loai_sim_tax = get_terms( array(
//     'taxonomy' => 'loai_sim',
//     'hide_empty' => 0,
//     'fields' => 'ids',
//     ) );
// $nam_sinh_sim_tax = get_terms( array(
//     'taxonomy' => 'nam_sinh_sim',
//     'hide_empty' => 0,
//     'fields' => 'ids',
//     ) );


// for ($i=0; $i < 39; $i++) {
//     $sim_so = '0'.random_int (900000000,1699999999);
//     $page = get_page_by_title($sim_so, OBJECT, 'simso');

//     if (isset($page) && get_post_meta( $page->ID, 'sim_so', true ) == $sim_so) {
//         break;
//     }

//     $post_arr = array(
//         'post_title'   => $sim_so,
//         'post_type'   => 'simso',
//         'post_status'  => 'publish',
//         'post_author'  => get_current_user_id(),
//         'tax_input'    => array(
//             'mang_sim'     => array($mang_sim_tax[random_int (0, count($mang_sim_tax)-1)]),
//             'loai_sim'     => array($loai_sim_tax[random_int (0, count($loai_sim_tax)-1)]),
//             'nam_sinh_sim'     => array($nam_sinh_sim_tax[random_int (0, count($nam_sinh_sim_tax)-1)]),
//             ),
//         'meta_input'   => array(
//             'sim_so' => $sim_so,
//             'gia_ban' => random_int(0, 200000000),
//             ),
//         );
//     wp_insert_post( $post_arr );
// }

?>

<?php
/**
 * The header for our theme.
 * Displays all of the <head> section and everything up till <div id="content">
 */

global $foxtail_options;

?>
<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo('charset'); ?>">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="profile" href="http://gmpg.org/xfn/11">
	<link rel="pingback" href="<?php bloginfo('pingback_url'); ?>">

	<link rel="shortcut icon" href="<?php echo $foxtail_options['favicon']['url'] ?>" type="image/x-icon">

	<link href="https://fonts.googleapis.com/css?family=Roboto+Slab:400,700&subset=vietnamese" rel="stylesheet">
	<link href='https://fonts.googleapis.com/css?family=Roboto:400,300,300italic,400italic,500,500italic,700,700italic&subset=latin,vietnamese' rel='stylesheet' type='text/css'>

	<!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
	<!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
	<!--[if lt IE 9]>
	<script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
	<script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
	<![endif]-->

	<?php wp_head(); ?>

	<style>
		<?php echo $foxtail_options['custom-css'] ?>
	</style>

</head>

<body <?php body_class(); ?>>

    <header id="header">
       <div class="container">
          <div id="header-wrap" class="clearfix" style="background: url(<?php echo $foxtail_options['header-background']['url'] ?>)">
             <div class="header-logo pull-left">

                <?php foxtail_logo() ?>

            </div>
        </div>
    </div>
</header>

<div id="main-nav-wrap">
	<div class="container">

		<?php wp_nav_menu( array(
			'menu_class' => 'nav-menu list-inline',
			'menu_id' => 'main-nav-menu',
			'container' => 'nav',
			'container_class' => 'nav',
			'theme_location' => 'main-nav'
          ) ); ?>

      </div>
  </div>

  <div id="main-nav-mobile-wrap">
   <div id="nav-mobile-toggle"><i class="fa fa-bars"></i></div>

   <?php wp_nav_menu( array(
      'menu_class' => 'nav-menu-mobile list-unstyled',
      'menu_id' => 'main-nav-menu-mobile',
      'container' => 'nav',
      'container_class' => 'nav-mobile',
      'container_id' => 'nav-mobile',
      'theme_location' => 'main-nav'
      ) ); ?>

  </div>