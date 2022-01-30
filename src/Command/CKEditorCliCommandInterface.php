<?php

namespace Drupal\ckeditor_media_embed\Command;

/**
 * Defines an interface for our CKEditor cli.
 */
interface CKEditorCliCommandInterface {

  /**
   * Retrieve the command input service.
   *
   * @return \Symfony\Component\Console\Input\InputInterface
   *   The input service.
   */
  public function getInput();

  /**
   * Retrieve the i/o style.
   *
   * @return \Symfony\Component\Console\Style\StyleInterface
   *   The i/o style.
   */
  public function getIo();

  /**
   * Retrieve message text.
   *
   * @param string $message_key
   *   The key of the requested message.
   *
   * @return string
   *   The requested message.
   */
  public function getMessage($message_key);

  /**
   * Present confirmation question to user.
   *
   * @param string $question
   *   The confirmation question.
   * @param bool $default
   *   The default value to return if user doesn’t enter any valid input.
   *
   * @return mixed
   *   The user answer
   */
  public function confirmation($question, $default = FALSE);

  /**
   * Output message in comment style.
   *
   * @param string $text
   *   The comment message.
   */
  public function comment($text);

}
