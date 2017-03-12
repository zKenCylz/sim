<?php
/**
 * The base configuration for WordPress
 *
 * The wp-config.php creation script uses this file during the
 * installation. You don't have to use the web site, you can
 * copy this file to "wp-config.php" and fill in the values.
 *
 * This file contains the following configurations:
 *
 * * MySQL settings
 * * Secret keys
 * * Database table prefix
 * * ABSPATH
 *
 * @link https://codex.wordpress.org/Editing_wp-config.php
 *
 * @package WordPress
 */

// ** MySQL settings - You can get this info from your web host ** //
/** The name of the database for WordPress */
define('DB_NAME', 'sim');

/** MySQL database username */
define('DB_USER', 'root');

/** MySQL database password */
define('DB_PASSWORD', '');

/** MySQL hostname */
define('DB_HOST', 'localhost');

/** Database Charset to use in creating database tables. */
define('DB_CHARSET', 'utf8mb4');

/** The Database Collate type. Don't change this if in doubt. */
define('DB_COLLATE', '');

/**#@+
 * Authentication Unique Keys and Salts.
 *
 * Change these to different unique phrases!
 * You can generate these using the {@link https://api.wordpress.org/secret-key/1.1/salt/ WordPress.org secret-key service}
 * You can change these at any point in time to invalidate all existing cookies. This will force all users to have to log in again.
 *
 * @since 2.6.0
 */
define('AUTH_KEY',         'vO]]=v~J@;_I#lJ5?V+K=X$i9,l*.eRXg8<2N-6!$6o4m}Aj7D1ML-^-UV{/#$Mb');
define('SECURE_AUTH_KEY',  'NIij4G^1{)wR.*=ig/qh;_9hBq!U:=5O;3ZQh[ONA ~7tl2H8_0huxO  ra/g4%Z');
define('LOGGED_IN_KEY',    'qh*!/As53p+FP&FyD2g22B>IjrT_@bCW2T8HfcX;,ro(kU|jVuKMJ7>M{/:kHrnh');
define('NONCE_KEY',        '@8nr`l:,t=fjU&<$4<Dnxw:NRlo179#}7on/)O%~|`t;/$_WN</VDeM-/BU>L_&P');
define('AUTH_SALT',        'S@H/0/IB:)[`q;EmznBr(9Lp# b@nqx1J/A7g&J0$P$^FCq`or*sZF/zS$IeUO8)');
define('SECURE_AUTH_SALT', 'm-THJL&|dUobGfQ70Ah+8VZfl=N#lcpcR]=vG>&=gKVRp_Xbk$.`$vsrHWE.H[.;');
define('LOGGED_IN_SALT',   '/OSF<Q_,hk{>Q0nkN)7|!uRdi;[jNn%$5^{0FJHo~uD0GNZ^aiyjjRn -Xb]C)y5');
define('NONCE_SALT',       '#w2<e5yC{}w4FaUd}{9/T=2z#mmp7nOau!YH[w7Qm8A%pt](J`/cbJ#J@DzFB<a3');

/**#@-*/

/**
 * WordPress Database Table prefix.
 *
 * You can have multiple installations in one database if you give each
 * a unique prefix. Only numbers, letters, and underscores please!
 */
$table_prefix  = 'wp_';

/**
 * For developers: WordPress debugging mode.
 *
 * Change this to true to enable the display of notices during development.
 * It is strongly recommended that plugin and theme developers use WP_DEBUG
 * in their development environments.
 *
 * For information on other constants that can be used for debugging,
 * visit the Codex.
 *
 * @link https://codex.wordpress.org/Debugging_in_WordPress
 */
define('WP_DEBUG', true);

/* That's all, stop editing! Happy blogging. */

/** Absolute path to the WordPress directory. */
if ( !defined('ABSPATH') )
	define('ABSPATH', dirname(__FILE__) . '/');

/** Sets up WordPress vars and included files. */
require_once(ABSPATH . 'wp-settings.php');
