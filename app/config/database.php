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
 * @since Version 1
 * @link https://github.com/ronmarasigan/LavaLust
 * @license https://opensource.org/licenses/MIT MIT License
 */

/*
| -------------------------------------------------------------------
| DATABASE CONNECTIVITY SETTINGS
| -------------------------------------------------------------------
| This file will contain the settings needed to access your database.
| -------------------------------------------------------------------
| EXPLANATION OF VARIABLES
| -------------------------------------------------------------------
|
|	['driver'] 		The driver of your database server.
|	['hostname'] 	The hostname of your database server.
|	['port'] 		The port used by your database server.
|	['username'] 	The username used to connect to the database
|	['password'] 	The password used to connect to the database
|	['database'] 	The name of the database you want to connect to
|	['charset']		The default character set
|   ['dbprefix']    You can add an optional prefix, which will be added
|				    to the table name when using the  Query Builder class
|   You can create new instance of the database by adding new element of
|   $database variable.
|   Example: $database['another_example'] = array('key' => 'value')
*/

$ssl_ca = getenv('DB_SSL_CA') ?: '';
$ssl_ca_base64 = getenv('DB_SSL_CA_BASE64') ?: '';
if ($ssl_ca_base64 !== '') {
    $decoded_ca = strpos($ssl_ca_base64, '-----BEGIN CERTIFICATE-----') !== false
        ? $ssl_ca_base64
        : base64_decode($ssl_ca_base64, true);
    if ($decoded_ca !== false) {
        $ssl_ca = sys_get_temp_dir() . DIRECTORY_SEPARATOR . 'lavalust-aiven-ca.pem';
        file_put_contents($ssl_ca, $decoded_ca, LOCK_EX);
    }
}
if ($ssl_ca !== '' && (!is_file($ssl_ca) || @openssl_x509_read((string) file_get_contents($ssl_ca)) === false)) {
    $ssl_ca = '';
}

$database['main'] = array(
    'driver'	=> getenv('DB_DRIVER') ?: '',
    'hostname'	=> getenv('DB_HOST') ?: '',
    'port'		=> getenv('DB_PORT') ?: '',
    'username'	=> getenv('DB_USER') ?: '',
    'password'	=> getenv('DB_PASSWORD') ?: '',
    'database'	=> getenv('DB_NAME') ?: '',
    'charset'	=> getenv('DB_CHARSET') ?: '',
    'dbprefix'	=> getenv('DB_PREFIX') ?: '',
    'ssl_ca'    => $ssl_ca,
    // Optional for SQLite
    'path'      => ''
);

$database['main']['driver'] = getenv('DB_DRIVER') ?: 'mysql';
$database['main']['hostname'] = getenv('DB_HOST') ?: '127.0.0.1';
$database['main']['port'] = getenv('DB_PORT') ?: '3306';
$database['main']['username'] = getenv('DB_USER') ?: 'root';
$database['main']['database'] = getenv('DB_NAME') ?: 'lab5';
$database['main']['charset'] = getenv('DB_CHARSET') ?: 'utf8mb4';

?>