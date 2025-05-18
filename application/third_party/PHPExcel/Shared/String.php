<?php
/**
 * PHPExcel
 *
 * Copyright (c) 2006 - 2014 PHPExcel
 *
 * This library is free software; you can redistribute it and/or
 * modify it under the terms of the GNU Lesser General Public
 * License as published by the Free Software Foundation; either
 * version 2.1 of the License, or (at your option) any later version.
 *
 * This library is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the GNU
 * Lesser General Public License for more details.
 *
 * You should have received a copy of the GNU Lesser General Public
 * License along with this library; if not, write to the Free Software
 * Foundation, Inc., 51 Franklin Street, Fifth Floor, Boston, MA  02110-1301  USA
 *
 * @category   PHPExcel
 * @package    PHPExcel_Shared
 * @copyright  Copyright (c) 2006 - 2014 PHPExcel (http://www.codeplex.com/PHPExcel)
 * @license    http://www.gnu.org/licenses/old-licenses/lgpl-2.1.txt    LGPL
 * @version    1.8.0, 2014-03-02
 */


/**
 * PHPExcel_Shared_String
 *
 * @category   PHPExcel
 * @package    PHPExcel_Shared
 * @copyright  Copyright (c) 2006 - 2014 PHPExcel (http://www.codeplex.com/PHPExcel)
 */
class PHPExcel_Shared_String
{
    /**    Constants                */
    /**    Regular Expressions        */
    //    Fraction
    const STRING_REGEXP_FRACTION    = '(-?)(\d+)\s+(\d+\/\d+)';

    /**
     * Control characters array
     *
     * @var string[]
     */
    private static $_controlCharacters = array();

    /**
     * SYLK Characters array
     *
     * $var array
     */
    private static $_SYLKCharacters = array();

    /**
     * Decimal separator
     *
     * @var string
     */
    private static $_decimalSeparator;

    /**
     * Thousands separator
     *
     * @var string
     */
    private static $_thousandsSeparator;

    /**
     * Currency code
     *
     * @var string
     */
    private static $_currencyCode;

    /**
     * Is mbstring extension avalable?
     *
     * @var boolean
     */
    private static $_isMbstringEnabled;

    /**
     * Is iconv extension avalable?
     *
     * @var boolean
     */
    private static $_isIconvEnabled;

    /**
     * Build control characters array
     */
    private static function _buildControlCharacters() {
        for ($i = 0; $i <= 31; ++$i) {
            if ($i != 9 && $i != 10 && $i != 13) {
                $find = '_x' . sprintf('%04s' , strtoupper(dechex($i))) . '_';
                $replace = chr($i);
                self::$_controlCharacters[$find] = $replace;
            }
        }
    }

