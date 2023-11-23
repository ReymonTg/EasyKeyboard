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

namespace Reymon\EasyKeyboard\Tools\PeerType;

use Reymon\EasyKeyboard\ChatAdminRights;

abstract class RequestPeerType implements \JsonSerializable
{
    protected array $types = [];

    public function __construct(array $data)
    {
        $this->types = $data + $this->types;
    }

    // public static function fromRawPeerType(array $peerType) : self
    // {
    //     unset($peerType['user_admin_rights']['_'], $peerType['bot_admin_rights']['_']);
    //     return match ($peerType['_']){
    //         'requestPeerTypeBroadcast' => RequestPeerTypeChannel::new(
    //             $peerType['creator'] ?? false,
    //             $peerType['has_username'] ?? false,
    //             ChatAdminRights::new(...$peerType['user_admin_rights']),
    //             ChatAdminRights::new(...$peerType['bot_admin_rights'])
    //         ),
    //         'requestPeerTypeChat' => RequestPeerTypeChat::new(
    //             $peerType['creator'] ?? false,
    //             $peerType['has_username'] ?? false,
    //             $peerType['forum'] ?? false,
    //             ChatAdminRights::new(...$peerType['user_admin_rights']),
    //             ChatAdminRights::new(...$peerType['bot_admin_rights'])
    //         ),
    //         'requestPeerTypeUser' => RequestPeerTypeUser::new($peerType['bot'] ?? false,$peerType['premium'] ?? false)
    //     };
    // }

    /**
     * @internal
     */
    public function jsonSerialize(): mixed
    {
        return array_filter($this->types, fn($v) => !is_null($v));
    }
}