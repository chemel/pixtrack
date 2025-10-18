# pixtrack

pixtrack is a small PHP image server and tracker. It serves image files from a configured images directory and records each access in daily CSV log files for simple tracking and analytics.

## Usage

Drop the projet files on your `www` directory.

Run `composer install`

Try to access to `/images/pixel.png` in your browser.

Reportings are saved to `storage/logs` directory.

## Features

You can add images in the `storage/images` directory.

You can add tracking informations in the uri, exemple : `/images/pixel.png?from=github`.
