=== Panda Theme ===
Contributors: Salahudheen
Requires at least: 5.0
Tested up to: 6.5
Requires PHP: 7.4
Stable tag: 1.0.0
Version: 1.0.0
License: GNU General Public License v2 or later
License URI: https://www.gnu.org/licenses/gpl-2.0.html
Tags: custom-theme, responsive, blog, business, full-width-template
Author: Salahudheen
Author URI: https://example.com/
Theme URI: https://example.com/panda-theme/
Description: Panda Theme is a fully custom WordPress theme designed with multiple customizable sections using the WordPress Customizer. It is suitable for business, services, and blog-based websites. 

== Installation ==
1. Upload the `panda-theme` folder to `/wp-content/themes/`.
2. Activate the theme through the **Appearance > Themes** menu in WordPress.
3. Use the **Customizer (Appearance > Customize)** to configure all sections of the theme.
4. Set your homepage as a static page and assign the template to `Front Page`.

== Folder & File Structure ==
panda-theme/
├── assets/
│ ├── css/
│ │ └── style.css
│ ├── js/
│ │ └── script.js
│ └── images/
├── template-parts/
│ ├── header.php
│ ├── footer.php
│ ├── hero-section.php
│ ├── easy-track-section.php
│ ├── services-section.php
│ ├── about-section.php
│ ├── features-section.php
│ ├── testimonials-section.php
│ ├── blog-section.php
│ ├── footer-banner-section.php
├── front-page.php
├── functions.php
├── style.css
├── index.php
├── screenshot.png
└── readme.txt


== Theme Customizer Options & Sections ==

=== Header ===
- Logo: Upload logo image from Customizer (Header Settings).
- Logo URL: Set custom link for logo.
- Right Side Button: Add button text and URL.

=== Navigation Menu ===
- The primary menu can be managed from **Appearance > Menus**.

=== Hero Section ===
- Customizer → Homepage → Hero Section
- Options: Right Banner Image, Left Button, Title, Description.
- This section also supports a Parcel Number Form.
  • Users can enter a parcel number into the form.
  • Input is validated to ensure the field is not empty.
  • On success, an AJAX success message is displayed.
  • On error or invalid entry, an error message is shown.
  • Submitted parcel numbers can be viewed in the Dashboard under "Parcel Submission".

=== Easy Track Section ===
- Customizer → Easy Track Section
- Options: Section Title, 3 Grid Items with Icon, Title, and Description.

=== Our Services Section ===
- Customizer → Services Section
- Options: Button Text, Section Title, Description, 4 Grid Images with Title & Icon.
- "View All Services" button link.

=== About Section ===
- Customizer → About Us Section
- Options: Title, Description, Button Text, Featured Image.
- Grid Section: Upload up to 8 images.

=== Features Section ===
- Customizer → Features Section
- Options: Title, Button Text.
- 4 Grid Items: Left Image, Right Icon, Title, and Description.

=== Testimonials Section ===
- Customizer → Testimonials Section
- Options: Title, Description, Button.
- Add testimonials via **Custom Post Type: Testimonials** in Admin Dashboard.
  - Fields: Name, Position, Image, Description, Rating.

=== Blog Section ===
- Customizer → Blog Section
- Options: Title, Button Text, "View All" button.
- Displays 4 recent posts from WordPress **Posts**.

=== Footer Banner Section ===
- Customizer → Footer Banner
- Options: Title, Description, Button, Image.

=== Footer Section ===
- Customizer → Footer
- Options: Logo, Description.
- Footer Widgets: 
  - Company (4 links)
  - Our Services (4 links)
  - Resources (4 links)
  - Social Links (4 icons with URLs)

== Required Plugins ==
- No required plugins. (Optional: Contact Form 7, Classic Editor depending on your use case).

== Theme Support ==
- Compatible with latest WordPress block editor.
- Responsive design for mobile & desktop.
- Cross-browser compatibility.

== Changelog ==
= 1.0.0 =
* Initial release of Panda Theme.

== Upgrade Notice ==
= 1.0.0 =
Initial stable release.

== License ==
This theme is licensed under the GPL v2 or later.
You can use it to build commercial or personal projects.

=====
