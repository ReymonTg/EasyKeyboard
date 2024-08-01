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

final class ChatAdminRights implements \JsonSerializable
{
    /** @var list<bool|null> */
    private array $adminRights = [];

    /**
     * @internal
     */
    private function __construct(array $data)
    {
        $this->adminRights += $data;
    }

    public static function new(
        ?bool $changeInfo     = null,
        ?bool $postMessages   = null,
        ?bool $editMessages   = null,
        ?bool $deleteMessages = null,
        ?bool $banUsers       = null,
        ?bool $inviteUsers    = null,
        ?bool $pinMessages    = null,
        ?bool $addAdmins      = null,
        ?bool $anonymous      = null,
        ?bool $manageCall     = null,
        ?bool $manageChat     = null,
        ?bool $manageTopics   = null,
        ?bool $postStories    = null,
        ?bool $editStories    = null,
        ?bool $deleteStories  = null,
    ): self {
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
        return new ChatAdminRights($adminRights);
    }

    public function canChangeInfo(): ?bool
    {
        return $this->adminRights['can_change_info'];
    }

    public function changeInfo(?bool $changeInfo = null): self
    {
        $this->adminRights['can_change_info'] = $changeInfo;
        return $this;
    }

    public function canPostMessages(): ?bool
    {
        return $this->adminRights['can_post_messages'];
    }

    public function postMessages(?bool $postMessages = null): self
    {
        $this->adminRights['can_post_messages'] = $postMessages;
        return $this;
    }

    public function canEditMessages(): ?bool
    {
        return $this->adminRights['can_edit_messages'];
    }

    public function editMessages(?bool $editMessages = null): self
    {
        $this->adminRights['can_edit_messages'] = $editMessages;
        return $this;
    }

    public function canDeleteMessages(): ?bool
    {
        return $this->adminRights['can_delete_messages'];
    }

    public function deleteMessages(?bool $deleteMessages = null): self
    {
        $this->adminRights['can_delete_messages'] = $deleteMessages;
        return $this;
    }

    public function canBanUsers(): ?bool
    {
        return $this->adminRights['can_restrict_members'];
    }

    public function banUsers(?bool $banUsers = null): self
    {
        $this->adminRights['can_restrict_members'] = $banUsers;
        return $this;
    }

    public function canInviteUsers(): ?bool
    {
        return $this->adminRights['can_invite_users'];
    }

    public function inviteUsers(?bool $inviteUsers = null): self
    {
        $this->adminRights['can_invite_users'] = $inviteUsers;
        return $this;
    }

    public function canPinMessages(): ?bool
    {
        return $this->adminRights['can_pin_messages'];
    }

    public function pinMessages(?bool $pinMessages = null): self
    {
        $this->adminRights['can_pin_messages'] = $pinMessages;
        return $this;
    }

    public function canAddAdmins(): ?bool
    {
        return $this->adminRights['can_promote_members'];
    }

    public function addAdmins(?bool $addAdmins = null): self
    {
        $this->adminRights['can_promote_members'] = $addAdmins;
        return $this;
    }

    public function isAnonymous(): ?bool
    {
        return $this->adminRights['is_anonymous'];
    }

    public function anonymous(?bool $anonymous = null): self
    {
        $this->adminRights['is_anonymous'] = $anonymous;
        return $this;
    }

    public function canManageCall(): ?bool
    {
        return $this->adminRights['can_manage_video_chats'];
    }

    public function manageCall(?bool $manageCall = null): self
    {
        $this->adminRights['can_manage_video_chats'] = $manageCall;
        return $this;
    }
    public function canManageChat(): ?bool
    {
        return $this->adminRights['can_manage_chat'];
    }

    public function manageChat(?bool $manageChat = null): self
    {
        $this->adminRights['can_manage_chat'] = $manageChat;
        return $this;
    }
    public function canManageTopics(): ?bool
    {
        return $this->adminRights['manage_topics'];
    }

    public function manageTopics(?bool $manageTopics = null): self
    {
        $this->adminRights['manage_topics'] = $manageTopics;
        return $this;
    }
    public function canPostStories(): ?bool
    {
        return $this->adminRights['can_post_stories'];
    }

    public function postStories(?bool $postStories = null): self
    {
        $this->adminRights['can_post_stories'] = $postStories;
        return $this;
    }
    public function canEditStories(): ?bool
    {
        return $this->adminRights['can_edit_stories'];
    }

    public function editStories(?bool $editStories = null): self
    {
        $this->adminRights['can_edit_stories'] = $editStories;
        return $this;
    }
    public function canDeleteStories(): ?bool
    {
        return $this->adminRights['can_delete_stories'];
    }

    public function deleteStories(?bool $deleteStories = null): self
    {
        $this->adminRights['can_delete_stories'] = $deleteStories;
        return $this;
    }

    /**
     * @internal
     */
    public function jsonSerialize(): array
    {
        return array_filter_null($this->adminRights);
    }
}
