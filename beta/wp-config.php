<?php
/**
 * The base configurations of the WordPress.
 *
 * This file has the following configurations: MySQL settings, Table Prefix,
 * Secret Keys, WordPress Language, and ABSPATH. You can find more information
 * by visiting {@link http://codex.wordpress.org/Editing_wp-config.php Editing
 * wp-config.php} Codex page. You can get the MySQL settings from your web host.
 *
 * This file is used by the wp-config.php creation script during the
 * installation. You don't have to use the web site, you can just copy this file
 * to "wp-config.php" and fill in the values.
 *
 * @package WordPress
 */

// ** MySQL settings - You can get this info from your web host ** //
/** The name of the database for WordPress */
define('DB_NAME', 'db159842_revelryhouse');

/** MySQL database username */
define('DB_USER', 'db159842');

/** MySQL database password */
define('DB_PASSWORD', 'Revelrydb!@#');

/** MySQL hostname */
define('DB_HOST', 'internal-db.s159842.gridserver.com');

/** Database Charset to use in creating database tables. */
define('DB_CHARSET', 'utf8');

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

define('AUTH_KEY',         '1m-Yahl9[GR,:I&7]6qMJa];H;$M$m7DtqOQ{9M-~kuc[o6udcK%OQ-Xu>fp:d.L');
define('SECURE_AUTH_KEY',  'T((nJ_2pf#mI$-cFBi2zf{v>caEQvTI|CY`!y6y@(i$R{&vl|!OHpU,w>|dYIRuI');
define('LOGGED_IN_KEY',    ';vCQr(wK&(E=h[k1Ht3:pB6PY: s+s)|oE.FEy,-aL+p$`i]<&?$wH/%Z8GN |)<');
define('NONCE_KEY',        ')Q#v#Koz-!~Wo&ZY7`gG|F#;2G}#|vYEu(e+_D#1>VHD9+!fs~MP8:d[b}KplUm9');
define('AUTH_SALT',        '|]-D+4NXh4]UdQKU=9:-~O8;h|MPHWZ*|B{0(!K6XbCON9><-~}nulKhAqlLF;! ');
define('SECURE_AUTH_SALT', '9y~`3Nc#76eb ejN&>mT82n1Fnv]A+%)@{m$uhou+`q 4+J7@d=RS/Tv;!]n1p=+');
define('LOGGED_IN_SALT',   '`m+L6v}S:Z$rdo@@th!7R+),[kkwYQKJ:N1(!YwS&t^QQPOL,j!4W*)faZ3VZp_s');
define('NONCE_SALT',       'fsVAaI KDYU`zv)0% N&oy{+>k|(0;}LY1[RWdMy;Uq1`UI-ag-`h+~naG8n-1B0');

/**#@-*/

/**
 * WordPress Database Table prefix.
 *
 * You can have multiple installations in one database if you give each a unique
 * prefix. Only numbers, letters, and underscores please!
 */
$table_prefix  = 'wp_';

/**
 * WordPress Localized Language, defaults to English.
 *
 * Change this to localize WordPress. A corresponding MO file for the chosen
 * language must be installed to wp-content/languages. For example, install
 * de_DE.mo to wp-content/languages and set WPLANG to 'de_DE' to enable German
 * language support.
 */
define('WPLANG', '');

/**
 * For developers: WordPress debugging mode.
 *
 * Change this to true to enable the display of notices during development.
 * It is strongly recommended that plugin and theme developers use WP_DEBUG
 * in their development environments.
 */
define('WP_DEBUG', false);

/* That's all, stop editing! Happy blogging. */

/** Absolute path to the WordPress directory. */
if ( !defined('ABSPATH') )
	define('ABSPATH', dirname(__FILE__) . '/');

/** Sets up WordPress vars and included files. */
require_once(ABSPATH . 'wp-settings.php');
