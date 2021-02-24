<?php

namespace Weather;

/**
 * Weather code and icons specification
 * @package Weather
 */
class Icon
{

    /**
     * Code sent from weather open map API for weather condition Thunderstorm in range 200-299
     */
    private const CODE_2xx = '2xx';

    /**
     * Code sent from weather open map API for weather condition Drizzle in range 300-399
     */
    private const CODE_3xx = '3xx';

    /**
     * Code sent from weather open map API for weather condition Rain in range 500-599
     */
    private const CODE_5xx = '5xx';

    /**
     * Code sent from weather open map API for weather condition Snow in range 600-699
     */
    private const CODE_6xx = '6xx';

    /**
     * Code sent from weather open map API for weather condition Atmosphere in range 700-799
     */
    private const CODE_7xx = '7xx';

    /**
     * Code sent from weather open map API for weather condition Clouds in range 801-809
     */
    private const CODE_80x = '80x';

    /**
     * Code sent from weather open map API for weather condition Clear sky
     */
    private const CODE_800 = '800';

    private const ICON_THUNDER = "
      _, .--.
     (  / (  '-.
     .-=-.    ) -.
    /   (  .' .   \
    \ ( ' ,_) ) \_/
     (_ , /\  ,_/
       '--\ `\--`
          _\ _\
          `\ \
           _\_\
           `\\\\
             \\\\
         -.'.`\.'.-" . PHP_EOL;

    private const ICON_DRIZZLE = "
      / / / / / /
    / / / / / /" . PHP_EOL;

    private const ICON_RAIN = "
        _(  )_( )_
       (_   _    _)
      / /(_) (__)
     / / / / / /
    / / / / / /" . PHP_EOL;

    private const ICON_SNOW = "
       _\/  \/_
        _\/\/_
    _\_\_\/\/_/_/_
     / /_/\/\_\ \
        _/\/\_
        /\  /\
       '      '" . PHP_EOL;

    private const ICON_TORNADO =
        "--_-_-_-_---
       -_-_-_
        -_-_-
         -__-
         _-_
         _-
        -_
        _-_" . PHP_EOL;

    private const ICON_CLEAR_SKY = "
             | 
       '.  _..._  .'          _.._    
         .'     '.          .' .-'`   
    '-. /         \ .-'    /  /        
        \         /        |  |      
     .-' '._   _.' '-.     \  \     
        .   ```   .         '._'-._    
       '     |     '            ```  " . PHP_EOL;

    private const ICON_CLOUDS = "
             .-~~~-.
     .- ~ ~-(       )_ _
    /                     ~ -.
                               \
    \                         .'
      ~- . _____________ . -~" . PHP_EOL;

    /**
     * Maps weather condition code to icon
     */
    private const CODE_TO_ICON = [
        self::CODE_2xx => self::ICON_THUNDER,
        self::CODE_3xx => self::ICON_DRIZZLE,
        self::CODE_5xx => self::ICON_RAIN,
        self::CODE_6xx => self::ICON_SNOW,
        self::CODE_7xx => self::ICON_TORNADO,
        self::CODE_80x => self::ICON_CLOUDS,
        self::CODE_800 => self::ICON_CLEAR_SKY,
    ];

    /**
     * Provides icon for weather condition code
     *
     * @param string $code Weather condition code
     * @return string Icon string
     */
    public static function getIconForCode(string $code): string
    {
        if (strpos($code, "2") === 0) {
            return self::CODE_TO_ICON[self::CODE_2xx];
        } elseif (strpos($code, "3") === 0) {
            return self::CODE_TO_ICON[self::CODE_3xx];
        } elseif (strpos($code, "5") === 0) {
            return self::CODE_TO_ICON[self::CODE_5xx];
        } elseif (strpos($code, "6") === 0) {
            return self::CODE_TO_ICON[self::CODE_6xx];
        } elseif (strpos($code, "7") === 0) {
            return self::CODE_TO_ICON[self::CODE_7xx];
        } elseif ($code === '800') {
            return self::CODE_TO_ICON[self::CODE_800];
        } else {
            return self::CODE_TO_ICON[self::CODE_80x];
        }
    }

}