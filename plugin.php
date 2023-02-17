<?php
/**
 * Plugin Name: Custom Post Type Locations
 * Plugin URI: https://ralfhortt.dev
 * Description: Manage locations
 * Version: 0.5
 * Author: Ralf Hortt
 * Author URI: https://ralfhortt.dev
 * Text Domain: custom-post-type-locations
 * Domain Path: /languages/
 * License: GPL2
 */
namespace RalfHortt\CustomPostTypeLocations;

use RalfHortt\Plugin\PluginFactory;
use RalfHortt\CustomPostTypeLocations\Locations;
use RalfHortt\MetaBoxAddress\MetaBoxAddress;

use RalfHortt\TranslatorService\Translator;

// ------------------------------------------------------------------------------
// Prevent direct file access
// ------------------------------------------------------------------------------
if (!defined('WPINC')) :
    die;
endif;

// ------------------------------------------------------------------------------
// Autoloader
// ------------------------------------------------------------------------------
$autoloader = dirname(__FILE__).'/vendor/autoload.php';

if (is_readable($autoloader)) :
    require_once $autoloader;
endif;

// ------------------------------------------------------------------------------
// Bootstrap
// ------------------------------------------------------------------------------
PluginFactory::create()
    ->addService(Translator::class, 'custom-post-type-locations', dirname(plugin_basename(__FILE__)).'/languages/')
    ->addService(Locations::class)
	->addService(MetaBoxAddress::class, ['location'], 'advanced', 'default')
    ->boot();
