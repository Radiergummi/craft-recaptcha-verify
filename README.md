Recaptcha Verify plugin for Craft CMS 3.x
=========================================
Verifies Recaptcha with Google's API.


Requirements
------------
This plugin requires Craft CMS 3.0.0-beta.23 or later.


Installation
------------
To install the plugin, follow these instructions.

1. Open your terminal and go to your Craft project:

````bash
 cd /path/to/project
````

2. Then tell Composer to load the plugin:

````bash
 composer require radiergummi/recaptcha-verify
````

3. In the Control Panel, go to *Settings* → *Plugins* and click the *“Install”* button for Recaptcha Verify.


Recaptcha Verify Overview
-------------------------
Recaptcha Verify validates Recaptcha tokens against Google's library. This is most possibly the smallest plugin I've 
ever written for any CMS (ignoring my `debugTheme` plugin for WordPress, which has an astonishing 3 lines to offer).


Using Recaptcha Verify
----------------------
Recaptcha Verify provides a new `POST` action to Craft: `recaptcha-verify/verify`, that enables you to verify your 
responses. It also provides listeners for the contact form plugin, so you can verify your submissions. Details [below](#contactform-integration)


Configuring Recaptcha Verify
----------------------------
There are two settings fields: Your Recaptcha API *site key* and *secret*. You can acquire them here: https://www.google.com/recaptcha/admin

Fill the values as they are presented on the Google instructions page. You can also use a (multi-environment aware) configuration file named `recaptcha-verify.php`.


ContactForm integration
-----------------------
This is still a `TODO` scheduled for 0.5.0 :wink:


> Brought to you by [Radiergummi](https://github.com/Radiergummi)
