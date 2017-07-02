# Turiknox Sample Image Uploader

## Overview

A Magento 2 sample module demonstrating how to upload an image file within a grid and form UI Component.

## Requirements

Magento 2.1.x

## Installation

This module will add a table to your Magento 2 database. As with any third party modules that do this, it is recommended that you backup your database before installation.

Copy the contents of the module into your Magento root directory.

Enable the module via the command line:

/path/to/php bin/magento module:enable Turiknox_SampleImageUploader

Run the database upgrade via the command line:

/path/to/php bin/magento setup:upgrade

Run the compile command and refresh the Magento cache:

/path/to/php bin/magento setup:di:compile 

/path/to/php bin/magento cache:clean


## Usage

Add Images within the admin under the 'Sample Image Uploader' menu item.
