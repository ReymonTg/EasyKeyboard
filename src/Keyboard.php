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

namespace Reymon\EasyKeyboard;

use RangeException;
use OutOfBoundsException;
use Reymon\EasyKeyboard\Tools\InlineChoosePeer;
use Reymon\EasyKeyboard\ButtonTypes\InlineButton;
use Reymon\EasyKeyboard\ButtonTypes\KeyboardButton;
use Reymon\EasyKeyboard\KeyboardTypes\KeyboardInline;
use Reymon\EasyKeyboard\KeyboardTypes\KeyboardMarkup;
use Reymon\EasyKeyboard\KeyboardTypes\KeyboardHide;
use Reymon\EasyKeyboard\KeyboardTypes\KeyboardForceReply;

/**
 * Main class for Keyboard.
 */
abstract class Keyboard implements \JsonSerializable
{
    protected int $currentRowIndex = 0;

    protected array $data = [];

    /**
     * To cast easy-keyboard to Telegram Api keyboard.
     *
     * @return list<array> Telegram Api Keyboard
     */
    public function build(): array
    {
        $keyboard = &$this->data;
        if (empty($keyboard[$this->currentRowIndex]))
            unset($keyboard[$this->currentRowIndex]);
        return $this->data;
    }

    /**
     * To cast Telegram api keyboard to easy-keyboard.
     *
     * @param array $rawReplyMarkup array of Telegram api Keyboard
     * @return KeyboardInline|KeyboardHide|KeyboardMarkup|KeyboardForceReply|null
     */
    public static function fromRawReplyMarkup(array $rawReplyMarkup): ?self
    {
        $rawReplyMarkup = $rawReplyMarkup['inline_keyboard'] ?? false;
        if (!isset($rawReplyMarkup))
            throw new Exception('Invalid keyboard type provided');

        $keyboard = new KeyboardInline;
        foreach ($rawReplyMarkup as $row)
        {
            foreach ($row as $button)
            {
                $text  = $button['text'];
                $login = $button['login_url'] ?? null;
                $query = $button['switch_inline_query'] ?? $button['switch_inline_query_current_chat'] ?? $button['switch_inline_query_chosen_chat'] ?? null;
                $same  = $button['switch_inline_query_current_chat'] ?? false;
                $keyboard->addButton(match (true) {
                    isset ($button['url'])           => InlineButton::Url($text, $button['url']),
                    isset ($button['pay'])           => InlineButton::Buy($text),
                    isset ($button['callback_game']) => InlineButton::Game($text),
                    isset ($button['callback_data']) => InlineButton::CallBack($text, $button['callback_data']),
                    !is_null($query) => is_array($query)
                        ? InlineButton::SwitchInline($text, $query['query'], filter: InlineChoosePeer::fromRawChoose($button['switch_inline_query_chosen_chat']))
                        : InlineButton::SwitchInline($text, $query, $same),
                    !is_null($login) => InlineButton::Login(
                        $text, $login['url'], $login['forward_text'],
                        $login['bot_username'], $login['request_write_access']
                    ),
                });
            }
            $keyboard->row();
        }
        return $keyboard;
    }

    /**
     * Create new easy-keyboard.
     *
     * @return KeyboardInline|KeyboardHide|KeyboardMarkup|KeyboardForceReply
     */
    public static function new(): static
    {
        return new static;
    }

    /**
     * @throws Exception
     */
    public function __call(string $name, array $arguments)
    {
        if ((!isset($arguments[0]) || $arguments[0])) {
            $fn = match ($name) {
                'resize'      => fn(bool $option = true) => $this->data['resize_keyboard']   = $option,
                'selective'   => fn(bool $option = true) => $this->data['is_persistent']     = $option,
                'singleUse'   => fn(bool $option = true) => $this->data['one_time_keyboard'] = $option,
                'placeholder' => function (string $placeholder = null)
                {
                    $length = mb_strlen($placeholder);
                    if (isset($placeholder) && $length >= 0 && $length <= 64) {
                        $this->data['input_field_placeholder'] = $placeholder;
                    } elseif ($placeholder != null) {
                        throw new Exception('PLACE_HOLDER_MAX_CHAR');
                    }
                },
                default => throw new Exception(sprintf('Call to undefined method %s::%s()', $this::class, $name))
            };
            isset($arguments[0]) ? $fn($arguments[0]) : $fn();
            return $this;
        }
        throw new Exception(
            sprintf('Call to undefined method %s::%s()', $this::class, $name)
        );
    }

