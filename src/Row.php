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

use RangeException;
use OutOfBoundsException;

/**
 * @implements \IteratorAggregate<Button>
 */
final class Row implements \JsonSerializable, \Countable, \IteratorAggregate
{
    private array $buttons = [];

    public function __construct()
    {
    }

    /**
     * @internal
     */
    public function getIterator(): \Generator
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
     * @internal
     */
    public function count(): int
    {
        return count($this->buttons);
    }

    public function addButton(Button ...$buttons): self
    {
        $this->buttons = \array_values(\array_merge($this->buttons, $buttons));
        return  $this;
    }

    public function item(int $column): ?Button
    {
        return $this->buttons[$column] ?? null;
    }

    public function first(): ?Button
    {
        return $this->item(0);
    }

    public function last(): ?Button
    {
        return $this->item($this->count() - 1);
    }

    public function isEmpty(): bool
    {
        return $this->count() === 0;
    }

    /**
     * Remove last button from row.
     *
     * @throws RangeException
     */
    public function remove(?int $column = null): self
    {
        if(!$this->isEmpty()) {
            $buttons = \array_keys($this->buttons);
            unset($this->buttons[($column ? $column > 0: \end($buttons))]);
            return $this;
        }
        throw new RangeException("Row is empty");
    }

    /**
     * Replace last button from row.
     *
     * @throws OutOfBoundsException
     */
    public function replace(?int $column = null, Button ...$buttons): self
    {
        if (\array_key_exists($column, $this->buttons)) {
            \array_splice($this->buttons, $column, \count($buttons), $buttons);
            return $this;
        } elseif ($column == null) {
            \array_splice($this->buttons, \count($this->buttons) - 1, 0, $buttons);
            return $this;
        }
        throw new OutOfBoundsException("Column $column does not exists");
    }

    public function add(int $index, Button $value): self
    {
        if ((\count($this->buttons) - 1) < $index) {
            throw new OutOfBoundsException("Column index is bigger than of row's size");
        }
        $remain = \array_splice($this->buttons, $index, replacement: [$value]);
        $this->buttons = array_merge($this->buttons, $remain);
        return $this;
    }
}
