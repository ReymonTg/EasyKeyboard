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

use Reymon\EasyKeyboard\Button\KeyboardButton;

/**
 * Represents text button that request contact info from user.
 */
final readonly class Phone extends KeyboardButton
{
    /**
     * @param string $text Label text on the button
     */
    public function __construct(string $text)
    {
        parent::__construct($text);
    }

    /**
     * Create text button that request contact info from user.
     *
     * @param string $text Label text on the button
     */
    public static function new(string $text): self
    {
        return new static($text);
    }

    /**
     * @internal
     */
    public function jsonSerialize(): array
    {
        return [
            'text' => $this->text,
            'request_contact' => true
        ];
    }
}