    /**
     * Build SYLK characters array
     */
    private static function _buildSYLKCharacters()
    {
        self::$_SYLKCharacters = array(
            "\x1B 0"  => chr(0),
            "\x1B 1"  => chr(1),
            "\x1B 2"  => chr(2),
            "\x1B 3"  => chr(3),
            "\x1B 4"  => chr(4),
            "\x1B 5"  => chr(5),
            "\x1B 6"  => chr(6),
            "\x1B 7"  => chr(7),
            "\x1B 8"  => chr(8),
            "\x1B 9"  => chr(9),
            "\x1B :"  => chr(10),
            "\x1B ;"  => chr(11),
            "\x1B <"  => chr(12),
            "\x1B ="  => chr(13),
            "\x1B >"  => chr(14),
            "\x1B ?"  => chr(15),
            "\x1B!0"  => chr(16),
            "\x1B!1"  => chr(17),
            "\x1B!2"  => chr(18),
            "\x1B!3"  => chr(19),
            "\x1B!4"  => chr(20),
            "\x1B!5"  => chr(21),
            "\x1B!6"  => chr(22),
            "\x1B!7"  => chr(23),
            "\x1B!8"  => chr(24),
            "\x1B!9"  => chr(25),
            "\x1B!:"  => chr(26),
            "\x1B!;"  => chr(27),
            "\x1B!<"  => chr(28),
            "\x1B!="  => chr(29),
            "\x1B!>"  => chr(30),
            "\x1B!?"  => chr(31),
            "\x1B'?"  => chr(127),
            "\x1B(0"  => '€', // 128 in CP1252
            "\x1B(2"  => '‚', // 130 in CP1252
            "\x1B(3"  => 'ƒ', // 131 in CP1252
            "\x1B(4"  => '„', // 132 in CP1252
            "\x1B(5"  => '…', // 133 in CP1252
            "\x1B(6"  => '†', // 134 in CP1252
            "\x1B(7"  => '‡', // 135 in CP1252
            "\x1B(8"  => 'ˆ', // 136 in CP1252
            "\x1B(9"  => '‰', // 137 in CP1252
            "\x1B(:"  => 'Š', // 138 in CP1252
            "\x1B(;"  => '‹', // 139 in CP1252
            "\x1BNj"  => 'Œ', // 140 in CP1252
            "\x1B(>"  => 'Ž', // 142 in CP1252
            "\x1B)1"  => ''', // 145 in CP1252
            "\x1B)2"  => ''', // 146 in CP1252
            "\x1B)3"  => '"', // 147 in CP1252
            "\x1B)4"  => '"', // 148 in CP1252
            "\x1B)5"  => '•', // 149 in CP1252
            "\x1B)6"  => '–', // 150 in CP1252
            "\x1B)7"  => '—', // 151 in CP1252
            "\x1B)8"  => '˜', // 152 in CP1252
            "\x1B)9"  => '™', // 153 in CP1252
            "\x1B):"  => 'š', // 154 in CP1252
            "\x1B);"  => '›', // 155 in CP1252
            "\x1BNz"  => 'œ', // 156 in CP1252
            "\x1B)>"  => 'ž', // 158 in CP1252
            "\x1B)?"  => 'Ÿ', // 159 in CP1252
            "\x1B*0"  => ' ', // 160 in CP1252
            "\x1BN!"  => '¡', // 161 in CP1252
            "\x1BN\"" => '¢', // 162 in CP1252
            "\x1BN#"  => '£', // 163 in CP1252
            "\x1BN("  => '¤', // 164 in CP1252
            "\x1BN%"  => '¥', // 165 in CP1252
            "\x1B*6"  => '¦', // 166 in CP1252
            "\x1BN'"  => '§', // 167 in CP1252
            "\x1BNH " => '¨', // 168 in CP1252
            "\x1BNS"  => '©', // 169 in CP1252
            "\x1BNc"  => 'ª', // 170 in CP1252
            "\x1BN+"  => '«', // 171 in CP1252
            "\x1B*<"  => '¬', // 172 in CP1252
            "\x1B*="  => '­', // 173 in CP1252
            "\x1BNR"  => '®', // 174 in CP1252
            "\x1B*?"  => '¯', // 175 in CP1252
            "\x1BN0"  => '°', // 176 in CP1252
            "\x1BN1"  => '±', // 177 in CP1252
            "\x1BN2"  => '²', // 178 in CP1252
            "\x1BN3"  => '³', // 179 in CP1252
            "\x1BNB " => '´', // 180 in CP1252
            "\x1BN5"  => 'µ', // 181 in CP1252
            "\x1BN6"  => '¶', // 182 in CP1252
            "\x1BN7"  => '·', // 183 in CP1252
            "\x1B+8"  => '¸', // 184 in CP1252
            "\x1BNQ"  => '¹', // 185 in CP1252
            "\x1BNk"  => 'º', // 186 in CP1252
            "\x1BN;"  => '»', // 187 in CP1252
            "\x1BN<"  => '¼', // 188 in CP1252
            "\x1BN="  => '½', // 189 in CP1252
            "\x1BN>"  => '¾', // 190 in CP1252
            "\x1BN?"  => '¿', // 191 in CP1252
            "\x1BNA"  => 'À', // 192 in CP1252
            "\x1BNB"  => 'Á', // 193 in CP1252
            "\x1BNC"  => 'Â', // 194 in CP1252
            "\x1BND"  => 'Ã', // 195 in CP1252
            "\x1BNE"  => 'Ä', // 196 in CP1252
            "\x1BNF"  => 'Å', // 197 in CP1252
            "\x1BNG"  => 'Æ', // 198 in CP1252
            "\x1BNH"  => 'Ç', // 199 in CP1252
            "\x1BNI"  => 'È', // 200 in CP1252
            "\x1BNJ"  => 'É', // 201 in CP1252
            "\x1BNK"  => 'Ê', // 202 in CP1252
            "\x1BNL"  => 'Ë', // 203 in CP1252
            "\x1BNM"  => 'Ì', // 204 in CP1252
            "\x1BNN"  => 'Í', // 205 in CP1252
            "\x1BNO"  => 'Î', // 206 in CP1252
            "\x1BNP"  => 'Ï', // 207 in CP1252
            "\x1BNQ"  => 'Ð', // 208 in CP1252
            "\x1BNR"  => 'Ñ', // 209 in CP1252
            "\x1BNS"  => 'Ò', // 210 in CP1252
            "\x1BNT"  => 'Ó', // 211 in CP1252
            "\x1BNU"  => 'Ô', // 212 in CP1252
            "\x1BNV"  => 'Õ', // 213 in CP1252
            "\x1BNW"  => 'Ö', // 214 in CP1252
            "\x1BNX"  => '×', // 215 in CP1252
            "\x1BNY"  => 'Ø', // 216 in CP1252
            "\x1BNZ"  => 'Ù', // 217 in CP1252
            "\x1BN["  => 'Ú', // 218 in CP1252
            "\x1BN\\" => 'Û', // 219 in CP1252
            "\x1BN]"  => 'Ü', // 220 in CP1252
            "\x1BN^"  => 'Ý', // 221 in CP1252
            "\x1BN_"  => 'Þ', // 222 in CP1252
            "\x1BN`"  => 'ß', // 223 in CP1252
            "\x1BNa"  => 'à', // 224 in CP1252
            "\x1BNb"  => 'á', // 225 in CP1252
            "\x1BNc"  => 'â', // 226 in CP1252
            "\x1BNd"  => 'ã', // 227 in CP1252
            "\x1BNe"  => 'ä', // 228 in CP1252
            "\x1BNf"  => 'å', // 229 in CP1252
            "\x1BNg"  => 'æ', // 230 in CP1252
            "\x1BNh"  => 'ç', // 231 in CP1252
            "\x1BNi"  => 'è', // 232 in CP1252
            "\x1BNj"  => 'é', // 233 in CP1252
            "\x1BNk"  => 'ê', // 234 in CP1252
            "\x1BNl"  => 'ë', // 235 in CP1252
            "\x1BNm"  => 'ì', // 236 in CP1252
            "\x1BNn"  => 'í', // 237 in CP1252
            "\x1BNo"  => 'î', // 238 in CP1252
            "\x1BNp"  => 'ï', // 239 in CP1252
            "\x1BNq"  => 'ð', // 240 in CP1252
            "\x1BNr"  => 'ñ', // 241 in CP1252
            "\x1BNs"  => 'ò', // 242 in CP1252
            "\x1BNt"  => 'ó', // 243 in CP1252
            "\x1BNu"  => 'ô', // 244 in CP1252
            "\x1BNv"  => 'õ', // 245 in CP1252
            "\x1BNw"  => 'ö', // 246 in CP1252
            "\x1BNx"  => '÷', // 247 in CP1252
            "\x1BNy"  => 'ø', // 248 in CP1252
            "\x1BNz"  => 'ù', // 249 in CP1252
            "\x1BN{"  => 'ú', // 250 in CP1252
            "\x1BN|"  => 'û', // 251 in CP1252
            "\x1BN}"  => 'ü', // 252 in CP1252
            "\x1BN~"  => 'ý', // 253 in CP1252
            "\x1BN\x7F" => 'þ', // 254 in CP1252
            "\x1B+?"  => 'ÿ', // 255 in CP1252
        );
    }

