#!/bin/bash

wp-env run cli wp theme activate twentytwentythree
wp-env run cli wp rewrite structure /%postname%
wp-env run cli wp option update blogname "SQL to CPT"
wp-env run cli wp option update blogdescription "Import & Convert SQL files to Custom Post Types (CPT)."
