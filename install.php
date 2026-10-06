<?php

use Joomla\CMS\Application\AdministratorApplication;
use Joomla\CMS\Installer\InstallerAdapter;
use Joomla\CMS\Installer\InstallerScriptInterface;
use Joomla\CMS\Installer\InstallerScriptTrait;
use Joomla\DI\Container;
use Joomla\DI\ServiceProviderInterface;

defined('_JEXEC') or die;

return new class () implements ServiceProviderInterface {
  public function register(Container $container) {
    $container->set(
      InstallerScriptInterface::class,
      new class (
        $container->get(AdministratorApplication::class),
      ) implements InstallerScriptInterface {
        use InstallerScriptTrait {
          InstallerScriptTrait::preflight as iScriptTraitPre;
          InstallerScriptTrait::postflight as iScriptTraitPost;
        }

        private AdministratorApplication $app;

        private $previousVersion = '';

        public function __construct(AdministratorApplication $app) {
          $this->minimumPhp = '8.4';
          $this->minimumJoomla = '6.0.0';
          $this->app = $app;
        }

        public function preflight(string $type, InstallerAdapter $parent): bool {
          $this->iScriptTraitPre($type, $parent);

          $manifest = $this->getOldManifest($parent);
          if (!$manifest) return true;
          $this->previousVersion = $manifest->version;
          return true;
        }
        
        public function postflight(string $type, InstallerAdapter $parent): bool {
          $this->iScriptTraitPost($type, $parent);

          if (strtoupper($type) == "UPDATE") {
            $changelog = $this->buildChangelog();

            $this->app->enqueueMessage(
              '<h2 style="font-size: 1.25em; font-weight: 700">Updated Launchpad to version ' 
              . $parent->getManifest()->version 
              . '.</h2>'
              . $changelog, 'notice'
            );
          }
          return true;
        }
        
        private function buildChangelog(): string {
          $changelogFile = file_get_contents(dirname(__FILE__) . '/changelog.txt');

          $entries = explode("\n\n", $changelogFile);
          
          $changelog = [];
          $changelog[] = array_shift($entries);

          if ($this->previousVersion) {
            foreach ($entries as $entry) {
              preg_match('/v(\d+\.\d+\.\d+) \((\d{4}-\d{2}-\d{2})\)/', $entry, $matches);
              $entryVersion = $matches[1];
              if (!version_compare($entryVersion, $this->previousVersion, '>')) break;
              $changelog[] = $entry;
            }
          }

          $badges = [
            "\[Added\]" => '<span class="badge bg-success text-bg-success"><i class="fa fa-plus-circle"></i> Added</span>',
            "\[Changed\]" => '<span class="badge bg-info text-bg-info"><i class="fa fa-cogs"></i> Changed</span>',
            "\[Deprecated\]" => '<span class="badge bg-warning text-bg-warning"><i class="fa fa-clock"></i> Deprecated</span>',
            "\[Fixed\]" => '<span class="badge bg-info text-bg-info"><i class="fa fa-bug"></i> Fixed</span>',
            "\[Removed\]" => '<span class="badge bg-danger text-bg-danger"><i class="fa fa-trash"></i> Removed</span>',
            "\[Security\]" => '<span class="badge bg-danger text-bg-danger"><i class="fa fa-shield-alt"></i> Security</span>',
          ];

          $output = [];
          foreach ($changelog as $version) {
            $version = htmlspecialchars($version);
            foreach ($badges as $marker => $badge) {
              $version = preg_replace("/$marker/", $badge, $version);
            }
            $output[] = "<pre class=\"border bg-body p-2\" style=\"line-height: 1.75em;\">{$version}</pre>";
          }

          return implode('', $output);
        }
      }
    );
  }
};
