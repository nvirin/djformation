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
define('DB_NAME', 'djformation');

/** MySQL database username */
define('DB_USER', 'djformation');

/** MySQL database password */
define('DB_PASSWORD', 'SyrdRWEboCLJC0tw');

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
define('AUTH_KEY',         'M{vIAFg+3Tgdtfe]7rzS4ui)|8wN;I5Mr7su}gs(ua (3yS]A*+sP.39at}(Of+X');
define('SECURE_AUTH_KEY',  '_I?f8hCMYc)#fx9;; Sb.1N4y<3t-g:3Q/NgJ-EdW,SGo5J`7|epmWqK$Y~^!fYr');
define('LOGGED_IN_KEY',    'P=v!<B,Ik9iie^`M_xOo?L,lzA&jpuM3+gvbJ-BLw8!90wc~|8cU.D*,(xg>}!w%');
define('NONCE_KEY',        ')a{k:h6`~S}<d8!|w?HfO#E~5cJW@<wdQG+bjS.[WunGPSsB;d2]:?=N7C?M6bb=');
define('AUTH_SALT',        ')s;(!z^8d]ou5:i40+4T)Fs*.k3Mvo}rWf%6$)j~--]:zlehrTI1KgQ3SxF 2f);');
define('SECURE_AUTH_SALT', 'TKad]|Ab&nUK>*]@(<)lt_WiN>JiozUiSn&OP$8h3~b#i{^}][f6ln%P1bb_b5/n');
define('LOGGED_IN_SALT',   'IWa%;BK}]|n;@6!LqU(6`O]wdQGg%8o$[vI%[.Ajn*P_<h(rf}:R*?4}iW,9]==o');
define('NONCE_SALT',       'lciEB|=yrtIO5KuPw(ja(jSL8so ~X[ =DxsC9)X;~+kF*tNNjc(DivXYaQjt:sJ');

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
define('WP_DEBUG', false);

/* That's all, stop editing! Happy blogging. */

/** Absolute path to the WordPress directory. */
if ( !defined('ABSPATH') )
	define('ABSPATH', dirname(__FILE__) . '/');

/** Sets up WordPress vars and included files. */
require_once(ABSPATH . 'wp-settings.php');
