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

use Reymon\EasyKeyboard\ButtonTypes\KeyboardButton;
use Reymon\EasyKeyboard\ChatAdminRights;
use Reymon\EasyKeyboard\KeyboardTypes\KeyboardMarkup;
use Reymon\EasyKeyboard\Tools\PeerType\RequestPeerTypeChannel;
use Reymon\EasyKeyboard\Tools\PeerType\RequestPeerTypeChat;
use Reymon\EasyKeyboard\Tools\PeerType\RequestPeerTypeUser;

trait EasyMarkup
{
    /**
     * create simple text keyboard.
     *
     */
    public function addText(string $text): KeyboardMarkup
    {
        return $this->addButton(KeyboardButton::Text($text));
    }

    /**
     * create simple texts keyboard.
     *
     * @param array $keyboards
     */
    public function addTexts(... $keyboards): KeyboardMarkup
    {
        $callabe = function (array $row): void {
            \array_map($this->addText(...), $row);
            $this->row();
        };
        \array_map($callabe, $keyboards);
        return $this;
    }

    public function addProfile(string $text, int $userId): KeyboardMarkup
    {
        return $this->addButton(KeyboardButton::Profile($text, $userId));
    }

    /**
     * Create text button that open web app without requiring user information.
     *
     */
    public function addWebApp(string $text, string $url): KeyboardMarkup
    {
        return $this->addButton(KeyboardButton::WebApp($text, $url));
    }

    /**
     * Create text button that request poll from user.
     *
     */
    public function requestPoll(string $text, PollType $type = PollType::ALL): KeyboardMarkup
    {
        return $this->addButton(KeyboardButton::Poll($text, $type));
    }

    /**
     * Create text button that request location from user.
     *
     */
    public function requestLocation(string $text): KeyboardMarkup
    {
        return $this->addButton(KeyboardButton::Location($text));
    }

    /**
     * Create text button that request contact info from user.
     *
     */
    public function requestPhone(string $text): KeyboardMarkup
    {
        return $this->addButton(KeyboardButton::Phone($text));
    }

    /**
     * Create a request peer user button.
     *
     */
    public function requestUser(string $text, int $buttonId, ?bool $bot = null, ?bool $premium = null, int $max = 1): KeyboardMarkup
    {
        $peerType = RequestPeerTypeUser::new($bot, $premium, $max);
        return $this->addButton(KeyboardButton::Peer($text, $buttonId, $peerType));
    }

    /**
     * Create a request peer chat button.
     *
     * @param ?bool            $creator
     * @param ?bool            $hasUsername
     * @param ?bool            $forum
     * @param ?ChatAdminRights $userAdminRights
     * @param ?ChatAdminRights $botAdminRights
     */
    public function requestChat(
        string $text,
        int    $buttonId,
        ?bool  $creator = null,
        ?bool  $hasUsername = null,
        ?bool  $forum = null,
        ?ChatAdminRights $userAdminRights = null,
        ?ChatAdminRights $botAdminRights  = null
    ): KeyboardMarkup {
        $peerType = RequestPeerTypeChat::new($creator, $hasUsername, $forum, $botAdminRights, $userAdminRights);
        return $this->addButton(KeyboardButton::Peer($text, $buttonId, $peerType));
    }

    /**
     * Create a request peer broadcast button.
     *
     * @param ?bool            $creator
     * @param ?bool            $hasUsername
     * @param ?ChatAdminRights $userAdminRights
     * @param ?ChatAdminRights $botAdminRights
     */
    public function requestChannel(
        string $text,
        int    $buttonId,
        ?bool  $creator = null,
        ?bool  $hasUsername = null,
        ?ChatAdminRights $userAdminRights = null,
        ?ChatAdminRights $botAdminRights  = null
    ): KeyboardMarkup {
        $peerType = RequestPeerTypeChannel::new($creator, $hasUsername, $botAdminRights, $userAdminRights);
        return $this->addButton(KeyboardButton::Peer($text, $buttonId, $peerType));
    }
}
