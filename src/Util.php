<?php

/*
 * This file is part of the Gravatar package.
 *
 * (c) Márk Sági-Kazár <mark.sagikazar@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Gravatar;

/**
 * Provides helper for procedural functions
 *
 * @author Márk Sági-Kazár <mark.sagikazar@gmail.com>
 */
class Util
{
    /**
     * @var UrlBuilder
     */
    protected static $urlBuilder;

    /**
     * Returns an UrlBuilder instance
     *
     * @return UrlBuilder
     */
    protected static function getUrlBuilder()
    {
        if (!isset(static::$urlBuilder)) {
            static::$urlBuilder = new UrlBuilder;
        }

        return static::$urlBuilder;
    }

    /**
     * Sets the used connection endpoint
     *
     * @param boolean $useHttps
     */
    public static function useHttps($useHttps)
    {
        static::getUrlBuilder()->useHttps($useHttps);
    }

    /**
     * Returns an Avatar URL
     *
     * @param string $email
     * @param array  $options
     *
     * @return string
     */
    public static function avatar($email, array $options = [])
    {
        return static::getUrlBuilder()->avatar($email, $options);
    }

    /**
     * Returns a profile URL
     *
     * @param string $email
     *
     * @return string
     */
    public static function profile($email)
    {
        return static::getUrlBuilder()->profile($email);
    }

    /**
     * Returns a vCard URL
     *
     * @param string $email
     *
     * @return string
     */
    public static function vcard($email)
    {
        return static::getUrlBuilder()->vcard($email);
    }

    /**
     * Returns a QR Code URL
     *
     * @param string $email
     *
     * @return string
     */
    public static function qrCode($email)
    {
        return static::getUrlBuilder()->qrCode($email);
    }
}
