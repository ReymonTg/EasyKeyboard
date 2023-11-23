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
     * Create Inline button with SwitchInline options
     *
     * @param string $text
     * @param string $query
     * @param bool $same
     * @param ?InlineChoosePeer $filter
     */
    public static function SwitchInline(string $text, string $query, bool $same = true, ?InlineChoosePeer $filter = null): InlineButton
    {
        $data = match (true)
        {
            $same   => ['switch_inline_query_current_chat' => $query],
            $filter => ['switch_inline_query_chosen_chat'  => [...$filter->jsonSerialize(), 'query' => $query]],
            default => ['switch_inline_query' => $query]
        };
        $data += ['text' => $text];
        return new static($data);
    }

    /**
     * Create Inline webapp button
     *
     * @param string $text
     * @param string $url
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
     * Create inline button for login
     * @param string $text
     * @param string $url
     * @param ?string $fwdText
     * @param ?string $username
     * @param bool $writeAccess
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
        $data['login_url'] = array_filter($data['login_url'], fn($v) => !is_null($v));
        return new static($data);
    }

    /**
     * Create inline button with callback data
     *
     * @param string $text
     * @param string $callback
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
     * Create Inline button with url
     *
     * @param string $text
     * @param string $url
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
     * Create game button for your inline game
     *
     * @param string $text
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
     * Create a buy button for your inline buy request(similar to webapps)
     *
     * @param string $text
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