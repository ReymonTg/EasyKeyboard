<?php declare(strict_types=1);

namespace Reymon\EasyKeyboard\Test\Buttons;

use PHPUnit\Framework\TestCase;
use Reymon\EasyKeyboard\Button\InlineButton;
use Reymon\EasyKeyboard\Tools\InlineChoosePeer;

class InlineButtonsTest extends TestCase
{
    public function testBuy(): void
    {
        $button = InlineButton::Buy('hello');
        $rawButton = [
            'text' => 'hello',
            'pay' => true,
        ];
        $this->assertEquals(\json_encode($button), \json_encode($rawButton));
    }

    public function testGame(): void
    {
        $button = InlineButton::Game('hello');
        $rawButton = [
            'text' => 'hello',
            'callback_game' => '',
        ];
        $this->assertEquals(\json_encode($button), \json_encode($rawButton));
    }

    public function testUrl(): void
    {
        $button = InlineButton::Url('hello', 'https://example.com');
        $rawButton = [
            'text' => 'hello',
            'url' => 'https://example.com',
        ];
        $this->assertEquals(\json_encode($button), \json_encode($rawButton));
    }

    public function testCallbackData(): void
    {
        $button = InlineButton::CallBack('hello', 'hello-callback');
        $rawButton = [
            'text' => 'hello',
            'callback_data' => 'hello-callback',
        ];
        $this->assertEquals(\json_encode($button), \json_encode($rawButton));
    }

    public function testLogin(): void
    {
        $button1 = InlineButton::Login('please-login', 'https://example.com');
        $button2 = InlineButton::Login('please-login', 'https://example.com', 'bye');
        $button3 = InlineButton::Login('please-login', 'https://example.com', 'bye', 'mahdi', true);
        $rawButton1 = [
            'login_url' => [
                'url' => 'https://example.com',
                'request_write_access' => false,
            ],
            'text' => 'please-login',
        ];
        $rawButton2 = [
            'login_url' => [
                'url' => 'https://example.com',
                'forward_text' => 'bye',
                'request_write_access' => false,
            ],
            'text' => 'please-login',
        ];
        $rawButton3 = [
            'login_url' => [
                'url' => 'https://example.com',
                'forward_text' => 'bye',
                'bot_username' => 'mahdi',
                'request_write_access' => true,
            ],
            'text' => 'please-login',
        ];
        $this->assertEquals(\json_encode($button1), \json_encode($rawButton1));
        $this->assertEquals(\json_encode($button2), \json_encode($rawButton2));
        $this->assertEquals(\json_encode($button3), \json_encode($rawButton3));
    }

    public function testSwitchInline(): void
    {
        $button1 = InlineButton::SwitchInline('hello', 'test');
        $button2 = InlineButton::SwitchInline('hello', 'test', true);
        $button3 = InlineButton::SwitchInline('hello', 'test', filter: new InlineChoosePeer);
        $rawButton1 = [
            'switch_inline_query' => 'test',
            'text' => 'hello'
        ];
        $rawButton2 = [
            'switch_inline_query_current_chat' => 'test',
            'text' => 'hello'
        ];
        $peer = new InlineChoosePeer;
        $rawButton3 = [
            'switch_inline_query_chosen_chat' => [...$peer->jsonSerialize(),'query' => 'test'],
            'text' => 'hello'
        ];
        $this->assertEquals(\json_encode($button1), \json_encode($rawButton1));
        $this->assertEquals(\json_encode($button2), \json_encode($rawButton2));
        $this->assertEquals(\json_encode($button3), \json_encode($rawButton3));
    }
}
