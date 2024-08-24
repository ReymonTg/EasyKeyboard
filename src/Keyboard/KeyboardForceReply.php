<?php declare(strict_types=1);

/**
 * This file is part of Reymon.
 * Reymon is free software: you can redistribute it and/or modify it under the terms of the GNU General Public License as published by the Free Software Foundation, either version 3 of the License, or (at your option) any later version.
 * Reymon is distributed in the hope that it will be useful, but WITHOUT ANY WARRANTY; without even the implied warranty of MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.
 * See the GNU General Public License for more details.
 * If not, see <http://www.gnu.org/licenses/>.
 *
 * @author    Mahdi <mahdi.talaee1379@gmail.com>
 * @author    AhJ <AmirHosseinJafari8228@gmail.com>
 * @copyright Copyright (c) 2023, ReymonTg
 * @license   https://choosealicense.com/licenses/gpl-3.0/ GPLv3
 */

namespace Reymon\EasyKeyboard\Keyboard;

use Reymon\EasyKeyboard\Button;
use Reymon\EasyKeyboard\Keyboard;
use Reymon\EasyKeyboard\Exception;
use Reymon\EasyKeyboard\Utils\Selective;
use Reymon\EasyKeyboard\Utils\Placeholder;

/**
 * Shows reply interface to the user, as if they manually selected the bot's message and tapped 'Reply'.
 */
final class KeyboardForceReply extends Keyboard
{
    use Selective, Placeholder;

    public function __construct()
    {
        $this->option['force_reply'] = true;
    }

    public function addButton(Button ...$buttons): Keyboard
    {
        throw new Exception(\sprintf('%s cannot use %s', __CLASS__, __METHOD__));
    }

    /**
     * @internal
     */
    public function getIterator(): \EmptyIterator
    {
        return new \EmptyIterator;
    }
}
