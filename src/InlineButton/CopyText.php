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

namespace Reymon\EasyKeyboard\InlineButton;

use Reymon\EasyKeyboard\InlineButton;

/**
 * Rrepresents an inline button that copies specified text to the clipboard.
 */
final class CopyText extends InlineButton
{
    /**
     * @param string $text     Label text on the button
     * @param string $copyText The text to be copied to the clipboard; 1-256 characters
     */
    public function __construct(string $text, private string $copyText)
    {
        parent::__construct($text);
    }

    public function setCopyText(string $text): self
    {
        $this->copyText = $text;
        return $this;
    }

    public function getCopyText(): string
    {
        return $this->copyText;
    }

    /**
     * Create inline button that copies specified text to the clipboard.
     *
     * @param string $text     Label text on the button
     * @param string $copyText The text to be copied to the clipboard; 1-256 characters
     */
    public static function new(string $text, string $copyText): self
    {
        return new static($text, $copyText);
    }

    /**
     * @internal
     */
    public function jsonSerialize(): array
    {
        return [
            'text'      => $this->text,
            'copy_text' => ['text' => $this->copyText]
        ];
    }
}
