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

final class InlineChoosePeer implements \JsonSerializable
{
    private array $data = [];

    public function __construct(
        bool  $users    = true,
        ?bool $bots     = null,
        ?bool $groups   = null,
        ?bool $channels = null,
    ) {
        $this->data = [
            'allow_user_chats'    => $users,
            'allow_bot_chats'     => $bots,
            'allow_group_chats'   => $groups,
            'allow_channel_chats' => $channels,
        ];
    }

    public static function fromRawChoose(array $rawChoose): self
    {
        return new static(
            $rawChoose['allow_user_chats'] ?? null,
            $rawChoose['allow_bot_chats'] ?? null,
            $rawChoose['allow_group_chats'] ?? null,
            $rawChoose['allow_channel_chats'] ?? null,
        );
    }

    /**
     * @internal
     */
    public function jsonSerialize()
    {
        return $this->data;
    }
}