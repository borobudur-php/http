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

use Psr\Http\Message\ServerRequestInterface;

/**
 * @author  Iqbal Maulana <iq.bluejack@gmail.com>
 */
interface RequestInterface extends ServerRequestInterface
{
    /**
     * @param string $format
     */
    public function setRequestFormat(string $format): void;

    /**
     * Gets the request format.
     *
     * @param string $default
     *
     * @return string
     */
    public function getRequestFormat($default = 'html'): string;

    /**
     * Gets the query parameter with specified key.
     *
     * @param string $key
     * @param mixed  $default
     *
     * @return mixed
     */
    public function getQueryParam(string $key, $default = null);

    /**
     * Gets the "parameter" value from any.
     *
     * @param string $key
     * @param mixed  $default
     *
     * @return mixed
     */
    public function get(string $key, $default = null);
}
