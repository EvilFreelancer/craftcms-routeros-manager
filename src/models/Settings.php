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
     * Some field model attribute
     *
     * @var string
     */
    public $someAttribute = 'Some Default';

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
            ['someAttribute', 'string'],
            ['someAttribute', 'default', 'value' => 'Some Default'],
        ];
    }
}
