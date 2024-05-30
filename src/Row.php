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
use IteratorAggregate;
use JsonSerializable;
use OutOfBoundsException;
use RangeException;

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
        $this->buttons = \array_merge($this->buttons, $button);
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
        return \count($this->buttons) === 0;
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
    /**
     * remove last button from row.
     *
     * @throws RangeException
     */
    public function remove(?int $columnNumber = null): self
    {
        if(!empty($this->buttons) && $this->currentColumnIndex !== 0) {
            $buttons = \array_keys($this->buttons);
            unset($this->buttons[($columnNumber ? $columnNumber > 0: \end($buttons))]);
            $this->currentColumnIndex--;
            return $this;
        }
        throw new RangeException("Raw array is already empty!");
    }

    /**
     * replace last button from row.
     *
     * @throws OutOfBoundsException
     */
    public function replace(?int $columnNumber = null, Button ...$buttons): self
    {
        if (\array_key_exists($columnNumber, $this->buttons)) {
            \array_splice($this->buttons, $columnNumber, \count($buttons), $buttons);
            return $this;
        } elseif ($columnNumber == null) {
            \array_splice($this->buttons, \count($this->buttons) - 1, 0, $buttons);
            return $this;
        }
        throw new OutOfBoundsException("Please be sure that $columnNumber exists in array keys!");
    }
}
