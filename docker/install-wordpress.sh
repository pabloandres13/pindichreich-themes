#!/bin/sh
set -e

if wp core is-installed 2>/dev/null; then
  echo "WordPress is already installed. Skipping."
  exit 0
fi

wp core install \
  --url="http://localhost:8080" \
  --title="$WP_SITE_TITLE" \
  --admin_user="$WP_ADMIN_USER" \
  --admin_password="$WP_ADMIN_PASSWORD" \
  --admin_email="$WP_ADMIN_EMAIL" \
  --skip-email

echo "WordPress installed successfully."

# Install Astra parent theme (required by the mamaglueck child theme)
if ! wp theme is-installed astra 2>/dev/null; then
  wp theme install astra
  echo "Astra theme installed."
else
  echo "Astra already installed. Skipping."
fi

# Create the homepage page with pre-filled block content
wp eval-file /create-homepage.php
