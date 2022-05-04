<?php


namespace App\Helper;


class ExtensionAllowedHelper
{
    public static function extensionAllowed()
    {
        return ['jpg', 'JPG', 'png', 'PNG', 'jpeg', 'JPEG', 'gif', 'GIF', 'svg', 'SVG'];
    }
}
