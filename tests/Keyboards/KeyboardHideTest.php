<?php declare(strict_types=1);

namespace Reymon\EasyKeyboard\Test\Keyboards;

use PHPUnit\Framework\TestCase;
use Reymon\EasyKeyboard\KeyboardTypes\KeyboardHide;

class KeyboardHideTest extends TestCase
{
    public function testHide(): void
    {
        $button = KeyboardHide::new();
        $rawButton = [
            'remove_keyboard' => []
        ];
        $this->assertEquals(\json_encode($rawButton), \json_encode($rawButton));
    }
}
