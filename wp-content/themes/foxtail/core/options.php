<?php
/**
 * Created by PhpStorm.
 * User: nhansay
 * Date: 12/06/2015
 * Time: 16:53
 */

if ( ! class_exists( 'Foxtail_theme_options' ) ) {

    class Foxtail_theme_options {

        public $args = array();
        public $sections = array();
        public $theme;
        public $ReduxFramework;

        /* Load Redux Framework */
        public function __construct() {

            if ( ! class_exists( 'ReduxFramework' ) ) {
                return;
            }

            if ( true == Redux_Helpers::isTheme( __FILE__ ) ) {
                $this->initSettings();
            } else {
                add_action( 'plugins_loaded', array( $this, 'initSettings' ), 10 );
            }

        }

        public function initSettings() {

            // Set the default arguments
            $this->setArguments();

            // Set a few help tabs so you can see how it's done
            $this->setHelpTabs();

            // Create the sections and fields
            $this->setSections();

            if ( ! isset( $this->args['opt_name'] ) ) { // No errors please
                return;
            }

            $this->ReduxFramework = new ReduxFramework( $this->sections, $this->args );
        }

        /**
        Thiết lập cho method setAgruments
        Method này sẽ chứa các thiết lập cơ bản cho trang Options Framework như tên menu chẳng hạn
         **/
        public function setArguments() {
            $theme = wp_get_theme(); // Lưu các đối tượng trả về bởi hàm wp_get_theme() vào biến $theme để làm một số việc tùy thích.
            $this->args = array(
                // Các thiết lập cho trang Options
                'opt_name'  => 'foxtail_options', // Tên biến trả dữ liệu của từng options, ví dụ: tp_options['field_1']
                'display_name' => $theme->get('Name').' Theme Options', // Thiết lập tên theme hiển thị trong Theme Options
                'menu_type'          => 'menu',
                'allow_sub_menu'     => true,
                'menu_title'         => 'Theme options',
                'page_title'         => 'Theme options',
                'dev_mode' => false,
                'customizer' => true,
                'menu_icon' => '', // Đường dẫn icon của menu option
                // Chức năng Hint tạo dấu chấm hỏi ở mỗi option để hướng dẫn người dùng */
                'hints'              => array(
                    'icon'          => 'icon-question-sign',
                    'icon_position' => 'right',
                    'icon_color'    => 'lightgray',
                    'icon_size'     => 'normal',
                    'tip_style'     => array(
                        'color'   => 'light',
                        'shadow'  => true,
                        'rounded' => false,
                        'style'   => '',
                    ),
                    'tip_position'  => array(
                        'my' => 'top left',
                        'at' => 'bottom right',
                    ),
                    'tip_effect'    => array(
                        'show' => array(
                            'effect'   => 'slide',
                            'duration' => '500',
                            'event'    => 'mouseover',
                        ),
                        'hide' => array(
                            'effect'   => 'slide',
                            'duration' => '500',
                            'event'    => 'click mouseleave',
                        ),
                    ),
                ) // end Hints
            );
        } // end setArguments function

        /**
        Thiết lập khu vực Help để hướng dẫn người dùng
         **/
        public function setHelpTabs() {

            // Custom page help tabs, displayed using the help API. Tabs are shown in order of definition.
            $this->args['help_tabs'][] = array(
                'id'      => 'redux-help-tab-1',
                'title'   => 'Documentation',
                'content' => '<p>I will write the documentation soon!</p>'
            );

            $this->args['help_tabs'][] = array(
                'id'      => 'redux-help-tab-2',
                'title'   => 'Google Fonts',
                'content' => '<p>To use Google fonts please set up by your code. Thanks so much!</p>'
            );

            // Set the help sidebar
            $this->args['help_sidebar'] = '<p>It is so easy to custom your theme with theme options!</p>';
        } // end setHelpTabs function

        /**
        Thiết lập từng phần trong khu vực Theme Options
        mỗi section được xem như là một phân vùng các tùy chọn
        Trong mỗi section có thể sẽ chứa nhiều field
         **/
        public function setSections()
		{
			$this->sections[] = array(
				'title'  => 'General',
				'desc'   => 'General Option',
				'icon'   => 'el-icon-check',
				'fields' => array(
					array(
						'id'       => 'header-code',
						'type'     => 'textarea',
						'title'    => 'Header Code',
						'desc'     => 'Additional Header Code Here'
					),
					array(
						'id'       => 'footer-code',
						'type'     => 'textarea',
						'title'    => 'Footer Code',
						'desc'     => 'Additional Footer Code Here'
					),
					array(
						'id'       => 'favicon',
						'type'     => 'media',
						'title'    => 'Favicon',
						'desc'     => 'Favicon',
						'readonly' => false,
						'url'      => true,
						'default'  => array(
							'url' => get_template_directory_uri().'/img/favicon.ico'
						)
					),
					array(
						'id'       => 'custom-css',
						'type'     => 'textarea',
						'title'    => 'Custom CSS',
						'desc'     => 'Custom CSS here'
					),
				)
			); // end section

            // Section
            $this->sections[] = array(
                'title'  => 'Header',
                'desc'   => 'Header',
                'icon'   => 'el-icon-flag',
                'fields' => array(
					array(
						'id'       => 'header-background',
						'type'     => 'media',
						'title'    => 'Header Background Image',
						'desc'     => 'Header Background Image',
						'readonly' => false,
						'url'      => true,
						'default'  => array(
							'url' => get_template_directory_uri().'/img/header-bg.jpg'
						)
					),
                    array(
                        'id'       => 'header-logo',
                        'type'     => 'media',
                        'title'    => 'Header Logo',
                        'desc'     => 'Header Logo',
                        'readonly' => false,
                        'url'      => true,
                        'default'  => array(
                            'url' => get_template_directory_uri().'/img/logo.png'
                        )
                    ),
					array(
						'id'       => 'hotline',
						'type'     => 'text',
						'title'    => 'Hotline',
						'desc'     => 'Hotline'
					)
                )
            ); // end section

            // Section
            $this->sections[] = array(
                'title'  => 'Main',
                'desc'   => 'Main',
                'icon'   => 'el-icon-website',
                'fields' => array(
					array(
						'id'       => 'show-aside-banner',
						'type'     => 'checkbox',
						'title'    => 'Show Aside Banner',
						'desc'     => 'Tick to show aside banner'
					),
					array(
						'id'       => 'aside-banner-margin-top',
						'type'     => 'text',
						'title'    => 'Aside banner margin top',
						'desc'     => 'Aside banner margin top (px)'
					),
					array(
						'id'       => 'left-banner',
						'type'     => 'media',
						'title'    => 'Left Banner Image',
						'desc'     => 'Left Banner Image',
						'readonly' => false,
						'url'      => true
					),
					array(
						'id'       => 'left-banner-link',
						'type'     => 'text',
						'title'    => 'Left Banner Link',
						'desc'     => 'Left Banner Link'
					),
					array(
						'id'       => 'right-banner',
						'type'     => 'media',
						'title'    => 'Right Banner Image',
						'desc'     => 'Right Banner Image',
						'readonly' => false,
						'url'      => true
					),

					array(
						'id'       => 'right-banner-link',
						'type'     => 'text',
						'title'    => 'Right Banner Link',
						'desc'     => 'Right Banner Link'
					),
                )
            ); // end section

        }

    } // end My_theme_option class

    global $reduxConfig;
    $reduxConfig = new Foxtail_theme_options();

}