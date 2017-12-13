<?php
/**
 * Recaptcha Verify plugin for Craft CMS 3.x
 * Verifies Recaptcha with Google's API
 *
 * @link      https://www.moritzfriedrich.com
 * @copyright Copyright (c) 2017 Moritz Friedrich
 */

namespace radiergummi\recaptchaverify;

use Craft;
use craft\base\Plugin;
use craft\events\ModelEvent;
use craft\events\RegisterUrlRulesEvent;
use craft\web\twig\variables\CraftVariable;
use craft\web\UrlManager;
use radiergummi\recaptchaverify\models\Settings;
use radiergummi\recaptchaverify\services\Recaptcha as RecaptchaService;
use radiergummi\recaptchaverify\variables\RecaptchaVariable;
use yii\base\Event;
use function class_exists;

/**
 * Class RecaptchaVerify
 *
 * @author    Moritz Friedrich
 * @package   RecaptchaVerify
 * @since     1.0.0
 * @property  RecaptchaService $recaptcha
 */
class RecaptchaVerify extends Plugin {
    // Static Properties
    // =========================================================================

    /**
     * @var RecaptchaVerify
     */
    public static $plugin;

    // Public Methods
    // =========================================================================

    /**
     * @inheritdoc
     */
    protected function createSettingsModel() {
        return new Settings();
    }

    public function getVersion() {
        return '1.0.0';
    }

    // Protected Methods
    // =========================================================================

    /**
     * @inheritdoc
     */
    public function init() {
        parent::init();
        self::$plugin = $this;

        Event::on(
            UrlManager::class,
            UrlManager::EVENT_REGISTER_SITE_URL_RULES,
            function( RegisterUrlRulesEvent $event ) {
                $event->rules['recaptcha-verify/verify'] = 'recaptcha-verify/verify';
            }
        );

        Event::on(
            CraftVariable::class,
            CraftVariable::EVENT_INIT,
            function( Event $event ) {
                /** @var CraftVariable $variable */
                $variable = $event->sender;

                $variable->set( 'recaptcha', RecaptchaVariable::class );
            }
        );

        // check if the ContactForm plugin is available
        if ( class_exists( 'craftcms\\contactform\\models\\Submission' ) ) {
            Event::on(
                craftcms\contactform\models\Submission::class,
                craftcms\contactform\models\Submission::EVENT_BEFORE_VALIDATE,
                function( ModelEvent $event ) {
                    /** @var craftcms\contactform\models\Submission $submission */
                    $submission = $event->sender;

                    // check if the token is set and verify it
                    $validates  =
                        is_string( $submission->token ) &&
                        $this->recaptcha->verifyToken( $submission->token );

                    if ( ! $validates ) {
                        $submission->addError( 'token', Craft::t(
                            'recaptcha',
                            'Could not validate Recaptcha token' )
                        );
                        $event->isValid = false;
                    }
                } );
        }

        Craft::info(
            Craft::t(
                'recaptcha-verify',
                '{name} plugin loaded',
                [ 'name' => $this->name ]
            ),
            __METHOD__
        );
    }

    /**
     * @inheritdoc
     */
    protected function settingsHtml(): string {
        return Craft::$app->view->renderTemplate(
            'recaptcha-verify/settings',
            [
                'settings' => $this->getSettings()
            ]
        );
    }
}
