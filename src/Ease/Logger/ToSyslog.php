<?php

/**
 * Syslog logger handler
 *
 * @author    Vitex <vitex@hippy.cz>
 * @copyright 2009-2020 Vitex@hippy.cz (G)
 */

namespace Ease\Logger;

/**
 * Log to syslog.
 *
 * @author    Vitex <vitex@hippy.cz>
 * @copyright 2009-2020 Vitex@hippy.cz (G)
 */
class ToSyslog extends ToStd implements Loggingable {

    /**
     * Předvolená metoda logování.
     *
     * @var string
     */
    public $logType = 'syslog';

    /**
     * Saves obejct instace (singleton...).
     */
    private static $instance = null;

    /**
     * Logovací třída.
     *
     * @param string $logName syslog log source identifier
     */
    public function __construct($logName = null) {
            openlog( empty($logName) ? \Ease\Shared::appName() :  $logName  , \Ease\Functions::cfg('LOG_OPTION'), \Ease\Functions::cfg('LOG_FACILITY'));
    }

    /**
     * Obtain instance of Syslog loger
     * 
     * @return ToSyslog
     */
    public static function singleton() {
        if (!isset(self::$instance)) {
            self::$instance = new self(defined('EASE_APPNAME') ? constant('EASE_APPNAME') : 'EaseFramework');
        }
        return self::$instance;
    }

    /**
     * Output logline to syslog/messages by its type
     *
     * @param string $type    message type 'error' or anything else
     * @param string $logLine message to output
     */
    public function output($type, $logLine) {
        return syslog($type == 'error' ? constant('LOG_ERR') : constant('LOG_INFO'), $this->finalizeMessage($logLine));
    }

   /**
     * Last message check/modify point before output
     *
     * @param string $messageRaw
     *
     * @return string ready to use message
     */
    public function finalizeMessage($messageRaw) {
        return trim($messageRaw);
    }    
    
    /**
     * Uzavře chybové soubory.
     * 
     * @return boolean syslog close status
     */
    public function __destruct() {
        return closelog();
    }

}
