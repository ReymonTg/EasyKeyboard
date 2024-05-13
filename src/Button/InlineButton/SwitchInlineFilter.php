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

/**
 * Represents an inline button that switches the current user to inline mode in a chosen chat, with an optional default inline query.
 */
final readonly class SwitchInlineFilter extends SwitchInline
{
    /**
     * @param string    $text          Label text on the button
     * @param string    $query         The default inline query to be inserted in the input field. If left empty, only the bot's username will be inserted
     * @param bool      $allowUsers    Whether private chats with users can be chosen
     * @param bool|null $allowBots     Whether private chats with bots can be chosen
     * @param bool|null $allowGroups   Whether group and supergroup chats can be chosen
     * @param bool|null $allowChannels Whether channel chats can be chosen 
     */
    public function __construct(string $text, string $query = '', public bool $allowUsers = true, public ?bool $allowBots = null, public ?bool $allowGroups = null, public ?bool $allowChannels = null)
    {
        parent::__construct($text, $query);
    }

    public function allowUsers(bool $allow): InlineButton
    {
        return $this->withKey('allowUsers', $allow);
    }

    public function allowBots(bool $allow): InlineButton
    {
        return $this->withKey('allowBots', $allow);
    }

    public function allowGroups(bool $allow): InlineButton
    {
        return $this->withKey('allowGroups', $allow);
    }

    public function allowChannels(bool $allow): InlineButton
    {
        return $this->withKey('allowChannels', $allow);
    }

    /**
     * Create an inline button that switches the current user to inline mode in a chosen chat, with an optional default inline query.
     *
     * @param string    $text          Label text on the button
     * @param string    $query         The default inline query to be inserted in the input field. If left empty, only the bot's username will be inserted
     * @param bool      $allowUsers    Whether private chats with users can be chosen
     * @param bool|null $allowBots     Whether private chats with bots can be chosen
     * @param bool|null $allowGroups   Whether group and supergroup chats can be chosen
     * @param bool|null $allowChannels Whether channel chats can be chosen 
     */
    public static function new(string $text, string $query = '', bool $allowUsers = true, ?bool $allowBots = null, ?bool $allowGroups = null, ?bool $allowChannels = null): self
    {
        return new static($text, $query, $allowUsers, $allowBots, $allowGroups, $allowChannels);
    }

    /**
     * @internal
     */
    public function jsonSerialize(): array
    {
        return [
            'text' => $this->text,
            'switch_inline_query_chosen_chat' => \array_filter_null([
                'query' => $this->query,
                'allow_user_chats'    => $this->allowUsers,
                'allow_bot_chats'     => $this->allowBots,
                'allow_group_chats'   => $this->allowGroups,
                'allow_channel_chats' => $this->allowChannels,
            ])

        ];
    }
}
