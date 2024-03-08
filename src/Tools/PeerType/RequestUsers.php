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

namespace Reymon\EasyKeyboard\Tools\PeerType;

/**
 * Create button the criteria used to request suitable users. The identifiers of the selected users will be shared with the bot when the corresponding button is pressed.
 */
class RequestUsers extends RequestPeer
{
    /**
     * @param ?bool $bot     Whether to request bots or users, If not specified, no additional restrictions are applied.
     * @param ?bool $premium Whether to request premium or non-premium users. If not specified, no additional restrictions are applied.
     * @param int   $max     The maximum number of users to be selected; 1-10.
     */
    public static function new(?bool $bot = null, ?bool $premium = null, int $max = 1): self
    {
        $data = [
            'user_is_bot'     => $bot,
            'user_is_premium' => $premium,
            'max_quantity'    => $max
        ];
        return new static($data);
    }
}
