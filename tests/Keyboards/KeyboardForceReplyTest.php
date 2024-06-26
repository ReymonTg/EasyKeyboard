<?php declare(strict_types=1);

namespace Reymon\EasyKeyboard\Test\Keyboards;

use Reymon\EasyKeyboard\Keyboard\KeyboardForceReply;
use Reymon\EasyKeyboard\Test\Buttons\KeyboardButtonTest;

class KeyboardForceReplyTest extends KeyboardButtonTest
{
    public function testForceReply(): void
    {
        $keyboard = KeyboardForceReply::new();
        $rawKeyboard = [
            'force_reply' => []
        ];
        $this->assertJsonStringEqualsJsonString(\json_encode($keyboard), \json_encode($rawKeyboard));
    }
}
