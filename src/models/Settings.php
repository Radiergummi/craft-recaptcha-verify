<?php
/**
 * Recaptcha Verify plugin for Craft CMS 3.x
 * Verifies Recaptcha with Google's API
 *
 * @link      https://www.moritzfriedrich.com
 * @copyright Copyright (c) 2017 Moritz Friedrich
 */

namespace radiergummi\recaptchaverify\models;

use craft\base\Model;

/**
 * @author    Moritz Friedrich
 * @package   RecaptchaVerify
 * @since     1.0.0
 */
class Settings extends Model {

    /**
     * @var string
     */
    public $siteKey = '';

    /**
     * @var string
     */
    public $secret = '';
}
