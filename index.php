<?php
/**
 * Organizing of built-in features
 *
 * @package axy\native
 * @author Oleg Grigoriev <go.vasac@gmail.com>
 * @license https://raw.github.com/axypro/native/master/LICENSE MIT
 * @link https://github.com/axypro/native repository
 * @uses PHP5.4+
 */

namespace axy\native;

if (!is_file(__DIR__.'/vendor/autoload.php')) {
    throw new \LogicException('Please: ./composer install');
}

require_once(__DIR__.'/vendor/autoload.php');
