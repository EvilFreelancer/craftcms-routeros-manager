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
class Statistics extends Migration
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
            $this->addForeignKeys();
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
        $tableSchema = Craft::$app->db->schema->getTableSchema('{{%routeros_manager_statistics}}');
        if ($tableSchema === null) {
            $tablesCreated = true;
            $this->createTable(
                '{{%routeros_manager_statistics}}',
                [
                    'id'          => $this->primaryKey(),
                    'dateCreated' => $this->dateTime()->notNull(),
                    'dateUpdated' => $this->dateTime()->notNull(),
                    'uid'         => $this->uid(),

                    // For relations to devices table
                    'device_id'   => $this->integer()->notNull(),

                    // Name of interface
                    'interface'   => $this->string(512)->null(),
                    // Amount of uploaded traffic (in bytes)
                    'upload'      => $this->bigInteger()->null(),
                    // Amount of downloaded traffic (in bytes)
                    'download'    => $this->bigInteger()->null(),

                    // Small comment about interface
                    'comment'     => $this->string(512)->null(),
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
        // routeros_manager_statistics table
        $this->createIndex(
            $this->db->getIndexName(
                '{{%routeros_manager_statistics}}',
                'device_id',
                true
            ),
            '{{%routeros_manager_statistics}}',
            'device_id',
            true
        );
    }

    /**
     * Creates the foreign keys needed for the Records used by the plugin
     *
     * @return void
     */
    protected function addForeignKeys()
    {
        // craftcmsrouterosmanager_devicerecord table
        $this->addForeignKey(
            $this->db->getForeignKeyName('{{%routeros_manager_statistics}}', 'device_id'),
            '{{%routeros_manager_statistics}}',
            'device_id',
            '{{%routeros_manager_devices}}',
            'id',
            'CASCADE',
            'CASCADE'
        );
    }

    /**
     * Removes the tables needed for the Records used by the plugin
     *
     * @return void
     */
    protected function removeTables()
    {
        // routeros_manager_statistics table
        $this->dropTableIfExists('{{%routeros_manager_statistics}}');
    }
}
