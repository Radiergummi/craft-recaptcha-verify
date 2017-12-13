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
responses. It also provides listeners for the contact form plugin, so you can verify your submissions. Details [below](#contactform-integration).  

The action expects the body content to contain `CRAFT_CSRF_TOKEN` and `token`, where token is the Recaptcha token received from Google. To set up the client side verification process, take a peek at the [Google documentation](https://developers.google.com/recaptcha/docs/display).  

**The response will be a 400 error if**
 - you don't have a secret configured in the settings
 - there is no token in the POST body

**The response will be a 200 success if**
 - the token could be validated (`{status: 'success'}` as response body)
 - the token could **not** be validated (`{status: 'failed'}` as response body)

It might sound strange to not throw an error for a validation issue, but it's actually just the result of the action asked for. How you handle that error on the client side is up to you.
*If there is substantial interest in that being changed to throw an error too, I'll update the plugin.*


Configuring Recaptcha Verify
----------------------------
There are two settings fields: Your Recaptcha API *site key* and *secret*. You can acquire them here: https://www.google.com/recaptcha/admin

Fill the values as they are presented on the Google instructions page. You can also use a (multi-environment aware) configuration file named `recaptcha-verify.php`.


ContactForm integration
-----------------------
**This is still a `TODO` scheduled for 0.3.0 :wink:  
Currently I'm not sure on how to make this optional, if anyone would like to help out, I'm open for PRs or issues.**

To validate the token within a form submission, include the field `message[token]` in your form submission. [Recaptcha does currently not (and most likely never will) support browsers without JavaScript](https://developers.google.com/recaptcha/docs/faq#does-recaptcha-support-users-that-dont-have-javascript-enabled), so you'll need to submit it via JS anyway.  
See the following example form for reference:  

```html
<!-- Create your form. I skipped all the fields you'll likely want to include for simplicity -->
<form action="/" method="POST" id="contact-form">
  <input type="submit" value="Send">
</form>

<!-- Provide a container to render the recaptcha in -->
<div id="recaptcha-container"></div>

<!-- Include the Recaptcha script, passing our callback -->
<script src="https://www.google.com/recaptcha/api.js?onload=onloadCallback&render=explicit" async defer>

<script>
  // this will hold our token
  let recaptchaToken = null;
  
  // callback for Recaptcha. We passed that as a parameter to `onload` in the script URL
  const onloadCallback = function() {
  
    // render the widget in our container
    grecaptcha.render('recaptcha-container', {
      sitekey:  'your_site_key', // that one is passed in the settings
      callback: verifyCallback,  // our verification callback below
      theme:    'dark'           // optional theme
    });
  };
  
  // set recaptchaToken to the response from Google
  const verifyCallback = function(response) {
    recaptchaToken = response;
  };
  
  // capture the submit event from our form
  document.querySelector('#contact-form').addEventListener('submit', event => {
  
    // prevent it from automatically submitting just yet
    event.preventDefault();
    
    // if we don't have a token at this point, the user did not confirm the Recaptcha yet
    if (!recaptchaToken) {
      return alert('Please confirm the Recaptcha first!');
    }
    
    // using Axios here for less complex code, you're free to use whatever AJAX library of course.
    // we pass the token (among our other fields, of course) as a parameter
    axios.post('/', {
      action:           'contact-form/send'
      'message[token]': recaptchaToken
    });
  });
</script>
```

> Brought to you by [Radiergummi](https://github.com/Radiergummi)
