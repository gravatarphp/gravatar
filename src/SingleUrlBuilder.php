<?php

namespace Gravatar;

/**
 * Builds URLs for a single hash.
 *
 * @author Márk Sági-Kazár <mark.sagikazar@gmail.com>
 */
class SingleUrlBuilder extends BaseUrlBuilder
{
    /**
     * @var string
     */
    protected $emailHash;

    /**
     * @param string $email
     * @param bool   $secure
     */
    public function __construct($email, $secure = true)
    {
        $this->emailHash = $this->createEmailHash($email);

        parent::__construct($secure);
    }

    /**
     * Returns an Avatar URL.
     *
     * @param array     $options
     * @param bool|null $secure
     *
     * @return string
     */
    public function avatar(array $options = [], $secure = null)
    {
        return $this->buildUrl('avatar/'.$this->emailHash, $options, $secure);
    }

    /**
     * Returns a profile URL.
     *
     * @param bool|null $secure
     *
     * @return string
     */
    public function profile($secure = null)
    {
        return $this->buildUrl($this->emailHash, [], $secure);
    }

    /**
     * Returns a vCard URL.
     *
     * @param bool|null $secure
     *
     * @return string
     */
    public function vcard($secure = null)
    {
        return $this->profile($secure).'.vcf';
    }

    /**
     * Returns a QR Code URL.
     *
     * @param bool|null $secure
     *
     * @return string
     */
    public function qrCode($secure = null)
    {
        return $this->profile($secure).'.qr';
    }
}
