Composer Manager allows contributed modules to depend on PHP libraries managed via Composer.

Installation
------------
- Install the Composer Manager module
- Initialize it using the init.sh script (or drush composer-manager-init).
  This registers the module's Composer command for Drupal core.

Workflow
--------
- Download the desired modules (such as Commerce).
- Inside your core/ directory run composer drupal-update.
  This rebuilds core/composer.json and downloads the new module's requirements.
- Install the modules.

If you're using Drush to download/install modules, then composer drupal-update
will be run automatically for you after drush dl completes.

Documentation: https://www.drupal.org/node/2405789
