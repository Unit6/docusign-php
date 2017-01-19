<?php
/*
 * This file is part of the DocuSign package.
 *
 * (c) Unit6 <team@unit6websites.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Unit6\DocuSign\Model;

use Unit6\DocuSign;

/**
 * DocuSign Tab Model Class.
 *
 * @author Unit6 <team@unit6websites.com>
 */
class Tab extends DocuSign\Model
{
    // anchorUnits
    const ANCHOR_UNIT_PX = 'pixels';
    const ANCHOR_UNIT_MM = 'mms';
    const ANCHOR_UNIT_CM = 'cms';
    const ANCHOR_UNIT_IN = 'inches';

    // font
    const FONT_ARIAL           = 'Arial';
    const FONT_ARIAL_NARROW    = 'ArialNarrow';
    const FONT_CALIBRI         = 'Calibri';
    const FONT_COURIER_NEW     = 'CourierNew';
    const FONT_GARAMOND        = 'Garamond';
    const FONT_GEORGIA         = 'Georgia';
    const FONT_HELVETICA       = 'Helvetica';
    const FONT_LUCIDA_CONSOLE  = 'LucidaConsole';
    const FONT_TAHOMA          = 'Tahoma';
    const FONT_TIMES_NEW_ROMAN = 'TimesNewRoman';
    const FONT_TREBUCHET       = 'Trebuchet';
    const FONT_VERDANA         = 'Verdana';

    // fontColor
    const FONT_COLOR_BLACK       = 'Black';
    const FONT_COLOR_BRIGHT_BLUE = 'BrightBlue';
    const FONT_COLOR_BRIGHT_RED  = 'BrightRed';
    const FONT_COLOR_DARK_GREEN  = 'DarkGreen';
    const FONT_COLOR_DARK_RED    = 'DarkRed';
    const FONT_COLOR_GOLD        = 'Gold';
    const FONT_COLOR_GREEN       = 'Green';
    const FONT_COLOR_NAVY_BLUE   = 'NavyBlue';
    const FONT_COLOR_PURPLE      = 'Purple';
    const FONT_COLOR_WHITE       = 'White';

    // fontSize
    const FONT_SIZE_7  = 'Size7';
    const FONT_SIZE_8  = 'Size8';
    const FONT_SIZE_9  = 'Size9';
    const FONT_SIZE_10 = 'Size10';
    const FONT_SIZE_11 = 'Size11';
    const FONT_SIZE_12 = 'Size12';
    const FONT_SIZE_14 = 'Size14';
    const FONT_SIZE_16 = 'Size16';
    const FONT_SIZE_18 = 'Size18';
    const FONT_SIZE_20 = 'Size20';
    const FONT_SIZE_22 = 'Size22';
    const FONT_SIZE_24 = 'Size24';
    const FONT_SIZE_26 = 'Size26';
    const FONT_SIZE_28 = 'Size28';
    const FONT_SIZE_36 = 'Size36';
    const FONT_SIZE_48 = 'Size48';
    const FONT_SIZE_72 = 'Size72';


    public function __construct(array $row = array())
    {
        $this->assignData($row);
    }

    public function setAnchorUnitsToPixels()
    {
        $this->setAnchorUnits(self::ANCHOR_UNIT_PX);
    }

    public function setAnchorUnitsToCentimeters()
    {
        $this->setAnchorUnits(self::ANCHOR_UNIT_CM);
    }

    public function setAnchorUnitsToMillimeters()
    {
        $this->setAnchorUnits(self::ANCHOR_UNIT_MM);
    }

    public function setAnchorUnitsToInches()
    {
        $this->setAnchorUnits(self::ANCHOR_UNIT_IN);
    }
}