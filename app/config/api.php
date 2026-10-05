<?php
defined('PREVENT_DIRECT_ACCESS') OR exit('No direct script access allowed');
/**
 * ------------------------------------------------------------------
 * LavaLust - an opensource lightweight PHP MVC Framework
 * ------------------------------------------------------------------
 *
 * MIT License
 *
 * Copyright (c) 2020 Ronald M. Marasigan
 *
 * Permission is hereby granted, free of charge, to any person obtaining a copy
 * of this software and associated documentation files (the "Software"), to deal
 * in the Software without restriction, including without limitation the rights
 * to use, copy, modify, merge, publish, distribute, sublicense, and/or sell
 * copies of the Software, and to permit persons to whom the Software is
 * furnished to do so, subject to the following conditions:
 *
 * The above copyright notice and this permission notice shall be included in
 * all copies or substantial portions of the Software.
 *
 * THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR
 * IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY,
 * FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE
 * AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER
 * LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM,
 * OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN
 * THE SOFTWARE.
 *
 * @package LavaLust
 * @author Ronald M. Marasigan <ronald.marasigan@yahoo.com>
 * @since Version 4
 * @link https://github.com/ronmarasigan/LavaLust
 * @license https://opensource.org/licenses/MIT MIT License
 */

/*
|--------------------------------------------------------------------------
| Enable/Disable Migrations
|--------------------------------------------------------------------------
|
| Migrations are disabled by default for security reasons.
| You should enable migrations whenever you intend to do a schema migration
| and disable it back when you're done.
|
*/
$config['api_helper_enabled'] = TRUE;

/*
|--------------------------------------------------------------------------
| Payload Token Expiration
|--------------------------------------------------------------------------
|
| Used for Payload Token Expiration
|
*/
$config['payload_token_expiration'] = (int) (getenv('ACCESS_TOKEN_TTL') ?: 900);


/*
|--------------------------------------------------------------------------
| Refresh Token Expiration
|--------------------------------------------------------------------------
|
| Used for Refresh Token Expiration
|
*/
$config['refresh_token_expiration'] = 604800;

/*
|--------------------------------------------------------------------------
| JWT Secret Token
|--------------------------------------------------------------------------
|
| Used for Securing endpoint
|
*/
$jwtSecretFile = getenv('JWT_SECRET_FILE') ?: '/etc/secrets/jwt-secret';
if (!is_readable($jwtSecretFile) && defined('ROOT_DIR') && is_readable(ROOT_DIR . 'jwt-secret')) {
	$jwtSecretFile = ROOT_DIR . 'jwt-secret';
}
$config['jwt_secret'] = getenv('JWT_SECRET') ?: trim((string) @file_get_contents($jwtSecretFile));

/*
|--------------------------------------------------------------------------
| Refresh Token
|--------------------------------------------------------------------------
|
| Used for Securing endpoint
|
*/
$refreshTokenKeyFile = getenv('REFRESH_TOKEN_KEY_FILE') ?: '/etc/secrets/refresh-token-key';
if (!is_readable($refreshTokenKeyFile) && defined('ROOT_DIR') && is_readable(ROOT_DIR . 'refresh-token-key')) {
	$refreshTokenKeyFile = ROOT_DIR . 'refresh-token-key';
}
$config['refresh_token_key'] = getenv('REFRESH_TOKEN_KEY') ?: trim((string) @file_get_contents($refreshTokenKeyFile));

error_log('Lab6 API secret diagnostics: jwt_length=' . strlen((string) $config['jwt_secret']) . ', refresh_length=' . strlen((string) $config['refresh_token_key']) . ', jwt_file=' . (is_readable($jwtSecretFile) ? 'readable' : 'missing') . ', refresh_file=' . (is_readable($refreshTokenKeyFile) ? 'readable' : 'missing'));

/*
|--------------------------------------------------------------------------
| Access-Control-Allow-Origin
|--------------------------------------------------------------------------
|
| Access-Control-Allow-Origin - change this to your domain if
| already deployed.
|
*/
$config['allow_origin'] = getenv('FRONTEND_ORIGIN') ?: 'http://localhost:5173';

$config['jwt_issuer'] = getenv('JWT_ISSUER') ?: 'product-api';
$config['jwt_audience'] = getenv('JWT_AUDIENCE') ?: 'product-frontend';

/*
|--------------------------------------------------------------------------
| Refresh Token Table
|--------------------------------------------------------------------------
|
| This is the name of the table that will store the Refresh Token.
|
*/
$config['refresh_token_table'] = 'refresh_tokens';
