<?php

namespace radiergummi\recaptchaverify\variables;

use craft\web\twig\variables\CraftVariable;
use radiergummi\recaptchaverify\RecaptchaVerify;

/**
 * RecaptchaVariable class
 *
 * @package radiergummi\recaptchaverify\variables
 */
class RecaptchaVariable extends CraftVariable {
    public function getSiteKey(): string {
        return RecaptchaVerify::getInstance()->getSettings()->siteKey;
    }
}
