<?php

namespace foodette\extension\dotenv;

use Dotenv\Dotenv;
use \Yii;

class Loader
{
    /**
     * Load .env file from Yii project root directory.
     *
     * @param string $path
     * @param string $file
     * @param bool $overload
     * @return bool
     */
    public static function load($path = '', $file = '.env', $overload = false)
    {
        /*
         * Find Composer base directory.
         */
        if (empty($path)) {
            if (class_exists('Yii', false)) {
                /*
                 * Usually, the env is used before defining these aliases:
                 * @vendor and @app. So, if your vendor is symbolic link,
                 * Please register @vendor alias in bootstrap file or before
                 * call env function.
                 */
                if (Yii::getPathOfAlias('@vendor')) {
                    $vendorDir = Yii::getPathOfAlias('@vendor');
                    $path      = dirname($vendorDir);
                } elseif (Yii::getPathOfAlias('@app')) {
                    $path = Yii::getPathOfAlias('@app');
                } else {
                    $yiiDir = Yii::getPathOfAlias('@yii');
                    $path   = dirname(dirname(dirname($yiiDir)));
                }
            } else {
                if (defined('VENDOR_PATH')) {
                    $vendorDir = VENDOR_PATH;
                } else {
                    /*
                     * If not found Yii class, will use composer vendor directory
                     * structure finding.
                     *
                     * Notice: this method does not handle nor process symbolic link!
                     */
                    $vendorDir = dirname(dirname(dirname(dirname(__FILE__))));
                }
                $path = dirname($vendorDir);
            }
        }
        /*
         * Get env file name from environment variable,
         * if COMPOSER_DOTENV_FILE have been set.
         */
        if (empty($file)) {
            $file = '.env';
        }
        /*
         * This program will not force the file to be loaded,
         * if the file does not exist then return.
         */
        if (!file_exists(rtrim($path, DIRECTORY_SEPARATOR) . DIRECTORY_SEPARATOR . $file)) {
            return false;
        }
        $dotEnv = new DotEnv($path, $file);
        /*
         * Overload or load method by environment variable COMPOSER_DOTENV_OVERLOAD.
         */
        if ($overload) {
            $dotEnv->overload();
        } else {
            $dotEnv->load();
        }
        return true;
    }
}
