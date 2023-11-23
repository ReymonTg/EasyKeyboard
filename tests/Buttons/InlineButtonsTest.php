<?php

namespace Reymon\EasyKeyboard\Test\Buttons;

use PHPUnit\Framework\TestCase;
use Reymon\EasyKeyboard\ButtonTypes\InlineButton;

class InlineButtonsTest extends TestCase
{
    public function testBuy()
    {
        $button = InlineButton::Buy('hello');
        $rawButton = [
            'text' => 'hello',
            'pay' => true,
        ];
        $this->assertEquals(json_encode($button), json_encode($rawButton));
    }

    public function testGame()
    {
        $button = InlineButton::Game('hello');
        $rawButton = [
            'text' => 'hello',
            'callback_game' => '',
        ];
        $this->assertEquals(json_encode($button), json_encode($rawButton));
    }

    public function testUrl()
    {
        $button = InlineButton::Url('hello', 'https://example.com');
        $rawButton = [
            'text' => 'hello',
            'url' => 'https://example.com',
        ];
        $this->assertEquals(json_encode($button), json_encode($rawButton));
    }

    public function testCallbackData()
    {
        $button = InlineButton::CallBack('hello', 'hello-callback');
        $rawButton = [
            'text' => 'hello',
            'callback_data' => 'hello-callback',
        ];
        $this->assertEquals(json_encode($button), json_encode($rawButton));
    }

    public function testLogin()
    {
        $button1 = InlineButton::Login('please-login', 'https://example.com');
        $rawButton1 = [
            'login_url' => [
                'url' => 'https://example.com',
                'request_write_access' => false,
            ],
            'text' => 'please-login',
        ];
        $this->assertEquals(json_encode($button1), json_encode($rawButton1));
    }
}