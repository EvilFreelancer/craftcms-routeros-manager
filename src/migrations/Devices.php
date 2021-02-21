<?php
/**
 * CraftCMS RouterOS manager plugin for Craft CMS 3.x
 *
 * A CraftCMS plugin for Mikrotik RouterOS devices management.
 *
 * @link      https://github.com/EvilFreelancer
 * @copyright Copyright (c) 2021 Paul Rock
 */

namespace RouterOS\Manager\migrations;

use Craft;
use craft\db\Migration;

/**
 * CraftCMS RouterOS manager Install Migration
 *
 * If your plugin needs to create any custom database tables when it gets installed,
 * create a migrations/ folder within your plugin folder, and save an Install.php file
 * within it using the following template:
 *
 * If you need to perform any additional actions on install/uninstall, override the
 * safeUp() and safeDown() methods.
 *
 * @author    Paul Rock
 * @package   \RouterOS\Manager
 * @since     0.1
 */
class Devices extends Migration
{
    // Public Properties
    // =========================================================================

    /**
     * @var string The database driver to use
     */
    public $driver;

    // Public Methods
    // =========================================================================

    /**
     * This method contains the logic to be executed when applying this migration.
     * This method differs from [[up()]] in that the DB logic implemented here will
     * be enclosed within a DB transaction.
     * Child classes may implement this method instead of [[up()]] if the DB logic
     * needs to be within a transaction.
     *
     * @return boolean return a false value to indicate the migration fails
     * and should not proceed further. All other return values mean the migration succeeds.
     */
    public function safeUp()
    {
        $this->driver = Craft::$app->getConfig()->getDb()->driver;
        if ($this->createTables()) {
            $this->createIndexes();
            // Refresh the db schema caches
            Craft::$app->db->schema->refresh();
        }

        return true;
    }

    /**
     * This method contains the logic to be executed when removing this migration.
     * This method differs from [[down()]] in that the DB logic implemented here will
     * be enclosed within a DB transaction.
     * Child classes may implement this method instead of [[down()]] if the DB logic
     * needs to be within a transaction.
     *
     * @return boolean return a false value to indicate the migration fails
     * and should not proceed further. All other return values mean the migration succeeds.
     */
    public function safeDown()
    {
        $this->driver = Craft::$app->getConfig()->getDb()->driver;
        $this->removeTables();

        return true;
    }

    // Protected Methods
    // =========================================================================

    /**
     * Creates the tables needed for the Records used by the plugin
     *
     * @return bool
     */
    protected function createTables()
    {
        $tablesCreated = false;

        // routeros_manager_devices table
        $tableSchema = Craft::$app->db->schema->getTableSchema('{{%routeros_manager_devices}}');
        if ($tableSchema === null) {
            $tablesCreated = true;
            $this->createTable(
                '{{%routeros_manager_devices}}',
                [
                    'id'                    => $this->primaryKey(),
                    'dateCreated'           => $this->dateTime()->notNull(),
                    'dateUpdated'           => $this->dateTime()->notNull(),
                    'uid'                   => $this->uid(),

                    // If device is enabled for monitoring or dumping
                    'is_enabled'            => $this->boolean()->defaultValue(true),

                    // Status of device, offline/online
                    'is_online'             => $this->boolean()->defaultValue(false),

                    /*
                     |--------------------------------------------------------------------------
                     | Connection details
                     |--------------------------------------------------------------------------
                     |
                     | Here you may specify different information about your router, like
                     | hostname (or ip-address), username, password, port and ssl mode.
                     |
                     | SSH port should be set if you want to use "/export" command.
                     |
                     */

                    // Address of Mikrotik RouterOS
                    'host'                  => $this->string(512)->notNull(),

                    // Username (if null, then will be used default username from settings)
                    'user'                  => $this->string(512)->null(),
                    // Password (if null, then will be used default password from settings)
                    'pass'                  => $this->string(512)->null(),

                    // RouterOS API port number for access (if not set use default or default with SSL if SSL enabled)
                    'port'                  => $this->integer()->null(),
                    // Number of SSH port (required for /export command)
                    'ssh_port'              => $this->integer()->null(),

                    // Dumped config of router
                    'config'                => $this->longText()->null(),

                    /*
                     |--------------------------------------------------------------------------
                     | SSL settings
                     |--------------------------------------------------------------------------
                     |
                     | Settings of SSL connection, if disabled then other parameters will
                     | be skipped.
                     |
                     | @link https://wiki.mikrotik.com/wiki/Manual:API-SSL
                     | @link https://www.openssl.org/docs/man1.1.1/man3/SSL_CTX_set_security_level.html
                     |
                     */

                    // Enable ssl support (if port is not set this parameter must change default port to ssl port)
                    'ssl'                   => $this->boolean()->defaultValue(false),
                    // ADH:ALL, ADH:ALL@SECLEVEL=0, ADH:ALL@SECLEVEL=1 ... ADH:ALL@SECLEVEL=5
                    'ssl_cipher'            => $this->string()->null(),
                    // Require verification of SSL certificate used.
                    'ssl_verify_peer'       => $this->boolean()->defaultValue(false),
                    // Require verification of peer name.
                    'ssl_verify_peer_name'  => $this->boolean()->defaultValue(false),
                    // Allow self-signed certificates. Requires verify_peer=true.
                    'ssl_allow_self_signed' => $this->boolean()->defaultValue(false),

                    /*
                     |--------------------------------------------------------------------------
                     | Optional connection settings of client
                     |--------------------------------------------------------------------------
                     |
                     | Settings bellow need to advanced tune of your connection, for example
                     | you may enable legacy mode by default, or change timeout of connection.
                     |
                     */

                    // Support of legacy login scheme (true - pre 6.43, false - post 6.43)
                    'legacy'                => $this->boolean()->defaultValue(false),
                    // Max timeout for answer from RouterOS
                    'timeout'               => $this->integer()->null(),
                    // Count of attempts to establish TCP session
                    'attempts'              => $this->integer()->null(),
                    // Delay between attempts in seconds
                    'delay'                 => $this->integer()->null(),
                ]
            );
        }

        return $tablesCreated;
    }

    /**
     * Creates the indexes needed for the Records used by the plugin
     *
     * @return void
     */
    protected function createIndexes()
    {
        // routeros_manager_devices table
        $this->createIndex(
            $this->db->getIndexName(
                '{{%routeros_manager_devices}}',
                'host',
                true
            ),
            '{{%routeros_manager_devices}}',
            'host',
            true
        );
    }

    /**
     * Removes the tables needed for the Records used by the plugin
     *
     * @return void
     */
    protected function removeTables()
    {
        // routeros_manager_devices table
        $this->dropTableIfExists('{{%routeros_manager_devices}}');
    }
}
