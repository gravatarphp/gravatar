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
 * Provides common functions for UrlBuilder and SingleUrlBuilder
 *
 * @author Márk Sági-Kazár <mark.sagikazar@gmail.com>
 */
abstract class AbstractUrlBuilder
{
    /**
     * Gravatar endpoints
     */
    const HTTP_ENDPOINT = 'http://www.gravatar.com';
    const HTTPS_ENDPOINT = 'https://secure.gravatar.com';

    /**
     * @var boolean
     */
    protected $useHttps;

    /**
     * @param boolean $secure
     */
    public function __construct($useHttps = true)
    {
        $this->useHttps = (bool) $useHttps;
    }

    /**
     * Sets the used connection endpoint
     *
     * @param boolean $useHttps
     */
    public function useHttps($useHttps)
    {
        $this->useHttps = (bool) $useHttps;
    }

    /**
     * Creates a hash from an email address
     *
     * @param string $email
     *
     * @return string
     */
    protected function createEmailHash($email)
    {
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            throw new \InvalidArgumentException('Invalid email address');
        }

        return md5(strtolower(trim($email)));
    }

    /**
     * Builds the URL based on the given parameters
     *
     * @param string  $segment
     * @param array   $params
     */
    protected function buildUrl($segment, array $params = [])
    {
        $endpoint = $this->useHttps ? self::HTTPS_ENDPOINT : self::HTTP_ENDPOINT;
        $params = array_filter($params);

        if (!empty($params)) {
            return sprintf('%s/%s?%s', $endpoint, $segment, http_build_query($params));
        }

        return sprintf('%s/%s', $endpoint, $segment);
    }
}
