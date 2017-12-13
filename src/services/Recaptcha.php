<?php
/**
 * Recaptcha Verify plugin for Craft CMS 3.x
 * Verifies Recaptcha with Google's API
 *
 * @link      https://www.moritzfriedrich.com
 * @copyright Copyright (c) 2017 Moritz Friedrich
 */

namespace radiergummi\recaptchaverify\services;

use craft\base\Component;
use radiergummi\recaptchaverify\RecaptchaVerify;

/**
 * @author    Moritz Friedrich
 * @package   RecaptchaVerify
 * @since     1.0.0
 */
class Recaptcha extends Component {

    /**
     * verifies a token
     *
     * @param string $token
     *
     * @return bool
     */
    public function verifyToken( string $token ): bool {

        $secret = RecaptchaVerify::$plugin->getSettings()->secret;

        if ( ! $secret || ! $token ) {
            return false;
        }

        return true;
    }
}