    /**
     * To add button(s) to easy-keyboard.
     *
     * @param KeyboardButton|InlineButton ...$buttons
     * @return KeyboardInline|KeyboardHide|KeyboardMarkup|KeyboardForceReply
     */
    public function addButton(Button ...$buttons): self
    {
        $row = &$this->data[$this->currentRowIndex];
        $row = array_merge($row ?? [], $buttons);
        return $this;
    }

    /**
     * To add a button by it coordinates to easy-keyboard (Note that coordinates start from 0 look like arrays indexes).
     *
     * @param int $row
     * @param int $column
     * @param KeyboardButton|InlineButton ...$buttons
     * @return KeyboardInline|KeyboardHide|KeyboardMarkup|KeyboardForceReply
     */
    public function addToCoordinates(int $row, int $column,Button ...$buttons): self
    {
        array_splice($this->data[$row], $column, 0, $buttons);
        return $this;
    }

    /**
     * To replace a button by it coordinates to easy-keyboard (Note that coordinates start from 0 look like arrays indexes).
     *
     * @param int $row
     * @param int $column
     * @param KeyboardButton|InlineButton ...$button
     * @return KeyboardInline|KeyboardHide|KeyboardMarkup|KeyboardForceReply
     * @throws OutOfBoundsException
     */
    public function replaceIntoCoordinates(int $row, int $column,Button ...$buttons): self
    {
        if (array_key_exists($row, $this->data) && array_key_exists($column, $this->data[$row]))
        {
            array_splice($this->data[$row], $column, count($buttons), $buttons);
            return $this;
        }
        throw new OutOfBoundsException("Please be sure that $row and $column exists in array keys!");
    }

    /**
     * To remove button by it coordinates to easy-keyboard (Note that coordinates start from 0 look like arrays indexes).
     *
     * @param int $row
     * @param int $column
     * @param int $count
     * @return KeyboardInline|KeyboardHide|KeyboardMarkup|KeyboardForceReply
     * @throws OutOfBoundsException
     */
    public function removeFromCoordinates(int $row, int $column,int $count = 1): self
    {
        if (array_key_exists($row, $this->data) && array_key_exists($column, $this->data[$row]))
        {
            array_splice($this->data[$row], $column, $count);
            $currentRow = $this->data[$row];
            if(count($currentRow) == 0)
                array_splice($this->data, $row, 1);
            return $this;
        }
        throw new OutOfBoundsException("Please be sure that $row and $column exists in array keys!");
    }

    /**
     * Remove the last button from easy-keyboard.
     *
     * @return KeyboardInline|KeyboardHide|KeyboardMarkup|KeyboardForceReply
     * @throws RangeException
     */
    public function remove(): self
    {
        if(!empty($rows = $this->data) && !empty($endButtons = end($rows)))
        {
            $endRow    = array_keys($rows);
            $endButton = array_keys($endButtons);

            if(count($endButtons) == 1)
                unset($this->data[end($endRow)]);
            unset($this->data[end($endRow)][end($endButton)]);
            return $this;
        }
        throw new RangeException("Keyboard array is already empty!");
    }

    /**
     * Add a new raw with specified button ( pass null to only add new row).
     *
     * @param KeyboardButton|InlineButton|null ...$button
     * @return KeyboardInline|KeyboardHide|KeyboardMarkup|KeyboardForceReply
     */
    public function row(?Button ...$button): self
    {
        $keyboard = &$this->data;

        // Last row is not empty, add new row
        if (!empty($keyboard[$this->currentRowIndex]))
        {
            $keyboard[] = [];
            $this->currentRowIndex++;
        }

        if (!empty($button))
        {
            $this->addButton(... $button);
            $this->row();
        }

        return $this;
    }

    /**
     * Add specified buttons to easy-keyboard (each button will add to new row).
     *
     * @param KeyboardButton|InlineButton|null ...$button
     * @return KeyboardInline|KeyboardHide|KeyboardMarkup|KeyboardForceReply
     */
    public function Stack(Button ...$button): self
    {
        array_map($this->row(...), $button);
        return $this;
    }

    /**
     * @internal
     */
    public function jsonSerialize(): mixed
    {
        $keyboard = &$this->data;
        if (empty($keyboard[$this->currentRowIndex]))
            unset($keyboard[$this->currentRowIndex]);
        return $this->data;
    }
}
