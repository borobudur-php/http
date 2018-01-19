<?php
/**
 * This file is part of the Borobudur package.
 *
 * (c) 2017 Borobudur <http://borobudur.io>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

declare(strict_types=1);

namespace Borobudur\Component\Http;

use Zend\Diactoros\ServerRequest as ZendRequest;

/**
 * @author  Iqbal Maulana <iq.bluejack@gmail.com>
 */
class Request extends ZendRequest implements RequestInterface
{
    /**
     * @var string
     */
    protected $format;

    /**
     * @param string $format
     */
    public function setRequestFormat(string $format): void
    {
        $this->format = $format;
    }

    /**
     * {@inheritdoc}
     */
    public function getRequestFormat($default = 'html'): string
    {
        if (null === $this->format) {
            $this->format = $this->getAttribute('_format');
        }

        return null === $this->format ? $default : $this->format;
    }

    /**
     * {@inheritdoc}
     */
    public function getQueryParam(string $key, $default = null)
    {
        $params = $this->getQueryParams();

        return $this->has($key) ? $params[$key] : $default;
    }

    /**
     * {@inheritdoc}
     */
    public function hasQueryParam(string $key): bool
    {
        return array_key_exists($key, $this->getQueryParams());
    }

    /**
     * {@inheritdoc}
     */
    public function get(string $key, $default = null)
    {
        if ($this !== $result = $this->getAttribute($key, $this)) {
            return $result;
        }

        if ($this !== $result = $this->getQueryParam($key, $this)) {
            return $result;
        }

        if ($this !== $result = $this->getBodyData($key, $this)) {
            return $result;
        }

        return $default;
    }

    /**
     * {@inheritdoc}
     */
    public function has(string $key): bool
    {
        return $this !== $this->get($key, $this);
    }

    /**
     * Gets parsed body data with specified key.
     *
     * @param string $key
     * @param mixed  $default
     *
     * @return mixed
     */
    private function getBodyData(string $key, $default = null)
    {
        $body = $this->getParsedBody();

        if (is_array($body)) {
            return array_key_exists($key, $body) ? $body[$key] : $default;
        }

        if (is_object($body)) {
            return property_exists($body, $key) ? $body->{$key} : $default;
        }

        return $default;
    }
}
