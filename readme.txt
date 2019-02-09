=== Feature Policy ===

Contributors:      google, westonruter, flixos90
Requires at least: 4.7
Tested up to:      5.0
Requires PHP:      5.6
Stable tag:        0.1.0
License:           GNU General Public License v2 (or later)
License URI:       https://www.gnu.org/licenses/gpl-2.0.html
Tags:              feature, policy

WordPress plugin for managing feature policy headers.

== Description ==

As [noted on MDN](https://developer.mozilla.org/en-US/docs/Web/HTTP/Feature_Policy):

> Feature Policy provides a mechanism to explicitly declare what functionality is used (or not used), throughout your website. This allows you to lock in best practices, even as the codebase evolves over time — as well as to more safely compose third-party content — by limiting which features are available.
>
> With Feature Policy, you opt-in to a set of "policies" for the browser to enforce on specific features used throughout a website. These policies restrict what APIs the site can access or modify the browser's default behavior for certain features.

This plugin provides an API for sending the `Feature-Policy` response headers, as well as an admin interface for deciding which feature policies to apply.

== Installation ==

1. Upload the entire `feature-policy` folder to the `/wp-content/plugins/` directory or download it through the WordPress backend.
2. Activate the plugin through the 'Plugins' menu in WordPress.

== Frequently Asked Questions ==

TODO.

= Where should I submit my support request? =

For regular support requests, please use the [wordpress.org support forums](https://wordpress.org/support/plugin/feature-policy). If you have a technical issue with the plugin where you already have more insight on how to fix it, you can also [open an issue on Github instead](https://github.com/GoogleChromeLabs/wp-feature-policy/issues).

= How can I contribute to the plugin? =

If you have some ideas to improve the plugin or to solve a bug, feel free to raise an issue or submit a pull request in the [Github repository for the plugin](https://github.com/GoogleChromeLabs/wp-feature-policy). Please stick to the [contributing guidelines](https://github.com/GoogleChromeLabs/wp-feature-policy/blob/master/CONTRIBUTING.md).

You can also contribute to the plugin by translating it. Simply visit [translate.wordpress.org](https://translate.wordpress.org/projects/wp-plugins/feature-policy) to get started.

== Screenshots ==

TODO.

== Changelog ==

= 0.1.0 =

* Initial release
