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

namespace Reymon\EasyKeyboard\ButtonTypes;

use Reymon\EasyKeyboard\Button;
use Reymon\EasyKeyboard\Tools\ChatAdminRights;
use Reymon\EasyKeyboard\Tools\PollType;

final class KeyboardButton extends Button
{
    public static function Profile(string $text, int $userId): KeyboardButton
    {
        $data = [
            'text' => $text,
            'url' => "tg://user?id=$userId",
        ];
        return new KeyboardButton($data);
    }

    /**
     * Create text button that request poll from user.
     *
     * @param string   $text Label text on the button
     */
    public static function Poll(string $text, PollType $type = PollType::ALL): KeyboardButton
    {
        $data = [
            'text'         => $text,
            'request_poll' => $type,
        ];
        return new KeyboardButton($data);
    }

    /**
     * Create text button that request location from user.
     *
     * @param string $text Label text on the button
     */
    public static function Location(string $text): KeyboardButton
    {
        $data = [
            'text'             => $text,
            'request_location' => true,
        ];
        return new KeyboardButton($data);
    }

    /**
     * Create text button that request contact info from user.
     *
     * @param string $text Label text on the button
     */
    public static function Phone(string $text): KeyboardButton
    {
        $data = [
            'text'            => $text,
            'request_contact' => true,
        ];
        return new KeyboardButton($data);
    }

    /**
     * create simple text keyboard.
     *
     * @param string $text Label text on the button
     */
    public static function Text(string $text): KeyboardButton
    {
        $data = [
            'text' => $text
        ];
        return new KeyboardButton($data);
    }

    /**
     * Create text button that open web app without requiring user information.
     *
     * @param string $text Label text on the button
     * @param string $url  An HTTPS URL of a Web App to be opened with additional data as specified in [Initializing Web Apps](https://core.telegram.org/bots/webapps#initializing-mini-apps)
     */
    public static function WebApp(string $text, string $url): KeyboardButton
    {
        $data = [
            'text'    => $text,
            'web_app' => [
                'url' => $url
            ],
        ];
        return new KeyboardButton($data);
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
    public static function PeerChannel(string $text, int $buttonId, ?bool $creator = null, ?bool $hasUsername = null, ?bool $member = null, bool $title = false, bool $username = false, bool $photo = false, ?ChatAdminRights $userAdminRights = null, ?ChatAdminRights $botAdminRights = null): KeyboardButton
    {
        $data = [
            'text'         => $text,
            'request_chat' => \array_filter([
                'chat_is_channel'   => true,
                'request_id'        => $buttonId,
                'chat_has_username' => $hasUsername,
                'chat_is_created'   => $creator,
                'bot_is_member'     => $member,
                'request_title'     => $title,
                'request_username'  => $username,
                'request_photo'     => $photo,
                'user_admin_rights' => $userAdminRights,
                'bot_admin_rights'  => $botAdminRights,
            ], fn ($v) => !\is_null($v))
        ];
        return new KeyboardButton($data);
    }

    /**
     * Create button the criteria used to request a suitable group/supergroup. The identifier of the selected chat will be shared with the bot when the corresponding button is pressed.
     *
     * @param string           $text            Label text on the button
     * @param int              $buttonId        Signed 32-bit identifier of the request
     * @param ?bool            $creator         Whether to request a chat owned by the user.
     * @param ?bool            $hasUsername     Whether to request a supergroup or a channel with (or without) a username. If not specified, no additional restrictions are applied.
     * @param ?bool            $forum           Whether to request a forum (or non-forum) supergroup.
     * @param ?bool            $member          Whether to request a chat with the bot as a member. Otherwise, no additional restrictions are applied.
     * @param bool             $title           Whether to request the chat's title
     * @param bool             $username        Whether to request the chat's username
     * @param bool             $photo           Whether to request the chat's photo
     * @param ?ChatAdminRights $userAdminRights The required administrator rights of the user in the chat. If not specified, no additional restrictions are applied.
     * @param ?ChatAdminRights $botAdminRights  The required administrator rights of the bot in the chat. If not specified, no additional restrictions are applied.
     */
    public static function PeerGroup(string $text, int $buttonId, ?bool $creator = null, ?bool $hasUsername = null, ?bool $forum = null, ?bool $member = null, bool $title = false, bool $username = false, bool $photo = false, ?ChatAdminRights $userAdminRights = null, ?ChatAdminRights $botAdminRights = null): KeyboardButton
    {
        $data = [
            'text'         => $text,
            'request_chat' => \array_filter([
                'chat_is_channel'   => false,
                'request_id'        => $buttonId,
                'chat_is_forum'     => $forum,
                'chat_has_username' => $hasUsername,
                'chat_is_created'   => $creator,
                'bot_is_member'     => $member,
                'request_title'     => $title,
                'request_username'  => $username,
                'request_photo'     => $photo,
                'user_admin_rights' => $userAdminRights,
                'bot_admin_rights'  => $botAdminRights
            ], fn ($v) => !\is_null($v))
        ];
        return new KeyboardButton($data);
    }

    /**
     * Create button the criteria used to request suitable users. The identifiers of the selected users will be shared with the bot when the corresponding button is pressed.
     *
     * @param string  $text     Label text on the button
     * @param int     $buttonId Signed 32-bit identifier of the request
     * @param ?bool   $bot      Whether to request bots or users, If not specified, no additional restrictions are applied.
     * @param ?bool   $premium  Whether to request premium or non-premium users. If not specified, no additional restrictions are applied.
     * @param bool    $name     Whether to request the users' first and last name
     * @param bool    $username Whether to request the users' username
     * @param bool    $photo    Whether to request the users' photo
     * @param int     $max      The maximum number of users to be selected; 1-10.
     */
    public static function PeerUsers(string $text, int $buttonId, ?bool $bot = null, ?bool $premium = null, bool $name = false, bool $username = false, bool $photo = false, int $max = 1): KeyboardButton
    {
        $data = [
            'text'         => $text,
            'request_users' => \array_filter([
                'request_id' => $buttonId,
                'user_is_bot'      => $bot,
                'user_is_premium'  => $premium,
                'request_name'     => $name,
                'request_username' => $username,
                'request_photo'    => $photo,
                'max_quantity'     => $max,
            ], fn ($v) => !\is_null($v))
        ];
        return new KeyboardButton($data);
    }
}
