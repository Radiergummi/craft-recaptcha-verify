<?php
/**
 * Recaptcha Verify plugin for Craft CMS 3.x
 * Verifies Recaptcha with Google's API
 *
 * @link      https://www.moritzfriedrich.com
 * @copyright Copyright (c) 2017 Moritz Friedrich
 */

/**
 * @author    Moritz Friedrich
 * @package   RecaptchaVerify
 * @since     1.0.0
 */
return [
    '{name} plugin loaded'                                                                      => '{name} plugin loaded',
    'No token in request'                                                                       => 'No token in request',
    'Secret is not configured. Recaptcha will not be validated without one.'                    => 'Secret is not configured. Recaptcha will not be validated without one.',
    'Verified token {token}'                                                                    => 'Verified token {token}',
    'Recaptcha verification failed: {reasons}. Please check the error code reference at {link}' => 'Recaptcha verification failed: {reasons}. Please check the error code reference at {link}'
];
