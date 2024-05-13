<?php declare(strict_types=1);

namespace Reymon\EasyKeyboard\Test\Buttons;

use PHPUnit\Framework\TestCase;
use Reymon\EasyKeyboard\Button\KeyboardButton;
use Reymon\EasyKeyboard\Tools\PollType;

class KeyboardButtonTest extends TestCase
{
    public function testPeer(): void
    {
        $button1 = KeyboardButton::PeerUsers('hello', 0);
        $button2 = KeyboardButton::PeerGroup('hello', 0);
        $button3 = KeyboardButton::PeerChannel('hello', 0);
        $rawButton1 = [
            'text' => 'hello',
            'request_users' => [
                'request_id'       => 0,
                'request_name'     => false,
                'request_username' => false,
                'request_photo'    => false,
                'max_quantity'     => 1,
            ]
        ];
        $rawButton2 = [
            'text' => 'hello',
            'request_chat' => [
                'chat_is_channel'  => false,
                'request_id'       => 0,
                'request_title'    => false,
                'request_username' => false,
                'request_photo'    => false
            ]
        ];
        $rawButton3 = [
            'text' => 'hello',
            'request_chat' => [
                'chat_is_channel'  => true,
                'request_id' => 0,
                'request_title'    => false,
                'request_username' => false,
                'request_photo'    => false
            ]
        ];
        $this->assertEquals(\json_encode($button1), \json_encode($rawButton1));
        $this->assertEquals(\json_encode($button2), \json_encode($rawButton2));
        $this->assertEquals(\json_encode($button3), \json_encode($rawButton3));
    }

    public function testWebApp(): void
    {
        $button = KeyboardButton::WebApp('hello', 'https://example.com');
        $rawButton = [
            'text'    => 'hello',
            'web_app' => [
                'url' => 'https://example.com'
            ],
        ];
        $this->assertEquals(\json_encode($button), \json_encode($rawButton));
    }

    public function testText(): void
    {
        $button = KeyboardButton::Text('hello');
        $rawButton = [
            'text' => 'hello'
        ];
        $this->assertEquals(\json_encode($button), \json_encode($rawButton));
    }

    public function testPhone(): void
    {
        $button = KeyboardButton::Phone('send-phone');
        $rawButton = [
            'text'            => 'send-phone',
            'request_contact' => true,
        ];
        $this->assertEquals(\json_encode($button), \json_encode($rawButton));
    }

    public function testLocation(): void
    {
        $button = KeyboardButton::Location('send-location');
        $rawButton = [
            'text'            => 'send-location',
            'request_location' => true,
        ];
        $this->assertEquals(\json_encode($button), \json_encode($rawButton));
    }

    public function testPoll(): void
    {
        $button = KeyboardButton::Poll('send-poll', PollType::QUIZ);
        $rawButton = [
            'text'            => 'send-poll',
            'request_poll' => PollType::QUIZ,
        ];
        $this->assertEquals(\json_encode($button), \json_encode($rawButton));
    }

    public function testProfile(): void
    {
        $button = KeyboardButton::Profile('send-profile', 777000);
        $rawButton = [
            'text' => 'send-profile',
            'url' => "tg://user?id=777000",
        ];
        $this->assertEquals(\json_encode($button), \json_encode($rawButton));
    }
}
