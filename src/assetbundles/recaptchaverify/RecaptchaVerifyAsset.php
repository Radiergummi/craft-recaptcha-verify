<?php
/**
 * Recaptcha Verify plugin for Craft CMS 3.x
 *
 * Verifies Recaptcha with Google's API
 *
 * @link      https://www.moritzfriedrich.com
 * @copyright Copyright (c) 2017 Moritz Friedrich
 */

namespace radiergummi\recaptchaverify\assetbundles\RecaptchaVerify;

use Craft;
use craft\web\AssetBundle;
use craft\web\assets\cp\CpAsset;

/**
 * @author    Moritz Friedrich
 * @package   RecaptchaVerify
 * @since     1.0.0
 */
class RecaptchaVerifyAsset extends AssetBundle
{
    // Public Methods
    // =========================================================================

    /**
     * @inheritdoc
     */
    public function init()
    {
        $this->sourcePath = "@radiergummi/recaptchaverify/assetbundles/recaptchaverify/dist";

        $this->depends = [
            CpAsset::class,
        ];

        $this->js = [
            'js/RecaptchaVerify.js',
        ];

        $this->css = [
            'css/RecaptchaVerify.css',
        ];

        parent::init();
    }
}
