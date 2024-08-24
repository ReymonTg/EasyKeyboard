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

namespace Reymon\EasyKeyboard\Utils;

use LengthException;

/**
 * @internal
 */
trait Placeholder
{
    /**
     * The placeholder to be shown in the input field when the keyboard is active; 1-64 characters.
     */
    public function placeholder(?string $placeholder = null): self
    {
        $length = \mb_strlen($placeholder);
        if (isset($placeholder) && $length >= 0 && $length <= 64) {
            $this->option['input_field_placeholder'] = $placeholder;
        } elseif ($placeholder != null) {
            throw new LengthException('Maximum length is 64. ' . $length . ' given.');
        }
        return $this;
    }
}
