<?php

namespace Gravatar;

/**
 * Gravatar URL Builder.
 *
 * @author Márk Sági-Kazár <mark.sagikazar@gmail.com>
 */
final class UrlBuilder
{
    /**
     * Gravatar endpoints.
     */
    const HTTP_ENDPOINT = 'http://www.gravatar.com';
    const HTTPS_ENDPOINT = 'https://secure.gravatar.com';

    /**
     * @var array
     */
    protected $defaults = [];

    /**
     * Whether to use HTTPS endpoint.
     *
     * @var bool
     */
    protected $secure;

    /**
     * @param array $defaults
     * @param bool  $secure
     */
    public function __construct(array $defaults = [], $secure = true)
    {
        $this->defaults = array_filter($defaults);
        $this->secure = (bool) $secure;
    }

    /**
     * Returns an Avatar URL.
     *
     * @param string    $email
     * @param array     $options
     * @param bool|null $secure
     *
     * @return string
     */
    public function avatar($email, array $options = [], $secure = null)
    {
        $url = 'avatar/'.$this->createEmailHash($email);
        $options = array_merge($this->defaults, array_filter($options));

        if (!empty($options)) {
            $url .= '?'.http_build_query($options);
        }

        return $this->buildUrl($url, $secure);
    }

    /**
     * Returns a profile URL.
     *
     * @param string    $email
     * @param bool|null $secure
     *
     * @return string
     */
    public function profile($email, $secure = null)
    {
        return $this->buildUrl($this->createEmailHash($email), $secure);
    }

    /**
     * Returns a vCard URL.
     *
     * @param string    $email
     * @param bool|null $secure
     *
     * @return string
     */
    public function vcard($email, $secure = null)
    {
        return $this->profile($email, $secure).'.vcf';
    }

    /**
     * Returns a QR Code URL.
     *
     * @param string    $email
     * @param bool|null $secure
     *
     * @return string
     */
    public function qrCode($email, $secure = null)
    {
        return $this->profile($email, $secure).'.qr';
    }

    /**
     * Creates a hash from an email address.
     *
     * @param string $email
     *
     * @return string
     */
    private function createEmailHash($email)
    {
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            throw new \InvalidArgumentException('Invalid email address');
        }

        return md5(strtolower(trim($email)));
    }

    /**
     * Builds the URL based on the given parameters.
     *
     * @param string    $resource
     * @param bool|null $secure
     *
     * @return string
     */
    private function buildUrl($resource, $secure = null)
    {
        $secure = isset($secure) ? (bool) $secure : $this->secure;

        $endpoint = $secure ? self::HTTPS_ENDPOINT : self::HTTP_ENDPOINT;

        return sprintf('%s/%s', $endpoint, $resource);
    }
}
