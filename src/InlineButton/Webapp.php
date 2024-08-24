<?php declare(strict_types=1);

/**
 * This file is part of Reymon.
 * Reymon is free software: you can redistribute it and/or modify it under the terms of the GNU General Public License as published by the Free Software Foundation, either version 3 of the License, or (at your option) any later version.
 * Reymon is distributed in the hope that it will be useful, but WITHOUT ANY WARRANTY; without even the implied warranty of MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.
 * See the GNU General Public License for more details.
 * If not, see <http://www.gnu.org/licenses/>.
 *
 * @author    AhJ <AmirHosseinJafari8228@gmail.com>
 * @copyright Copyright (c) 2023, ReymonTg
 * @license   https://choosealicense.com/licenses/gpl-3.0/ GPLv3
 */

namespace Reymon\EasyKeyboard\InlineButton;

use Reymon\EasyKeyboard\InlineButton;
use Reymon\EasyKeyboard\Utils\Url;

/**
 * Represents inline webapp button.
 */
final class Webapp extends InlineButton
{
    use Url;

    /**
     * @param string $text Label text on the button
     * @param string $url  An HTTPS URL of a Web App to be opened with additional data as specified in [Initializing Web Apps](https://core.telegram.org/bots/webapps#initializing-mini-apps)
     */
    public function __construct(string $text, private string $url)
    {
        parent::__construct($text);
    }

    /**
     * Create Inline webapp button.
     *
     * @param string $text Label text on the button
     * @param string $url  An HTTPS URL of a Web App to be opened with additional data as specified in [Initializing Web Apps](https://core.telegram.org/bots/webapps#initializing-mini-apps)
     */
    public static function new(string $text, string $url): self
    {
        return new static($text, $url);
    }

    /**
     * @internal
     */
    public function jsonSerialize(): array
    {
        return [
            'text'    => $this->text,
            'web_app' => ['url' => $this->url]
        ];
    }
}
