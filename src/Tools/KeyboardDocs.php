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

namespace Reymon\EasyKeyboard\Tools;

use Reymon\EasyKeyboard\KeyboardTypes\{KeyboardForceReply, KeyboardMarkup};

interface KeyboardDocs
{

    /**
     * Make current keyboard to be just used once
     *
     * @param bool $singleUse
     * @return KeyboardMarkup|KeyboardForceReply
     */
    public function singleUse(bool $singleUse = true): KeyboardMarkup|KeyboardForceReply;

    /**
     * Make current keyboard size smaller
     *
     * @param bool $resize
     * @return KeyboardMarkup|KeyboardForceReply
     */
    public function resize(bool $resize = true): KeyboardMarkup|KeyboardForceReply;

    /**
     * Make current keyboard selective
     *
     * @param bool $selective
     * @return KeyboardMarkup|KeyboardForceReply
     */
    public function selective(bool $selective = true): KeyboardMarkup|KeyboardForceReply;

    /**
     * Create placeholder for current keyboard it can be also empty string
     *
     * @param string|null $placeholder
     * @return KeyboardMarkup|KeyboardForceReply
     */
    public function placeholder(?string $placeholder = null): KeyboardMarkup|KeyboardForceReply;


}