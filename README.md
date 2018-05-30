# WP Boilerplate

## Set Up

### Clone the Repo

There are two branches of note:

* `Master` production branch
* `Staging` staging branch

Both branches go through [DeployBot](https://blackstonemedia.deploybot.com/) to be pushed to WP Engine via SFTP.
- `staging` is an automatic deployment
- `master` must be manually triggered

You should never have to pull from WP Engine

### Local WP Setup

Run the follow code in your repo's root

*If you have a database dump to import, replace `wp db create` with `wp db import path_to_sql`*

```
wp core download --skip-content
wp config create --dbname="wp-bsm" --dbuser="root" --dbpass="root"
wp db create
wp core install --url=bsm.localhost --title="Blackstone Media" --admin_user=admin --admin_password=admin --admin_email=your_email
```

#### Theme

1. Activate the theme: `wp theme activate bsm`
2. Navigate to the theme folder `cd wp-content/themes/bsm`
3. Install node packages: `yarn install` or `npm install`
4. Generate a dist folder with `yarn staging` (`npm run staging`) or start webpack dev server with `yarn dev` (`npm run dev`)

#### Plugins

These plugins are required. You can activate them via command line.

* *[WP-Migrate-DB Pro](https://deliciousbrains.com/wp-migrate-db-pro)*
* *[Advanced Custom Fields Pro](https://advancedcustomfields.com)*

```
wp plugin activate wp-migrate-db-pro wp-migrate-db-pro-cli advanced-custom-fields-pro

```

WP-Migrate-DB Pro requires a license key that you'll need to manually add in the plugin settings

* URL: `/wp-admin/tools.php?page=wp-migrate-db-pro#settings`
* KEY: `4d92f653-67ca-4b99-9f1a-8922f8cfc40f`

To setup WP-Migrate-DB Pro to pull from production, from the plugin's settings:

1. Click Migrate
2. Click Pull
3. Paste this code: `https://teamblackstone.wpengine.com I0h/G/WuZOTjEDPrpnvQh1WHAV4JqTqiqa2FvLdO`
4. **(Optional)** Backup local database
5. Save Migration Profile
6. Pull & Save
7. Log back in...if you want

These plugins are ignored in the repo so they're not tracked but are useful for local development.

*[Debug This](https://wordpress.org/plugins/debug-this)*
Helpful plugin to track down anything on the page
```
wp plugin install debug-this --activate
```

*[Coral Remote Images](https://wordpress.org/plugins/coral-remote-images/)*
Redirects images to another url, alleviating the need to download/sync uploads directory.
```
wp plugin install coral-remote-images --activate
```

> WP-Migrate Pro does provide a [Media Files Addon](https://deliciousbrains.com/wp-migrate-db-pro/doc/media-files-addon/) but hasn't been tested
