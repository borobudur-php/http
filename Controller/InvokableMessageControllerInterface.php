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

namespace Borobudur\Component\Http\Controller;

use Borobudur\Component\Http\ResponseInterface;
use Borobudur\Component\Messaging\Message\MessageInterface;
use Borobudur\Component\Messaging\Request\ConfigurationInterface;

/**
 * @author  Iqbal Maulana <iq.bluejack@gmail.com>
 */
interface InvokableMessageControllerInterface
{
    /**
     * Dispatch a message in controller.
     *
     * @param MessageInterface       $message
     * @param ConfigurationInterface $requestConfiguration
     *
     * @return ResponseInterface
     */
    public function __invoke(MessageInterface $message, ConfigurationInterface $requestConfiguration): ResponseInterface;
}
