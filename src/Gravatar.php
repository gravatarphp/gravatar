<?php

declare(strict_types=1);

namespace Gravatar;

/**
 * Gravatar URL Builder.
 *
 * @author Márk Sági-Kazár <mark.sagikazar@gmail.com>
 */
final class Gravatar
{
    /**
     * Gravatar endpoints.
     */
    private const HTTP_ENDPOINT = 'http://www.gravatar.com';
    private const HTTPS_ENDPOINT = 'https://secure.gravatar.com';

    /**
     * @var array
     */
    private $defaults = [];

    /**
     * Whether to use HTTPS endpoint.
     *
     * @var bool
     */
    private $secure;

    public function __construct(array $defaults = [], bool $secure = true)
    {
        $this->defaults = array_filter($defaults);
        $this->secure = $secure;
    }

    /**
     * Returns an Avatar URL.
     */
    public function avatar(string $email, array $options = [], bool $secure = null): string
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
     */
    public function profile(string $email, bool $secure = null): string
    {
        return $this->buildUrl($this->createEmailHash($email), $secure);
    }

    /**
     * Returns a vCard URL.
     */
    public function vcard(string $email, bool $secure = null): string
    {
        return $this->profile($email, $secure).'.vcf';
    }

    /**
     * Returns a QR Code URL.
     */
    public function qrCode(string $email, bool $secure = null): string
    {
        return $this->profile($email, $secure).'.qr';
    }

    /**
     * Creates a hash from an email address.
     */
    private function createEmailHash(string $email): string
    {
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            throw new \InvalidArgumentException('Invalid email address');
        }

        return md5(strtolower(trim($email)));
    }

    /**
     * Builds the URL based on the given parameters.
     */
    private function buildUrl(string $resource, ?bool $secure): string
    {
        $secure = isset($secure) ? (bool) $secure : $this->secure;

        $endpoint = $secure ? self::HTTPS_ENDPOINT : self::HTTP_ENDPOINT;

        return sprintf('%s/%s', $endpoint, $resource);
    }
}
