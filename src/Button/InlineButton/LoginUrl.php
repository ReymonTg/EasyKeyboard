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

namespace Reymon\EasyKeyboard\Button\InlineButton;

use Reymon\EasyKeyboard\Button\InlineButton;
use Reymon\EasyKeyboard\Tools\Url;

/**
 * Represents inline button for login.
 */
final class LoginUrl extends InlineButton
{
    use Url;

    /**
     * @param string  $text        Label text on the button
     * @param string  $url         An HTTPS URL used to automatically authorize the user
     * @param ?string $fwdText     New text of the button in forwarded messages
     * @param ?string $username    Username of a bot, which will be used for user authorization.
     * @param bool    $writeAccess Whether to request the permission for your bot to send messages to the user
     */
    public function __construct(string $text, private string $url, private ?string $fwdText = null, private ?string $username = null, private bool $writeAccess = false)
    {
        parent::__construct($text);
    }

    public function setForwardText(?string $fwdText = null): self
    {
        $this->fwdText = $fwdText;
        return $this;
    }

    public function getForwardText(): ?string
    {
        return $this->fwdText;
    }

    public function setUsername(?string $username = null): self
    {
        $this->username = $username;
        return $this;
    }

    public function getUsername(): ?string
    {
        return $this->username;
    }

    public function setWriteAccess(bool $writeAccess = false): self
    {
        $this->writeAccess = $writeAccess;
        return $this;
    }

    public function getWriteAccess(): bool
    {
        return $this->writeAccess;
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
    public static function new(string $text, string $url, ?string $fwdText = null, ?string $username = null, bool $writeAccess = false): self
    {
        return new static($text, $url, $fwdText, $username, $writeAccess);
    }

    /**
     * @internal
     */
    public function jsonSerialize(): array
    {
        return [
            'text'      => $this->text,
            'login_url' => array_filter_null([
                'url'                  => $this->url,
                'forward_text'         => $this->fwdText,
                'bot_username'         => $this->username,
                'request_write_access' => $this->writeAccess,
            ]),
        ];
    }
}
