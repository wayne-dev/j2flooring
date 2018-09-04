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
define('DB_NAME', 'j2flooring.com');

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
define('AUTH_KEY',         'SnS[H()(n7s@Xdff-~_T,Pf`h;MLsfM+aG!Pac3&&#K]<[l0wIoY.%vf!T74;X1N');
define('SECURE_AUTH_KEY',  'p~e*5pS5]M}[~aLYPI(<DZcCZOM{5xl0&_DC%{JY12)KK1;{0shg?Rohbqj7`~4}');
define('LOGGED_IN_KEY',    'a!nIA-+)C~#+)z}>r`a_b_9=v.A$9<U+6qv&X|D]uD:QSv~>7<L]2Hfl~Db&ImKK');
define('NONCE_KEY',        ' 1<fcg}j>{$UVQwXlM<|tW9ekV&[z(ye <?4`id#1rg?Ij(pT-]5+AyIBP/g#E]Z');
define('AUTH_SALT',        'bv7zfG_UU![?A6wYMT%Op^y[|ML6;DKB%cJ4yCb#<)a(|-Y:.>dmuD!L/|+,gST0');
define('SECURE_AUTH_SALT', '`P77J@sGg/.)l+)V-ROMk[AfG{qP5N0DzPnq/QzhaAV%;0_^B>nd^P F|(M|`qUt');
define('LOGGED_IN_SALT',   '.vypK(l3BAM_N%]`W,ndC}i9;wo>&,hbD_U^:j2vn*r+2TZ!pZI)9bkKSMzpC*B?');
define('NONCE_SALT',       'JC{`2<.*<g`Y2LV8?(;}0Fj7Jjl&Gmjf+R /)d:S5GL0sn}DvvLLb{o1.]Zy`6%K');

/**#@-*/

/**
 * WordPress Database Table prefix.
 *
 * You can have multiple installations in one database if you give each
 * a unique prefix. Only numbers, letters, and underscores please!
 */
$table_prefix  = 'j2f_';

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
define('WP_DEBUG', false);

/* That's all, stop editing! Happy blogging. */

/** Absolute path to the WordPress directory. */
if ( !defined('ABSPATH') )
	define('ABSPATH', dirname(__FILE__) . '/');

/** Sets up WordPress vars and included files. */
require_once(ABSPATH . 'wp-settings.php');
