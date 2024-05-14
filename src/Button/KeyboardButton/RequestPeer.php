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
 * 
 */
abstract class RequestPeer extends KeyboardButton
{
    public function __construct(string $text, protected int $buttonId, protected bool $name = false, protected bool $username = false, protected bool $photo = false)
    {
        parent::__construct($text);
    }

    public function setButtonId(int $buttonId): self
    {
        $this->buttonId = $buttonId;
        return $this;
    }

    public function getButtonId(): int
    {
        return $this->buttonId;
    }

    public function withName(?bool $name = null): self
    {
        $this->name = $name;
        return $this;
    }

    public function withUsername(?bool $username = null): self
    {
        $this->username = $username;
        return $this;
    }

    public function withPhoto(?bool $photo = null): self
    {
        $this->photo = $photo;
        return $this;
    }
}
