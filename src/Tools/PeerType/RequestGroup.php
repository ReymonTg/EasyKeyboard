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

use Reymon\EasyKeyboard\Tools\ChatAdminRights;

/**
 * Create button the criteria used to request a suitable group/supergroup. The identifier of the selected chat will be shared with the bot when the corresponding button is pressed.
 */
class RequestGroup extends RequestPeer
{
    /**
     * @param bool|null            $creator  Whether to request a chat owned by the user.
     * @param bool|null            $username       Whether to request a supergroup or a channel with (or without) a username. If not specified, no additional restrictions are applied.
     * @param bool|null            $forum           Whether to request a forum (or non-forum) supergroup.
     * @param bool|null            $member          Whether to request a chat with the bot as a member. Otherwise, no additional restrictions are applied.
     * @param ChatAdminRights|null $userAdminRights The required administrator rights of the user in the chat. If not specified, no additional restrictions are applied.
     * @param ChatAdminRights|null $botAdminRights  The required administrator rights of the bot in the chat. If not specified, no additional restrictions are applied.
     */
    public static function new(
        ?bool            $creator         = null,
        ?bool            $username        = null,
        ?bool            $forum           = null,
        ?bool            $member          = null,
        ?ChatAdminRights $userAdminRights = null,
        ?ChatAdminRights $botAdminRights  = null
    ): self
    {
        $data = [
            'chat_is_channel'   => false,
            'chat_is_forum'     => $forum,
            'chat_has_username' => $username,
            'chat_is_created'   => $creator,
            'bot_is_member'     => $member,
            'user_admin_rights' => \is_callable($userAdminRights) ? $userAdminRights(): null,
            'bot_admin_rights'  => \is_callable($botAdminRights)  ? $botAdminRights() : null
        ];
        return new static($data);
    }
}
