<?php
/**
 * Recaptcha Verify plugin for Craft CMS 3.x
 * Verifies Recaptcha with Google's API
 *
 * @link      https://www.moritzfriedrich.com
 * @copyright Copyright (c) 2017 Moritz Friedrich
 */

namespace radiergummi\recaptchaverify\controllers;

use Craft;
use craft\web\Controller;
use radiergummi\recaptchaverify\RecaptchaVerify;

/**
 * @author    Moritz Friedrich
 * @package   RecaptchaVerify
 * @since     1.0.0
 */
class VerifyController extends Controller {

    // Protected Properties
    // =========================================================================

    /**
     * @var    bool|array Allows anonymous access to this controller's actions.
     *         The actions must be in 'kebab-case'
     * @access protected
     */
    protected $allowAnonymous = [ 'index' ];

    /**
     * verifies the supplied token
     *
     * @return bool
     * @throws \yii\web\BadRequestHttpException
     */
    public function actionIndex(): bool {
        $this->requirePostRequest();

        $token = Craft::$app->getRequest()->getBodyParam( 'token' );

        Craft::trace(
            Craft::t(
                'recaptcha-verify',
                'Verified token {token}',
                [ 'token' => $token ]
            ),
        __METHOD__ );

        return RecaptchaVerify::getInstance()->recaptcha->verifyToken( $token );
    }
}
