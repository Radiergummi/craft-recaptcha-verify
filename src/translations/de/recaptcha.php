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
    '{name} plugin loaded'                                                                      => '{name} Plugin geladen',
    'No token in request'                                                                       => 'Kein Token in Request enthalten',
    'Secret is not configured. Recaptcha will not be validated without one.'                    => 'Es wurde kein Secret konfiguriert. Recaptcha kann ohne Secret nicht validiert werden.',
    'Verified token {token}'                                                                    => 'Token {token} wurde verifiziert',
    'Recaptcha verification failed: {reasons}. Please check the error code reference at {link}' => 'Recaptcha-Verifizierung ist fehlgeschlagen: {reasons}. Bitte konsultieren Sie die Fehlercodereferenz unter {link}'
];
