<?php

namespace Drupal\ckeditor_media_embed\Command\Drush;

use Drush\Commands\DrushCommands;

/**
 * CKEditor Media Embed Drush command file.
 */
class CKEditorMediaEmbedCommands extends DrushCommands {

  /**
   * The CKEditor plugin installation command.
   *
   * @var \Drupal\ckeditor_media_embed\Command\Drush\InstallCommand
   */
  protected $installCommand;

  /**
   * The CKEditor plugin update command.
   *
   * @var \Drupal\ckeditor_media_embed\Command\Drush\UpdateCommand
   */
  protected $updateCommand;

  /**
   * Constructs CKEditor Media Embed Drush Command object.
   *
   * @param \Drupal\ckeditor_media_embed\Command\Drush\InstallCommand $installCommand
   *   The CKEditor plugin installation command.
   * @param \Drupal\ckeditor_media_embed\Command\Drush\UpdateCommand $updateCommand
   *   The CKEditor plugin update command.
   */
  public function __construct(InstallCommand $installCommand, UpdateCommand $updateCommand) {
    parent::__construct();

    $this->installCommand = $installCommand;
    $this->updateCommand = $updateCommand;
  }

  /**
   * Install library dependencies for the CKEditor Media Embed plugin.
   *
   * @command ckeditor_media_embed:install
   */
  public function install() {
    $this->installCommand->execute($this->input(), $this->output(), $this->io());
  }

  /**
   * Update library dependencies for the CKEditor Media Embed plugin.
   *
   * @command ckeditor_media_embed:update
   */
  public function update() {
    $this->updateCommand->execute($this->input(), $this->output(), $this->io());
  }

}
