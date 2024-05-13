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
 * Represents inline button that switches the current user to inline mode in a chat
 */
readonly class SwitchInline extends InlineButton
{
    /**
     * @param string $text   Label text on the button
     * @param string $query  Data to be sent in a [callback query](https://core.telegram.org/bots/api#callbackquery) to the bot when button is pressed, 1-64 bytes
     */
    public function __construct(string $text, public string $query = '')
    {
        parent::__construct($text);
    }

    public function setQuery(string $query = ''): InlineButton
    {
        return $this->withKey('query', $query);
    }

    /**
     * Create inline button that switches the current user to inline mode in a chat
     *
     * @param string $text  Label text on the button
     * @param string $query Data to be sent in a [callback query](https://core.telegram.org/bots/api#callbackquery) to the bot when button is pressed, 1-64 bytes
     */
    public static function new(string $text, string $query): self
    {
        return new static($text, $query);
    }

    /**
     * @internal
     */
    public function jsonSerialize(): array
    {
        return [
            'text' => $this->text,
            'switch_inline_query' => $this->query
        ];
    }
}
