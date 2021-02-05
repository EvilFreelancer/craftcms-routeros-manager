<?php
/**
 * CraftCMS RouterOS manager plugin for Craft CMS 3.x
 *
 * A CraftCMS plugin for Mikrotik RouterOS devices management.
 *
 * @link      https://github.com/EvilFreelancer
 * @copyright Copyright (c) 2021 Paul Rock
 */

namespace RouterOS\Manager\variables;

use RouterOS\Manager\Plugin;

use Craft;

/**
 * CraftCMS RouterOS manager Variable
 *
 * Craft allows plugins to provide their own template variables, accessible from
 * the {{ craft }} global variable (e.g. {{ craft.craftcmsRouterosManager }}).
 *
 * https://craftcms.com/docs/plugins/variables
 *
 * @author    Paul Rock
 * @package   \RouterOS\Manager
 * @since     0.1
 */
class CraftcmsRouterosManagerVariable
{
    // Public Methods
    // =========================================================================

    /**
     * Whatever you want to output to a Twig template can go into a Variable method.
     * You can have as many variable functions as you want.  From any Twig template,
     * call it like this:
     *
     *     {{ craft.\RouterOS\Manager.exampleVariable }}
     *
     * Or, if your variable requires parameters from Twig:
     *
     *     {{ craft.\RouterOS\Manager.exampleVariable(twigValue) }}
     *
     * @param null $optional
     * @return string
     */
    public function exampleVariable($optional = null)
    {
        $result = "And away we go to the Twig template...";
        if ($optional) {
            $result = "I'm feeling optional today...";
        }
        return $result;
    }
}
