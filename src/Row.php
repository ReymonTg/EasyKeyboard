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

namespace Reymon\EasyKeyboard;

use Generator;
use JsonSerializable;
use IteratorAggregate;

final class Row implements JsonSerializable, IteratorAggregate
{
    /** @var list<Button> */
    private array $buttons = [];
    private int $currentColumnIndex = 0;

    public function __construct()
    {
    }

    public function addButton(Button ...$button): self
    {
        $this->buttons = array_merge($this->buttons, $button);
        $this->currentColumnIndex++;
        return  $this;
    }

    public function getButton(int $column): ?Button
    {
        return $this->buttons[$column] ?? null;
    }

    public function getFirstButton(): ?Button
    {
        return $this->getButton(0);
    }

    public function getLastButton(): ?Button
    {
        return $this->getButton($this->currentColumnIndex - 1);
    }

    public function isEmpty(): bool
    {
        return count($this->buttons) === 0;
    }

    /**
     * @internal
     */
    public function getIterator(): Generator
    {
        yield from $this->buttons;
    }

    /**
     * @internal
     */
    public function jsonSerialize(): array
    {
        return $this->buttons;
    }
}
