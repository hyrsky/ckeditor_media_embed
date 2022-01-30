<?php

namespace Drupal\ckeditor_media_embed\Command\Drush;

use Drupal\ckeditor_media_embed\Command\CKEditorCliCommandInterface;
use Drupal\ckeditor_media_embed\Command\CliCommandWrapper;
use Drupal\Core\Extension\ModuleHandlerInterface;
use Drupal\Core\Serialization\Yaml;
use Drush\Style\DrushStyle;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

/**
 * The install command.
 */
class InstallCommand implements CKEditorCliCommandInterface {

  /**
   * The CKEditor Media Embed CLI Commands service.
   *
   * @var \Drupal\ckeditor_media_embed\Command\CliCommandWrapper
   */
  protected $cliCommands;

  /**
   * The messages displayed to the user at various steps of the installation.
   *
   * @var string[]
   */
  protected $messages;

  /**
   * The console input service.
   *
   * @var \Symfony\Component\Console\Input\InputInterface
   */
  protected $input;

  /**
   * The output service.
   *
   * @var \Symfony\Component\Console\Output\OutputInterface
   */
  protected $output;

  /**
   * The input/output service provided by Drush.
   *
   * @var \Drush\Style\DrushStyle
   */
  protected $io;

  /**
   * Constructs command object.
   *
   * @param \Drupal\ckeditor_media_embed\Command\CliCommandWrapper $cli_commands
   *   The CKEditor Media Embed CLI Commands service.
   * @param \Drupal\Core\Extension\ModuleHandlerInterface $module_handler
   *   The module handler service.
   */
  public function __construct(CliCommandWrapper $cli_commands, ModuleHandlerInterface $module_handler) {
    $this->cliCommands = $cli_commands;
    $this->setMessages($module_handler->getModule('ckeditor_media_embed')->getPath() . '/command/translations/en/ckeditor_media_embed.install.yml');
  }

  /**
   * Executes the command.
   *
   * @param \Symfony\Component\Console\Input\InputInterface $input
   *   An InputInterface instance.
   * @param \Symfony\Component\Console\Output\OutputInterface $output
   *   An OutputInterface instance.
   * @param \Drush\Style\DrushStyle $io
   *   The Drush i/o object.
   */
  public function execute(InputInterface $input, OutputInterface $output, DrushStyle $io) {
    $this->input = $input;
    $this->output = $output;
    $this->io = $io;

    $overwrite = $this->cliCommands->askToOverwritePluginFiles($this);

    if ($overwrite) {
      $this->cliCommands->overwritePluginFiles($this, $overwrite);
    }
  }

  /**
   * Set messages to display to the user at various steps of the installation.
   *
   * @param string $path_to_message_file
   *   The path to the messages file.
   *
   * @return $this
   */
  protected function setMessages($path_to_message_file) {
    $messages = Yaml::decode(file_get_contents($path_to_message_file))['messages'];

    $this->messages = array_map('dt', $messages);

    return $this;
  }

  /**
   * {@inheritdoc}
   */
  public function getInput() {
    return $this->input;
  }

  /**
   * {@inheritdoc}
   */
  public function getIo() {
    return $this->io;
  }

  /**
   * {@inheritdoc}
   */
  public function getMessage($message_key) {
    return $this->messages[$message_key];
  }

  /**
   * {@inheritdoc}
   */
  public function confirmation($question, $default = FALSE) {
    return $this->io->confirm($question, $default);
  }

  /**
   * {@inheritdoc}
   */
  public function comment($text) {
    $this->io->text(sprintf('<comment>%s</comment>', $text));
  }

}
