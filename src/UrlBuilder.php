<?php

namespace Gravatar;

/**
 * Gravatar URL Builder.
 *
 * @author Márk Sági-Kazár <mark.sagikazar@gmail.com>
 */
class UrlBuilder extends BaseUrlBuilder
{
    /**
     * Returns an Avatar URL.
     *
     * @param string $email
     * @param array  $options
     *
     * @return string
     */
    public function avatar($email, array $options = [])
    {
        return $this->buildUrl('avatar/'.$this->createEmailHash($email), $options);
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
        return $this->buildUrl($this->createEmailHash($email), compact('secure'));
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
     * @param string $email
     * @param bool|null $secure
     *
     * @return string
     */
    public function qrCode($email, $secure = null)
    {
        return $this->profile($email, $secure).'.qr';
    }
}
