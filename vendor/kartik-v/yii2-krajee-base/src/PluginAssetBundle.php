<?php

/**
 * @package   yii2-krajee-base
 * @author    Kartik Visweswaran <kartikv2@gmail.com>
 * @copyright Copyright &copy; Kartik Visweswaran, Krajee.com, 2014 - 2021
 * @version   3.0.1
 */

namespace kartik\base;

/**
 * Base asset bundle for Krajee extensions (including bootstrap plugins)
 *
 * @author Kartik Visweswaran <kartikv2@gmail.com>
 */
class PluginAssetBundle extends AssetBundle
{
    /**
     * @inheritdoc
     */
    public $bsPluginEnabled = true;
}
