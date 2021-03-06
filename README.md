# Open Badges Framework
A WordPress plugin for open badges

Contributors: @colomet, @AleRiccardi, @ntorion, @uzair043, @CorentinPerrot, @alevacher, @Kongat, @leocharlier, @ioanna, @CharalamposTheodorou

Tags: badges

## BadgrAPI

### Status
- In development, restructure of stored data into the requierd format for the new API.
- Checks for Token if created and valid.
- Checks for Issuer if created and entity_id is valid.
- Checks for BadgeClass if created.
- Checks for Assertion if exists for same user.
- All requests are done and checked for sending badges to Badgr Backpack.
- Link to new API site changed, to create new account.
- Badges are updated for each state for the user.
- get-the-badge page (from email) changes on the context.

### Assumptions
- Account for issuer in badgr europe server exists.
- If token json file doens't exists, then it means that token was never created. requesting for first time. Creates new file in installation to store the token details.
- If token json file exists it must be uploaded to accordinate location in the installation.
- If Recipient of badge doesn't have a Badgr account, the badge will be awarder. just waiting the user to activate it when the account is registered with same email.

## Community / Support

You can join our [Chat](https://gitter.im/my-language-skills/open-badges-framework "chat" ) and talk with us.


## Description

Open Badges Framework allows you to distribute and receive certifications of level language skills.
Open-Badge-Framework extends this possibility by giving the proof that your certification corresponds to your level.

## Installation

1. Clone (or copy) this repository to the `/wp-content/plugins/` directory.
1. Activate the plugin through the 'Plugins' screen in WordPress.

## Frequently Asked Questions

* [Open Badges Framework](doc/open-badges-framework.md).
* [General documentation](doc/documentation-general.md).
* [Technical documentation](doc/documentation-technical.md).
* [Integrations](doc/documentation-integrations.md).
* [The folder structure](doc/folder-structure.md).

## Requirements

Plugin/Template Name works with:

 * ![PHP](https://img.shields.io/badge/PHP-7.X-blue.svg)

## Disclaimers

The Open-Badge-Framework plugin is supplied "as is" and all use is at your own risk.

## Screenshots

You can see all of the screenshots of the plugin [here](doc/screenshots.md "screenshots").

## Roadmap

### 0.x

 * **ADDITIONS**

 * **ENHANCEMENTS**
  * New images/ images optimization.

 * **BUGFIXES**
  * Correct version number of release.

### now
 * To create students and teacher page.

### soon
 * To review the classes.
 * Inform of the process to the senders of badges.
 * Add a section in settings page to manage time for commenting a class.
 * Replace students' login by mail in the user profiles and class pages.
 * Description metabox - txt with translations.
 * Recomended resolution for cover image in "post class" page.
 * To use schema metadata for the badges information.
 * Fixing spam problem with email.
 * To delete all the information of the plugin option if we wish by deleting the plugin.

### 1.1
 * **ADDITIONS**
 	* Create an alignment metabox (#288)
	* Update the Json File to version 2.0 (#198)

### 1.0.2
 * **ADDITIONS**
 	* Show the username in the "getBadge" pages, if the user has no FirstName (#275)

### 1.0.1 dev
 * **BUGFIXES**
	* Company site picture BUG
	* User profile country selector BUG
  	* Alert message in the Information Section of the Sending Badges Page (#278)

## Changelog

### 2.0
* **ADDITIONS**
	* Migration to a new API for the backpack platform of the badges
	* Small changes in context to fit new API description and necessary direction links
	* Badgr fully integrated to work with old badges craeted for previous backpack platform.

### 1.0.1

* **ADDITIONS**
	* Add wordpress assets images.

### 1.0.0

* **ADDITIONS**
	* Add custom fields in the Restrict Content Pro regitration form (this datas are saved in the WP user profile and not in the RCP member).
	* Add custom fields in the WP profile editor.
	* Add fields in the registration form during the "Get a badge" process. #212
	* Add the 'Lost password' link to the login form during the "Get a badge" process. #216
	* Enable reCAPTCHA in the RCP registration form.
	* Add CAPTCHA in the registration form during the "Get a badge" process (with Really Simple Captcha plugin). #217
	* Add all the WP editor fields in the OBF user page (all the information is displayed).
	* Propose to add the first badge in the "All Badges" section if no one is found.
	* Load a default company logo if no one is set.
	* Responsive design.
	
* **BUGFIXES**
	* Remove the "Add Class" link in Settings->Links when the WP Job Manager plugin is not activated. #195
	* Export the custom datas created (year of birth, country, badges earned, etc.) during the WP "Export Personal Data" process.

### 1.0 RC2

* **ADDITIONS**

  * Plugin Internationalization( notes,not bug ) #220
  * Badges can be now translated #181
  * multiple emails limitation #68
  * Teachers Statistics ( Ratio ) #219
  * Basic stadistical information #67
  * To reset the badge / user database #207 #156
  * Delete users(teachers and students) intergrated with WP
  * ~~Deletion of the custom db tables when uninstall #224~~
  * Get the badge page basic personalization (+login/register) #64 #105

* **ENHANCEMENTS**
 	* Fix the email security issue #205
	
### 1.0 RC1

Completely overhauled design, from top to bottom. The plugin has been completely rewritten. Version 1.0 just basic functionalities.
* Aceptation badge email.
* Automatic registration to new students by receiving an aceptation badge email.
* OpenBadges API integration with Backpack integration from the aceptation badge email.
* Users profile save badges, classes and rating logs.
* Different Roles: Student, Teacher and Academy.
* Update of information not allow to users.
* Unlimited creation of badges.
* Badges for Teachers or Students.
* Certified badges just available for Academy role teachers.
* Taxonomy for the badges: Fiels of education and level.
* Send badges to Self, Single student or Multiple students.
* Settings pages.
* Integration with wp Job Manager for the creation of Classes.
* Archive Badge page : you can filter your search by clicking on one badge's specificitie (level, certification, FoE, target). #235

### Older Changelog

[Alpha and Beta changelog](doc/changelog-beta.md).

## Upgrade Notice

1.0 Completely overhauled design, from top to bottom. The plugin has been completely rewritten.


## Credits
Here's a link to [Alecaddd](http://www.alecaddd.com/) [WordPressPlugin101](https://github.com/Alecaddd/WordPressPlugin101) on [YouTube](https://www.youtube.com/playlist?list=PLriKzYyLb28kR_CPMz8uierDWC2y3znI2).

Here's a link to [WordPress](http://wordpress.org/ "Your favorite software").

Here's a link to [OpenBadges](http://openbadges.org/ "Mozilla Open Badges official site").

Here's a link to [Plugin Boilerplate](http://wppb.io/ "Uses the WordPress Plugin Boilerplate").
