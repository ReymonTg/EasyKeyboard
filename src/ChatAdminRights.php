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

final class ChatAdminRights implements \JsonSerializable
{
    private array $adminRights = [];

    public function __invoke(): array
    {
        return $this->adminRights;
    }

    public function __construct(array $data)
    {
        $this->adminRights += $data;
    }

    public static function new(
        bool $changeInfo     = false,
        bool $postMessages   = false,
        bool $editMessages   = false,
        bool $deleteMessages = false,
        bool $banUsers       = false,
        bool $inviteUsers    = false,
        bool $pinMessages    = false,
        bool $addAdmins      = false,
        bool $anonymous      = false,
        bool $manageCall     = false,
        bool $manageChat     = false,
        bool $manageTopics   = false,
        bool $postStories    = false,
        bool $editStories    = false,
        bool $deleteStories  = false,
    ): self
    {
        $adminRights = [
            'can_change_info'        => $changeInfo,
            'can_post_messages'      => $postMessages,
            'can_edit_messages'      => $editMessages,
            'can_delete_messages'    => $deleteMessages,
            'can_restrict_members'   => $banUsers,
            'can_invite_users'       => $inviteUsers,
            'can_pin_messages'       => $pinMessages,
            'can_promote_members'    => $addAdmins,
            'is_anonymous'           => $anonymous,
            'can_manage_video_chats' => $manageCall,
            'can_manage_chat'        => $manageChat,
            'manage_topics'          => $manageTopics,
            'can_post_stories'       => $postStories,
            'can_edit_stories'       => $editStories,
            'can_delete_stories'     => $deleteStories,
        ];
        return new static($adminRights);
    }

    /**
     * @internal
     */
    public function jsonSerialize(): mixed
    {
        return $this->adminRights;
    }
}