    /**
     * Get whether mbstring extension is available
     *
     * @return boolean
     */
    public static function getIsMbstringEnabled()
    {
        if (isset(self::$_isMbstringEnabled)) {
            return self::$_isMbstringEnabled;
        }

        self::$_isMbstringEnabled = function_exists('mb_convert_encoding') ?
            true : false;

        return self::$_isMbstringEnabled;
    }

    /**
     * Get whether iconv extension is available
     *
     * @return boolean
     */
    public static function getIsIconvEnabled()
    {
        if (isset(self::$_isIconvEnabled)) {
            return self::$_isIconvEnabled;
        }

        // Fail if iconv doesn't exist
        if (!function_exists('iconv')) {
            self::$_isIconvEnabled = false;
            return false;
        }

        // Sometimes iconv is not working, and e.g. iconv('UTF-8', 'UTF-16LE', 'x') just returns false,
        // we cannot use iconv in that case either (http://bugs.php.net/bug.php?id=48147)
        self::$_isIconvEnabled = (@iconv('UTF-8', 'UTF-16LE', 'x')) ? true : false;

        return self::$_isIconvEnabled;
    }

    /**
     * Build character sets for use with SYLK files
     */
    public static function buildCharacterSets() {
        if(empty(self::$_controlCharacters)) {
            self::_buildControlCharacters();
        }
        if(empty(self::$_SYLKCharacters)) {
            self::_buildSYLKCharacters();
        }
    }
}
