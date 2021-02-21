<?php
/**
 * CraftCMS RouterOS manager plugin for Craft CMS 3.x
 *
 * A CraftCMS plugin for Mikrotik RouterOS devices management.
 *
 * @link      https://github.com/EvilFreelancer
 * @copyright Copyright (c) 2021 Paul Rock
 */

namespace RouterOS\Manager\models;

use RouterOS\Manager\Plugin;

use Craft;
use craft\base\Model;

/**
 * \RouterOS\Manager Settings Model
 *
 * This is a model used to define the plugin's settings.
 *
 * Models are containers for data. Just about every time information is passed
 * between services, controllers, and templates in Craft, it’s passed via a model.
 *
 * https://craftcms.com/docs/plugins/models
 *
 * @author    Paul Rock
 * @package   \RouterOS\Manager
 * @since     0.1
 */
class Settings extends Model
{
    // Public Properties
    // =========================================================================

    /**
     * Default username
     *
     * @var string
     */
    public $default_user = 'admin';

    /**
     * Default password
     *
     * @var string
     */
    public $default_pass;

    /**
     * Default API port
     *
     * @var integer
     */
    public $default_port = 8728;

    /**
     * Default SSH port
     *
     * @var integer
     */
    public $default_ssh_port = 22;

    /**
     * @var bool
     */
    public $default_ssl = false;

    /**
     * @var string
     */
    public $default_ssl_cipher = 'ADH:ALL';

    /**
     * @var bool
     */
    public $default_ssl_verify_peer = false;

    /**
     * @var bool
     */
    public $default_ssl_verify_peer_name = false;

    /**
     * @var bool
     */
    public $default_ssl_allow_self_signed = false;

    // Public Methods
    // =========================================================================

    /**
     * Returns the validation rules for attributes.
     *
     * Validation rules are used by [[validate()]] to check if attribute values are valid.
     * Child classes may override this method to declare different validation rules.
     *
     * More info: http://www.yiiframework.com/doc-2.0/guide-input-validation.html
     *
     * @return array
     */
    public function rules()
    {
        return [
            ['default_user', 'string'],
            ['default_user', 'default', 'value' => 'admin'],
            ['default_pass', 'string'],
            ['default_port', 'integer'],
            ['default_port', 'default', 'value' => 8728],
            ['default_ssh_port', 'integer'],
            ['default_ssh_port', 'default', 'value' => 22],

            ['default_ssl', 'boolean'],
            ['default_ssl', 'default', 'value' => false],
            ['default_ssl_cipher', 'string'],
            ['default_ssl_cipher', 'default', 'value' => 'ADH:ALL'],
            ['default_ssl_verify_peer', 'boolean'],
            ['default_ssl_verify_peer', 'default', 'value' => false],
            ['default_ssl_verify_peer_name', 'boolean'],
            ['default_ssl_verify_peer_name', 'default', 'value' => false],
            ['default_ssl_allow_self_signed', 'boolean'],
            ['default_ssl_allow_self_signed', 'default', 'value' => false],

            ['default_legacy', 'boolean'],
            ['default_legacy', 'default', 'value' => false],
            ['default_timeout', 'integer'],
            ['default_timeout', 'default', 'value' => 10],
            ['default_attempts', 'integer'],
            ['default_attempts', 'default', 'value' => 10],
            ['default_delay', 'integer'],
            ['default_delay', 'default', 'value' => 1],
        ];
    }
}
