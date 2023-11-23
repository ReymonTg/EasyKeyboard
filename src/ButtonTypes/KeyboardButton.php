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
use Reymon\EasyKeyboard\Tools\PollType;
use Reymon\EasyKeyboard\Tools\PeerType\RequestPeerType;
use Reymon\EasyKeyboard\Tools\PeerType\RequestPeerTypeUser;

final class KeyboardButton extends Button
{

    /**
     * @param string $text
     * @param int $userId
     * @return KeyboardButton
     */
    public static function Profile(string $text, int $userId): KeyboardButton
    {
        $data = [
            'text' => $text,
            'url' => "tg://user?id=$userId",
        ];
        return new static($data);
    }

    /**
     * Create text button that request poll from user
     *
     * @param string $text
     * @param PollType $type
     * @return KeyboardButton
     */
    public static function Poll(string $text, PollType $type = PollType::ALL): KeyboardButton
    {
        $data = [
            'text'         => $text,
            'request_poll' => $type,
        ];
        return new static($data);
    }

    /**
     * Create text button that request location from user
     *
     * @param string $text
     * @return KeyboardButton
     */
    public static function Location(string $text): KeyboardButton
    {
        $data = [
            'text'             => $text,
            'request_location' => true,
        ];
        return new static($data);
    }

    /**
     * Create text button that request contact info from user
     *
     * @param string $text
     * @return KeyboardButton
     */
    public static function Phone(string $text): KeyboardButton
    {
        $data = [
            'text'            => $text,
            'request_contact' => true,
        ];
        return new static($data);
    }

    /**
     * create simple text keyboard
     *
     * @param string $text
     * @return KeyboardButton
     */
    public static function Text(string $text): KeyboardButton
    {
        $data = [
            'text' => $text
        ];
        return new static($data);
    }

    /**
     * Create text button that open web app without requiring user information
     *
     * @param string $text
     * @param string $url
     * @return KeyboardButton
     */
    public static function WebApp(string $text, string $url): KeyboardButton
    {
        $data = [
            'text'    => $text,
            'web_app' => [
                'url' => $url
            ],
        ];
        return new static($data);
    }

    /**
     * Create a request peer button
     *
     * @param string $text
     * @param int $buttonId
     * @param RequestPeerType $type
     * @return KeyboardButton
     */
    public static function Peer(string $text, int $buttonId, RequestPeerType $type): KeyboardButton
    {
        $peer = $type instanceof RequestPeerTypeUser ? 'request_user' : 'request_chat';
        $data = [
            '_'    => 'keyboardButtonRequestPeer',
            'text' => $text,
            $peer  => [ 'request_id' => $buttonId, ...$type->jsonSerialize()]
        ];
        return new static($data);
    }
}