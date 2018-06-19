# WP + VueJS

This is a WordPress theme utilizing the power of [VueJS](https://vuejs.org/) and the [WordPress REST API](https://developer.wordpress.org/rest-api/).

## WHY?

### Temporarily Coupled CMS
WordPress does a lot of things well and didn't want to completely disassociate the Front-End from the magic of `wp_head()` & `wp_footer` and the menu system. This maintains simple use of [enqueue-scripts](/blob/master/inc/enqueue-scripts.php), WordPress menu management, popular SEO plugins such as [YOAST](https://yoast.com/wordpress/plugins/seo/) and taking advantage of localized scripts for the initial page.

### Ease of Use

I wanted the theme to be easily used on any WordPress platform, no need for a Node server to recreate many of the WordPress functions. At the same time, this theme should be easily altered for use on Node with very little alterations. Maintaining the structure of the

## Structure
- **[config](/tree/master/config)** : Configuration files for webpack, eslint, postcss, etc.
- **[inc](/tree/master/inc)** : All WordPress scripts referenced in *functions.php*
- **[src](/tree/master/src)** : Modularized files to be built by webpack, restrict to only compilable files and not static assets
- **functions.php** : Collection of WordPress theme specific hooks, filters and actions imported from the [inc/](/tree/master/inc) folder
- **index.php** : [WordPress template hierarchy](https://developer.wordpress.org/themes/basics/template-hierarchy/) falls back to *index.php* for all content
- **header.php** : Site doctype, head, `wp_head()`, opening tags, and theme header
- **footer.php** : Theme footer, necessary closing tags and `wp_footer()`

#### Static Assets

```
To Be Continued
```

## Set Up

1. Navigate to the theme folder `cd wp-content/themes/bsm`
2. Install node packages: `yarn install` or `npm install`
3. Run a build script to generate a fresh *dist/* folder

### IMPORTANT!
In order to automate everything, the names for the following should be consistent:
- Theme folder name
- `Text Domain` in *style.css*
- `name` in *package.json*

### Build Options

* `dev` : starts webpack-dev-server with [HMR](#hot-module-replacement-hmr)
* `dev:watch` : watches the *src/* folder for changes to trigger a new build
* `staging` : builds non-minimized files for debugging, keeps vue-debug & source-mapping enabled
* `build` : minimizes code and updates the version number in *style.css* for [cache-busting](#cache-busting)

## Hot Module Replacement (HMR)

One of [Webpack](https://webpack.js.org/)'s highly valuable features is the [Hot Module Replacement](https://webpack.js.org/concepts/hot-module-replacement/):

>Hot Module Replacement (HMR) exchanges, adds, or removes modules while an application is running, without a full reload. This can significantly speed up development in a few ways:
>* Retain application state which is lost during a full reload.
>* Save valuable development time by only updating what's changed.
>* Tweak styling faster -- almost comparable to changing styles in the browser's debugger.

With Webpack Dev Server being in Node and WordPress being PHP, HMR has been only attainable under a static *index.html* file. However, after much research I discovered [this post](https://m.dotdev.co/using-webpack-2-hmr-in-laravel-development-2f632d6d06c6) detailing how to access the HMR assets externally, as long as the URLs are different.

>I use [Valet](https://laravel.com/docs/master/valet) for my local development so I can easily switch between projects or quickly hop on a hotfix when needed without shutting down my main project.

## Cache-Busting

The `themebump` script

```
To Be Continued
```

## Road Map

:white_check_mark: ~~[cache-busting](#cache-busting)~~

:white_check_mark: ~~[Hot Module Replacement](#hot-module-replacement-hmr)~~

- [ ] Consistent data ([Localize Script](#localized-scripts) & REST API)
	> The WordPress PHP object is structured differently than the REST API JSON objects and I need to find a way to keep the consistency so our theme doesn't require a function to check for `id` vs `ID`, or `post_title` vs `title.rendered`
- [ ] ...more

## Localized Scripts

```
To Be Continued
```
