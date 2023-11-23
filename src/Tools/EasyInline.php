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

namespace Reymon\EasyKeyboard\Tools;

use Reymon\EasyKeyboard\ButtonTypes\InlineButton;
use Reymon\EasyKeyboard\KeyboardTypes\KeyboardInline;

trait EasyInline
{
    /**
     * Create inline button with callback data.
     *
     */
    public function addCallback(string $text, string $callback): KeyboardInline
    {
        return $this->addButton(InlineButton::CallBack($text, $callback));
    }

    /**
     * Create inline buttons with callback data.
     *
     * @param array $keyboards
     */
    public function addCallbacks(... $keyboards): KeyboardInline
    {
        $callabe = function (array $row): void {
            \array_map($this->addCallback(...), \array_keys($row), $row);
            $this->row();
        };
        \array_map($callabe, $keyboards);
        return $this;
    }

    /**
     * Create Inline webapp button.
     *
     */
    public function addWebApp(string $text, string $url): KeyboardInline
    {
        return $this->addButton(InlineButton::WebApp($text, $url));
    }

    /**
     * Create Inline button with url.
     *
     */
    public function addUrl(string $text, string $url): KeyboardInline
    {
        return $this->addButton(InlineButton::Url($text, $url));
    }

    /**
     * Create game button for your inline game.
     *
     */
    public function addGame(string $text): KeyboardInline
    {
        return $this->addButton(InlineButton::Game($text));
    }

    /**
     * Create a buy button for your inline buy request(similar to webapps).
     *
     */
    public function addBuy(string $text): KeyboardInline
    {
        return $this->addButton(InlineButton::Buy($text));
    }

    /**
     * Create Inline button with SwitchInline options.
     *
     * @param ?InlineChoosePeer $filter
     */
    public function addSwitchInline(string $text, string $query, bool $same = true, ?InlineChoosePeer $filter = null): KeyboardInline
    {
        return $this->addButton(InlineButton::SwitchInline($text, $query, $same, $filter));
    }
}
