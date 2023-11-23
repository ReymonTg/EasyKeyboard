<?php

namespace Reymon\EasyKeyboard\Test\Buttons;

use PHPUnit\Framework\TestCase;
use Reymon\EasyKeyboard\ButtonTypes\KeyboardButton;
use Reymon\EasyKeyboard\Tools\PeerType\RequestPeerTypeChannel;
use Reymon\EasyKeyboard\Tools\PeerType\RequestPeerTypeChat;
use Reymon\EasyKeyboard\Tools\PeerType\RequestPeerTypeUser;
use Reymon\EasyKeyboard\Tools\PollType;

class KeyboardButtonTest extends TestCase
{
    public function testPeer()
    {
        $button1 = KeyboardButton::Peer('hello',0,$peer1 = RequestPeerTypeUser::new());
        $button2 = KeyboardButton::Peer('hello',0,$peer2 = RequestPeerTypeChat::new());
        $button3 = KeyboardButton::Peer('hello',0,$peer3 = RequestPeerTypeChannel::new());
        $rawButton1 = [
            'text' => 'hello',
            'request_user' => ['request_id' => 0, ...$peer1->jsonSerialize()]
        ];
        $rawButton2 = [
            'text' => 'hello',
            'request_chat' => ['request_id' => 0, ...$peer2->jsonSerialize()]
        ];
        $rawButton3 = [
            'text' => 'hello',
            'request_chat' => ['request_id' => 0, ...$peer3->jsonSerialize()]
        ];
        $this->assertEquals(json_encode($button1),json_encode($rawButton1));
        $this->assertEquals(json_encode($button2),json_encode($rawButton2));
        $this->assertEquals(json_encode($button3),json_encode($rawButton3));
    }

    public function testWebApp()
    {
        $button = KeyboardButton::WebApp('hello','https://example.com');
        $rawButton = [
            'text'    => 'hello',
            'web_app' => [
                'url' => 'https://example.com'
            ],
        ];
        $this->assertEquals(json_encode($button),json_encode($rawButton));
    }

    public function testText()
    {
        $button = KeyboardButton::Text('hello');
        $rawButton = [
            'text' => 'hello'
        ];
        $this->assertEquals(json_encode($button),json_encode($rawButton));
    }

    public function testPhone()
    {
        $button = KeyboardButton::Phone('send-phone');
        $rawButton = [
            'text'            => 'send-phone',
            'request_contact' => true,
        ];
        $this->assertEquals(json_encode($button),json_encode($rawButton));
    }

    public function testLocation()
    {
        $button = KeyboardButton::Location('send-location');
        $rawButton = [
            'text'            => 'send-location',
            'request_location' => true,
        ];
        $this->assertEquals(json_encode($button),json_encode($rawButton));
    }

    public function testPoll()
    {
        $button = KeyboardButton::Poll('send-poll',PollType::QUIZ);
        $rawButton = [
            'text'            => 'send-poll',
            'request_poll' => PollType::QUIZ,
        ];
        $this->assertEquals(json_encode($button),json_encode($rawButton));
    }

    public function testProfile()
    {
        $button = KeyboardButton::Profile('send-profile',777000);
        $rawButton = [
            'text' => 'send-profile',
            'url' => "tg://user?id=777000",
        ];
        $this->assertEquals(json_encode($button),json_encode($rawButton));
    }
}