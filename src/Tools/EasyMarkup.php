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
use Reymon\EasyKeyboard\KeyboardTypes\KeyboardMarkup;
use Reymon\EasyKeyboard\Tools\ChatAdminRights;
use Reymon\EasyKeyboard\Tools\PeerType\RequestChannel;
use Reymon\EasyKeyboard\Tools\PeerType\RequestGroup;
use Reymon\EasyKeyboard\Tools\PeerType\RequestUsers;

trait EasyMarkup
{
    /**
     * Create simple text keyboard.
     *
     * @param string $text Label text on the button
     */
    public function addText(string $text): KeyboardMarkup
    {
        return $this->addButton(KeyboardButton::Text($text));
    }

    /**
     * Create simple texts keyboard.
     *
     * @param array ...$keyboards
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
     * @param string $text Label text on the button
     * @param string $url  An HTTPS URL of a Web App to be opened with additional data as specified in [Initializing Web Apps](https://core.telegram.org/bots/webapps#initializing-mini-apps)
     */
    public function addWebApp(string $text, string $url): KeyboardMarkup
    {
        return $this->addButton(KeyboardButton::WebApp($text, $url));
    }

    /**
     * Create text button that request poll from user.
     *
     * @param string   $text Label text on the button
     */
    public function requestPoll(string $text, PollType $type = PollType::ALL): KeyboardMarkup
    {
        return $this->addButton(KeyboardButton::Poll($text, $type));
    }

    /**
     * Create text button that request location from user.
     *
     * @param string $text Label text on the button
     */
    public function requestLocation(string $text): KeyboardMarkup
    {
        return $this->addButton(KeyboardButton::Location($text));
    }

    /**
     * Create text button that request contact info from user.
     *
     * @param string $text Label text on the button
     */
    public function requestPhone(string $text): KeyboardMarkup
    {
        return $this->addButton(KeyboardButton::Phone($text));
    }

    /**
     * Create a request peer user button.
     *
     * @param string $text     Label text on the button
     * @param int    $buttonId Signed 32-bit identifier of the request
     * @param ?bool  $bot      Whether to request bots or users, If not specified, no additional restrictions are applied.
     * @param ?bool  $premium  Whether to request premium or non-premium users. If not specified, no additional restrictions are applied.
     * @param int    $max      The maximum number of users to be selected; 1-10.
     */
    public function requestUsers(string $text, int $buttonId, ?bool $bot = null, ?bool $premium = null, int $max = 1): KeyboardMarkup
    {
        $peer = RequestUsers::new($bot, $premium, $max);
        return $this->addButton(KeyboardButton::Peer($text, $buttonId, $peer));
    }

    /**
     * Create a request group button.
     *
     * @param string           $text            Label text on the button
     * @param int              $buttonId        Signed 32-bit identifier of the request
     * @param ?bool            $creator         Whether to request a chat owned by the user.
     * @param ?bool            $username        Whether to request a supergroup or a channel with (or without) a username. If not specified, no additional restrictions are applied.
     * @param ?bool            $forum           Whether to request a forum (or non-forum) supergroup.
     * @param ?bool            $member          Whether to request a chat with the bot as a member. Otherwise, no additional restrictions are applied.
     * @param ?ChatAdminRights $userAdminRights The required administrator rights of the user in the chat. If not specified, no additional restrictions are applied.
     * @param ?ChatAdminRights $botAdminRights  The required administrator rights of the bot in the chat. If not specified, no additional restrictions are applied.
     */
    public function requestGroup(string $text, int $buttonId, ?bool $creator = null, ?bool $username = null, ?bool $forum = null, ?bool $member = null, ?ChatAdminRights $userAdminRights = null, ?ChatAdminRights $botAdminRights = null): KeyboardMarkup
    {
        $peerType = RequestGroup::new($creator, $username, $forum, $member, $botAdminRights, $userAdminRights);
        return $this->addButton(KeyboardButton::Peer($text, $buttonId, $peerType));
    }

    /**
     * Create a request channel button.
     *
     * @param string           $text            Label text on the button
     * @param int              $buttonId        Signed 32-bit identifier of the request
     * @param ?bool            $creator         Whether to request a chat owned by the user.
     * @param ?bool            $username        Whether to request a supergroup or a channel with (or without) a username. If not specified, no additional restrictions are applied.
     * @param ?ChatAdminRights $userAdminRights The required administrator rights of the user in the chat. If not specified, no additional restrictions are applied.
     * @param ?ChatAdminRights $botAdminRights  The required administrator rights of the bot in the chat. If not specified, no additional restrictions are applied.
     */
    public function requestChannel(string $text, int $buttonId, ?bool $creator = null, ?bool $hasUsername = null, ?ChatAdminRights $userAdminRights = null, ?ChatAdminRights $botAdminRights = null): KeyboardMarkup
    {
        $peerType = RequestChannel::new($creator, $hasUsername, $botAdminRights, $userAdminRights);
        return $this->addButton(KeyboardButton::Peer($text, $buttonId, $peerType));
    }
}
