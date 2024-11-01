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

namespace Reymon\EasyKeyboard\Keyboard;

use Reymon\EasyKeyboard\Keyboard;
use Reymon\EasyKeyboard\Utils\EasyMarkup;
use Reymon\EasyKeyboard\Utils\Placeholder;
use Reymon\EasyKeyboard\Utils\Selective;

/**
 * Represents a custom keyboard with reply options.
 */
final class KeyboardMarkup extends Keyboard
{
    use Selective, Placeholder, EasyMarkup;

    /**
     * Whether to hide the keyboard as soon as it's been used. The keyboard will still be available, but clients will automatically display the usual letter-keyboard in the chat - the user can press a special button in the input field to see the custom keyboard again. Defaults to false.
     */
    public function singleUse(bool $singleUse = true): self
    {
        $this->option['one_time_keyboard'] = $singleUse;
        return $this;
    }

    /**
     * Whether to resize the keyboard vertically for optimal fit (e.g., make the keyboard smaller if there are just two rows of buttons). Defaults to false, in which case the custom keyboard is always of the same height as the app's standard keyboard.
     */
    public function resize(bool $resize = true): self
    {
        $this->option['resize_keyboard'] = $resize;
        return $this;
    }

    /**
     * Whether to always show the keyboard when the regular keyboard is hidden. Defaults to false, in which case the custom keyboard can be hidden and opened with a keyboard icon.
     */
    public function alwaysShow(bool $show = true): self
    {
        $this->option['is_persistent'] = $show;
        return $this;
    }

    /**
     * @internal
     */
    public function jsonSerialize(): array
    {
        parent::jsonSerialize();
        return [...$this->option, 'keyboard' => $this->data];
    }
}
