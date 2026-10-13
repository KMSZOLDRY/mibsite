<?php
/**
 * MIB — functions.php
 *
 * Thème sur mesure « CMS Green » : aucun constructeur de page,
 * aucune dépendance front tierce, configuration statique servie par OPcache.
 */

defined( 'ABSPATH' ) || exit;

define( 'MIB_DIR', __DIR__ );
define( 'MIB_URI', get_template_directory_uri() );

require MIB_DIR . '/inc/helpers.php';
require MIB_DIR . '/inc/setup.php';
require MIB_DIR . '/inc/security.php';
require MIB_DIR . '/inc/content.php';
require MIB_DIR . '/inc/schema.php';
require MIB_DIR . '/inc/cache.php';
