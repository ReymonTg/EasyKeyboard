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

use Reymon\EasyKeyboard\ChatAdminRights;

class RequestPeerTypeChannel extends RequestPeerType
{
    public static function new(
        ?bool            $creator         = null,
        ?bool            $hasUsername     = null,
        ?bool            $botMember       = null,
        ?ChatAdminRights $userAdminRights = null,
        ?ChatAdminRights $botAdminRights  = null
    ): self
    {
        $data = [
            'chat_is_channel'   => true,
            'chat_has_username' => $hasUsername,
            'chat_is_created'   => $creator,
            'bot_is_member'     => $botMember,
            'user_admin_rights' => is_callable($userAdminRights) ? $userAdminRights(): null,
            'bot_admin_rights'  => is_callable($botAdminRights)  ? $botAdminRights() : null
        ];
        return new static($data);
    }
}