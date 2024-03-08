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
use Reymon\EasyKeyboard\Tools\InlineChoosePeer;

final class InlineButton extends Button
{
    /**
     * Create Inline button with SwitchInline options.
     *
     * @param string            $text   Label text on the button
     * @param string            $query  Data to be sent in a [callback query](https://core.telegram.org/bots/api#callbackquery) to the bot when button is pressed, 1-64 bytes
     * @param bool              $same   Pressing the button will insert the bot's username and the specified inline query in the current chat's input field
     * @param ?InlineChoosePeer $filter Filter to use when selecting chats.
     */
    public static function SwitchInline(string $text, string $query, bool $same = false, ?InlineChoosePeer $filter = null): InlineButton
    {
        $data = match (true) {
            !\is_null($filter) => ['switch_inline_query_chosen_chat'  => [...$filter->jsonSerialize(), 'query' => $query]],
            $same   => ['switch_inline_query_current_chat' => $query],
            default => ['switch_inline_query' => $query]
        };
        $data += ['text' => $text];
        return new static($data);
    }

    /**
     * Create Inline webapp button.
     *
     * @param string $text Label text on the button
     * @param string $url  An HTTPS URL of a Web App to be opened with additional data as specified in [Initializing Web Apps](https://core.telegram.org/bots/webapps#initializing-mini-apps)
     */
    public static function WebApp(string $text, string $url): InlineButton
    {
        $data = [
            'text'    => $text,
            'web_app' => [
                'url' => $url
            ]
        ];
        return new static($data);
    }

    /**
     * Create inline button for login.
     *
     * @param string  $text        Label text on the button
     * @param string  $url         An HTTPS URL used to automatically authorize the user
     * @param ?string $fwdText     New text of the button in forwarded messages
     * @param ?string $username    Username of a bot, which will be used for user authorization.
     * @param bool    $writeAccess Whether to request the permission for your bot to send messages to the user
     */
    public static function Login(string $text, string $url, ?string $fwdText = null, ?string $username = null, bool $writeAccess = false): InlineButton
    {
        $data = [
            'login_url' => [
                'url'                  => $url,
                'forward_text'         => $fwdText,
                'bot_username'         => $username,
                'request_write_access' => $writeAccess,
            ],
            'text' => $text,
        ];
        $data['login_url'] = \array_filter($data['login_url'], fn ($v) => !\is_null($v));
        return new static($data);
    }

    /**
     * Create inline button with callback data.
     *
     * @param string $text     Label text on the button
     * @param string $callback Data to be sent in a callback query to the bot when button is pressed, 1-64 bytes
     */
    public static function CallBack(string $text, string $callback): InlineButton
    {
        $data = [
            'text'          => $text,
            'callback_data' => $callback,
        ];
        return new static($data);
    }

    /**
     * Create Inline button with url.
     *
     * @param string $text Label text on the button
     * @param string $url  HTTP or tg:// URL to be opened when the button is pressed. Links `tg://user?id=<user_id>` can be used to mention a user by their ID without using a username, if this is allowed by their privacy settings.
     */
    public static function Url(string $text, string $url): InlineButton
    {
        $data = [
            'text' => $text,
            'url'  => $url,
        ];
        return new static($data);
    }

    /**
     * Create game button for your inline game.
     *
     * @param string $text Label text on the button
     */
    public static function Game(string $text): InlineButton
    {
        $data = [
            'text' => $text,
            'callback_game' => '',
        ];
        return new static($data);
    }

    /**
     * Create a buy button for your inline buy request(similar to webapps).
     *
     * @param string $text Label text on the button
     */
    public static function Buy(string $text): InlineButton
    {
        $data = [
            'text' => $text,
            'pay'  => true,
        ];
        return new static($data);
    }
}
