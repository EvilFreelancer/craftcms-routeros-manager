# CraftCMS Mikrotik RouterOS manager

![Screenshot](resources/img/plugin-logo.png)

A CraftCMS plugin for Mikrotik RouterOS devices management.

## Requirements

* PHP >= 7.2
* CraftCMS >= 3.4

## Installation

To install the plugin, follow these instructions.

1. Open your terminal and go to your Craft project:

        cd /path/to/project

2. Then tell Composer to load the plugin:

        composer require evilfreelancer/craftcms-routeros-manager

3. In the Control Panel, go to Settings → Plugins and click the “Install” button for CraftCMS RouterOS manager.

## Roadmap

### 1.0

- [ ] Basic functionality
  - Table migration
    - id
    - remote config (should be obtained after adding new device)
    - traffic statistics from interfaces (no history, only current state)
  - Soft deletes
- [ ] Page in admin panel
  - Create new device
    - IP-address
    - Username/Password (hidden)
    - Test connection
  - Update device information
  - Dump of config
  - Upload config then apply
- [ ] Events
  - Device added
  - Device updated
  - Device removed
  - Device rebooted
- [ ] Actions
  - Remove device
  - Reboot device
- [ ] Tests
  - Unit (and probably integration) tests via the Codeception
  - Code quality (SonarCloud, Scrutinizer CI)
- [ ] Release in the Plugins Store

### 1.1  

- [ ] Background tasks
  - Check status of devices
    - A configurable timeout between tasks
  - Get traffic from ports
  - Dump/upload configuration

### 1.2

- [ ] Commands execution shell with response
  - Will need to create a parser from command to API call

### 1.3  

- [ ] Widgets
  - List of device with links to editor
  - Status of devices UP/DOWN
  - Execute command on a selected device

## Links
* https://github.com/EvilFreelancer/routeros-api-php - core library 
* https://pluginfactory.io/ - build craft cms plugins
