<?php declare(strict_types=1);

namespace Reymon\EasyKeyboard\Test\Keyboards;

use PHPUnit\Framework\TestCase;
use Reymon\EasyKeyboard\Keyboard\KeyboardHide;

class KeyboardHideTest extends TestCase
{
    public function testHide(): void
    {
        $button = KeyboardHide::new();
        $rawButton = [
            'remove_keyboard' => true
        ];
        $this->assertJsonStringEqualsJsonString(\json_encode($button), \json_encode($rawButton));
    }
}
