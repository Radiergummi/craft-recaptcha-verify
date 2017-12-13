<?php
/**
 * Recaptcha Verify plugin for Craft CMS 3.x
 * Verifies Recaptcha with Google's API
 *
 * @link      https://www.moritzfriedrich.com
 * @copyright Copyright (c) 2017 Moritz Friedrich
 */

namespace radiergummi\recaptchaverify\services;

use Craft;
use craft\base\Component;
use radiergummi\recaptchaverify\RecaptchaVerify;
use ReCaptcha\ReCaptcha as ReCaptchaProvider;

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
        $ip     = Craft::$app->getRequest()->remoteIP;

        if ( ! $secret ) {
            Craft::warning(
                Craft::t(
                    'recaptcha-verify',
                    'Secret is not configured. Recaptchas will not be validated without one.',
                    [ 'token' => $token ]
                ),
                __METHOD__ );

            return false;
        }

        $recaptcha             = new ReCaptchaProvider( $secret );
        $recaptchaVerification = $recaptcha->verify( $token, $ip );

        if ( $recaptchaVerification->isSuccess() ) {
            Craft::trace(
                Craft::t(
                    'recaptcha-verify',
                    'Verified token {token}',
                    [ 'token' => $token ]
                ),
                __METHOD__
            );

            return true;
        }

        Craft::error(
            Craft::t(
                'recaptcha-verify',
                'Recaptcha verification failed: {reasons}. Please check the error code reference at {link}',
                [
                    'reasons' => join( ', ', $recaptchaVerification->getErrorCodes() ),
                    'link'    => 'https://developers.google.com/recaptcha/docs/verify#error-code-reference'
                ]
            ),
            __METHOD__
        );

        return false;
    }
}
