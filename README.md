CONTENTS OF THIS FILE
---------------------

 * Introduction
 * Requirements
 * Installation
 * Configuration
 * Additional Plugins
 * Maintainers


INTRODUCTION
------------

A module that adds support for CKEditor 5 plugin [Media Embed](https://ckeditor.com/docs/ckeditor5/latest/features/media-embed.html).


INSTALLATION
------------

Install the module per normal https://www.drupal.org/documentation/install/modules-themes/modules-8


CONFIGURATION
-------------

Install and enable [CKEditor media embed](https://www.drupal.org/project/ckeditor_media_embed) module.

  * WYSIWYG

    - Go to the 'Text formats and editors' configuration page:
      `/admin/config/content/formats`, and for each text format/editor combo
      where you want to embed URLs, do the following:
    - Drag and drop the 'Media Embed' button into the Active toolbar.
    - Enable the 'Convert Oembed tags to media embeds' filter.
    - If the text format uses the
      'Limit allowed HTML tags and correct faulty HTML' filter, then
      'Convert Oembed tags to media embeds' filter must be placed after
      the 'Limit allowed HTML tags and correct faulty HTML' filter.

  * Field formatter

    The field formatter allows link fields to be rendered via the configured
    oembed service provider.

    - Navigate to "Manage display" for the content type, after adding a "Link"
      field.
    - Select the "Oembed element using CKEditor Media Embed provider" format for
      the link field you wish.


MAINTAINERS
-----------

Current maintainers:
  * Santeri Hurnanen (oikeuttaelaimille) - https://www.drupal.org/u/oikeuttaelaimille
  * Jonathan DeLaigle (grndlvl) - https://www.drupal.org/u/grndlvl
