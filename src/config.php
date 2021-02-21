<?php
/**
 * CraftCMS RouterOS manager plugin for Craft CMS 3.x
 *
 * A CraftCMS plugin for Mikrotik RouterOS devices management.
 *
 * @link      https://github.com/EvilFreelancer
 * @copyright Copyright (c) 2021 Paul Rock
 */

/**
 * CraftCMS RouterOS manager config.php
 *
 * This file exists only as a template for the CraftCMS RouterOS manager settings.
 * It does nothing on its own.
 *
 * Don't edit this file, instead copy it to 'craft/config' as 'routeros-manager.php'
 * and make your changes there to override default settings.
 *
 * Once copied to 'craft/config', this file will be multi-environment aware as
 * well, so you can have different settings groups for each environment, just as
 * you do for 'general.php'
 */

return [
    'default_user'     => 'admin',
    'default_pass'     => null,
    'default_port'     => 8728,
    'default_ssh_port' => 22,

    'default_ssl'                   => false,
    'default_ssl_cipher'            => 'ADH:ALL',
    'default_ssl_verify_peer'       => false,
    'default_ssl_verify_peer_name'  => false,
    'default_ssl_allow_self_signed' => false,

    'default_legacy'   => false,
    'default_timeout'  => 10,
    'default_attempts' => 10,
    'default_delay'    => 1,
];
