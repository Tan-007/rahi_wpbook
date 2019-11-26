# rahi_wpbook
[![Scrutinizer Code Quality](https://scrutinizer-ci.com/g/Tan-007/rahi_wpbook/badges/quality-score.png?b=master)](https://scrutinizer-ci.com/g/Tan-007/rahi_wpbook/?branch=master)

This WordPress plugin comes bundled with two widgets and whole setup to help you manage books on your WordPress site.
The plugin was developed during the WordPress training program provided by [rtCamp](https://rtcamp.com/). Requirements for the plugin 
were provided by rtCamp which can be found [here](https://learn.rtcamp.com/topic/plugin-development-assignment/).

- [For Developers](https://github.com/Tan-007/rahi_wpbook#for-developers)
- [For Users](https://github.com/Tan-007/rahi_wpbook#for-users)
- [Screenshot(s)](https://github.com/Tan-007/rahi_wpbook#screenshots)

## For developers: 
### Here are the main directories/files:
- `admin`: contains all the admin side functionality files
  - `css`: contains admin side styles
  - `js`: contains admin side scripts
  - `partials`: contains helper functions that render content(mostly contains html and less php) on admin side
  - `class-rahi_wpbook-admin.php`(file): contains the core admin side functionality class which has all the custom functions
- `includes`: contains loader class file and activator and deactivator class files
  - `class-rahi_wpbook.php`(file): contains the class which contains for all the hooks and filters. also loads all dependencies
- `languages`: contains pot template for localization
- `public`: contains all user side functionality files
  - `css`: user side styles
  - `js`: user side scripts
  - `partials`: contains helper functions that render content(mostly contains html and less php) on user side
- `rahi_wpbook.php`(file): main file from where the execution starts
- `uninstall.php`(file): is executed when the plugin is uninstalled. Does all the plugin related data cleanup from the database.

There are no third party plugins/libraries used and **working demo can be found [here](https://rahicodes.000webhostapp.com/2019/11/demonstrates-wp_book)**(book shortcode and widget are visible in the demo. Other features will only be visible from the admin panel)

## For users:
### Activation: 
This plugin is not available on WordPress marketplace hence you will have to manually upload this plugin to your website's directory.
1. Click on `Clone or download` button at top right in this directory to download a zip file of this entire directory on your computer.
2. From your FTP client or your cpanel go to your WordPress website's root directory and navigate to the `plugins` folder at `wp-content`>`plugins`
3. Create a new folder named `rahi_wpbook` inside `plugins` folder and copy all content of the zip file that you downloaded from github
4. Log in to your WordPress admin panel and navigate to `plugins`
5. There should be a new plugin available named `Wp Book`. Click on active to activate it. 

### Using the plugin:
1. On activation the plugin enables a custom post type named `book`. Now you can manage all your books at one place.
2. You are given functionality to store additional information related to a book like Price, Edition, Book URL, Publisher, Year, etc.
3. You can manage all your books from a section available in your admin panel called `Books`
4. You can change your currency of the book price and books to be displayed per page from a settings page called `Book Settings` in your admin panel
5. You are also provided with two widgets. One which shows up in your dashboard, shows information about top 5 book categories. The second widget can be added in your sidebar which let's you display recent books from your chosen book categories!
6. Plugin also provides you a shortcode `[book]` which can be used to display all of your books at anywhere in your site.
7. The shortcode accepts various attributes like `id`, `category`, `tag`. You can pass an attribute like, `[book id=5]` which will display the book which has id 5

## Screenshot(s):
Book sidebar widget:

![Book widget](https://i.imgur.com/ZtsLTVw.png)

Book dashboard widget:

![Dashboard widget](https://i.imgur.com/FY7X6a3.png)

Book `Books` section in admin panel:

![Manage Books](https://i.imgur.com/dF3ghyj.png)

`Book Settings` page:

![Book settings](https://i.imgur.com/QWPP7tQ.png)

`book` shortcode example output:

![Book shortcode output](https://i.imgur.com/ZfZ8YdL.png)

