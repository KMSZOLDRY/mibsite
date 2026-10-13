<?php
/**
 * MIB — réglages de durcissement à inclure dans wp-config.php,
 * juste AVANT la ligne « That's all, stop editing! » :
 *
 *     require_once __DIR__ . '/wp-config-mib.php';
 *
 * Déployé à la racine WordPress par GitHub Actions (accès web bloqué par .htaccess).
 * Pas de garde ABSPATH ici : ce fichier est lu avant sa définition.
 */

// Aucun éditeur de fichiers dans l'admin : le code ne change que via GitHub.
defined( 'DISALLOW_FILE_EDIT' ) || define( 'DISALLOW_FILE_EDIT', true );

/*
 * DISALLOW_FILE_MODS reste à false volontairement : à true, il bloquerait aussi
 * les mises à jour automatiques de sécurité de WordPress et des extensions.
 * Le thème MIB, lui, n'est modifiable que par déploiement Git (Update URI: false).
 */
defined( 'DISALLOW_FILE_MODS' ) || define( 'DISALLOW_FILE_MODS', false );
defined( 'WP_AUTO_UPDATE_CORE' ) || define( 'WP_AUTO_UPDATE_CORE', true );         // Mises à jour du cœur automatiques.
defined( 'AUTOMATIC_UPDATER_DISABLED' ) || define( 'AUTOMATIC_UPDATER_DISABLED', false );

defined( 'FORCE_SSL_ADMIN' ) || define( 'FORCE_SSL_ADMIN', true );
defined( 'WP_POST_REVISIONS' ) || define( 'WP_POST_REVISIONS', 2 );
defined( 'AUTOSAVE_INTERVAL' ) || define( 'AUTOSAVE_INTERVAL', 300 );
defined( 'EMPTY_TRASH_DAYS' ) || define( 'EMPTY_TRASH_DAYS', 7 );
defined( 'WP_DEBUG' ) || define( 'WP_DEBUG', false );
defined( 'WP_DEBUG_DISPLAY' ) || define( 'WP_DEBUG_DISPLAY', false );
defined( 'WP_ENVIRONMENT_TYPE' ) || define( 'WP_ENVIRONMENT_TYPE', 'production' );
defined( 'WP_MEMORY_LIMIT' ) || define( 'WP_MEMORY_LIMIT', '128M' );

// Avec le cache statique, les visites ne réveillent plus WordPress : le cron est donc
// déclenché toutes les heures par GitHub Actions (.github/workflows/cron.yml).
defined( 'DISABLE_WP_CRON' ) || define( 'DISABLE_WP_CRON', true );
