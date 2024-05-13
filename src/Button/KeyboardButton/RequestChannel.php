<?php declare(strict_types=1);

/**
 * This file is part of Reymon.
 * Reymon is free software: you can redistribute it and/or modify it under the terms of the GNU General Public License as published by the Free Software Foundation, either version 3 of the License, or (at your option) any later version.
 * Reymon is distributed in the hope that it will be useful, but WITHOUT ANY WARRANTY; without even the implied warranty of MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.
 * See the GNU General Public License for more details.
 * If not, see <http://www.gnu.org/licenses/>.
 *
 * @author    AhJ <AmirHosseinJafari8228@gmail.com>
 * @copyright Copyright (c) 2023, ReymonTg
 * @license   https://choosealicense.com/licenses/gpl-3.0/ GPLv3
 */

namespace Reymon\EasyKeyboard\Button\KeyboardButton;

use Reymon\EasyKeyboard\Tools\ChatAdminRights;

/**
 * Represents button the criteria used to request a suitable channel. The identifier of the selected channel will be shared with the bot when the corresponding button is pressed.
 */
final readonly class RequestChannel extends RequestPeer
{
    /**
     * @param string           $text            Label text on the button
     * @param int              $buttonId        Signed 32-bit identifier of the request
     * @param ?bool            $creator         Whether to request a chat owned by the user.
     * @param ?bool            $hasUsername     Whether to request a supergroup or a channel with (or without) a username. If not specified, no additional restrictions are applied.
     * @param ?bool            $member          Whether to request a chat with the bot as a member. Otherwise, no additional restrictions are applied.
     * @param bool             $title           Whether to request the chat's title
     * @param bool             $username        Whether to request the chat's username
     * @param bool             $photo           Whether to request the chat's photo
     * @param ?ChatAdminRights $userAdminRights The required administrator rights of the user in the chat. If not specified, no additional restrictions are applied.
     * @param ?ChatAdminRights $botAdminRights  The required administrator rights of the bot in the chat. If not specified, no additional restrictions are applied.
     */
    public function __construct(string $text, $buttonId, public ?bool $creator = null, public ?bool $hasUsername = null, public ?bool $member = null, public bool $title = false, public bool $username = false, public bool $photo = false, public ?ChatAdminRights $userAdminRights = null, public ?ChatAdminRights $botAdminRights = null)
    {
        parent::__construct($text, $buttonId);
    }

    /**
     * Create button the criteria used to request a suitable channel. The identifier of the selected channel will be shared with the bot when the corresponding button is pressed.
     *
     * @param string           $text            Label text on the button
     * @param int              $buttonId        Signed 32-bit identifier of the request
     * @param ?bool            $creator         Whether to request a chat owned by the user.
     * @param ?bool            $hasUsername     Whether to request a supergroup or a channel with (or without) a username. If not specified, no additional restrictions are applied.
     * @param ?bool            $member          Whether to request a chat with the bot as a member. Otherwise, no additional restrictions are applied.
     * @param bool             $title           Whether to request the chat's title
     * @param bool             $username        Whether to request the chat's username
     * @param bool             $photo           Whether to request the chat's photo
     * @param ?ChatAdminRights $userAdminRights The required administrator rights of the user in the chat. If not specified, no additional restrictions are applied.
     * @param ?ChatAdminRights $botAdminRights  The required administrator rights of the bot in the chat. If not specified, no additional restrictions are applied.
     */
    public static function new(string $text, $buttonId, ?bool $creator = null, ?bool $hasUsername = null, ?bool $member = null, bool $title = false, bool $username = false, bool $photo = false, ?ChatAdminRights $userAdminRights = null, ?ChatAdminRights $botAdminRights = null): self
    {
        return new static($text, $buttonId, $creator, $hasUsername, $member, $title, $username, $photo, $userAdminRights, $botAdminRights);
    }

    /**
     * @internal
     */
    public function jsonSerialize(): array
    {
        return [
            'text' => $this->text,
            'request_chat' => array_filter_null([
                'chat_is_channel'   => true,
                'request_id'        => $this->buttonId,
                'chat_has_username' => $this->hasUsername,
                'chat_is_created'   => $this->creator,
                'bot_is_member'     => $this->member,
                'request_title'     => $this->title,
                'request_username'  => $this->username,
                'request_photo'     => $this->photo,
                'user_admin_rights' => $this->userAdminRights,
                'bot_admin_rights'  => $this->botAdminRights,
            ])
        ];
    }
}
