=== Feature Policy ===

Contributors:      google, westonruter, flixos90
Requires at least: 4.7
Tested up to:      5.1
Requires PHP:      5.6
Stable tag:        0.1.0
License:           GNU General Public License v2 (or later)
License URI:       https://www.gnu.org/licenses/gpl-2.0.html
Tags:              feature, policy

WordPress plugin for managing feature policy headers.

== Description ==

As [noted on the Google Developers blog](https://developers.google.com/web/updates/2018/06/feature-policy):

> Feature Policy allows web developers to selectively enable, disable, and modify the behavior of certain APIs and web features in the browser. **It's like CSP but instead of controlling security, it controls features!**
>
> The feature policies themselves are little opt-in agreements between developer and browser that can help foster our goals of building (and maintaining) high quality web apps.

This plugin provides an API for sending the `Feature-Policy` response headers, as well as an admin interface for deciding which policy to apply for each feature.

As the Feature Policy specification is still evolving and at an early stage, the plugin reflects that and is currently an experimental prototype, to demonstrate how Feature Policy can be used in WordPress.

= Did you know? =

The Feature Policy specification will integrate with the new Reporting API specification. There is a [WordPress plugin for that specification](https://wordpress.org/plugins/reporting-api/) as well.

== Installation ==

1. Upload the entire `feature-policy` folder to the `/wp-content/plugins/` directory or download it through the WordPress backend.
2. Activate the plugin through the 'Plugins' menu in WordPress.

== Frequently Asked Questions ==

= Which browsers support the Feature Policy specification? =

The Feature Policy standard is quite bleeding-edge, so support is currently still limited. The latest versions of Chrome, Safari, Opera and several mobile browsers support it. For detailed support stats, please check [caniuse.com/#feat=feature-policy](https://caniuse.com/#feat=feature-policy).

= Where should I submit my support request? =

Note that this is an experimental plugin, so support is limited and volunteer-driven. For regular support requests, please use the [wordpress.org support forums](https://wordpress.org/support/plugin/feature-policy). If you have a technical issue with the plugin where you already have more insight on how to fix it, you can also [open an issue on Github instead](https://github.com/GoogleChromeLabs/wp-feature-policy/issues).

= How can I contribute to the plugin? =

If you have some ideas to improve the plugin or to solve a bug, feel free to raise an issue or submit a pull request in the [Github repository for the plugin](https://github.com/GoogleChromeLabs/wp-feature-policy). Please stick to the [contributing guidelines](https://github.com/GoogleChromeLabs/wp-feature-policy/blob/master/CONTRIBUTING.md).

You can also contribute to the plugin by translating it. Simply visit [translate.wordpress.org](https://translate.wordpress.org/projects/wp-plugins/feature-policy) to get started.

== Screenshots ==

1. Settings screen to control policies for all available features
2. Settings screen with a link to Feature Policy reports (with the Reporting API plugin active)

== Changelog ==

= 0.1.0 =

* Initial release
