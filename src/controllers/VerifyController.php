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
use yii\web\BadRequestHttpException;
use yii\web\Response;

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
     * @return Response
     * @throws \yii\web\BadRequestHttpException
     */
    public function actionIndex(): Response {
        $this->requirePostRequest();

        $token = Craft::$app->getRequest()->getBodyParam( 'token' );

        if ( ! $token ) {
            throw new BadRequestHttpException( Craft::t( 'recaptcha-verify', 'No token in request' ) );
        }

        return $this
            ->asJson( [
                          'status' => RecaptchaVerify::getInstance()->recaptcha->verifyToken( $token )
                              ? 'success'
                              : 'failed'
                      ] );
    }
}
