<?php
return array(
    // set your paypal credential
    'client_id' => 'AcpvgnA6M9b7b4Gw3yfmy2B4J86XQ2f_9-YovrgPiloC37MEXZBjD_u1k92sYJIQYTr8ZlC3UAojuNH_',
    'secret' => 'EPr5lVA2bHky63Q9x62d2mqQyx66jnnHXzv1FStltsn0GX5eU-JJALsX-U0hEhkwvVqogI5yOGrhaqYz',
 
    /**
     * SDK configuration 
     */
    'settings' => array(
        /**
         * Available option 'sandbox' or 'live'
         */
        'mode' => 'live',
 
        /**
         * Specify the max request time in seconds
         */
        'http.ConnectionTimeOut' => 30,
 
        /**
         * Whether want to log to a file
         */
        'log.LogEnabled' => true,
 
        /**
         * Specify the file that want to write on
         */
        'log.FileName' => storage_path() . '/logs/paypal.log',
 
        /**
         * Available option 'FINE', 'INFO', 'WARN' or 'ERROR'
         *
         * Logging is most verbose in the 'FINE' level and decreases as you
         * proceed towards ERROR
         */
        'log.LogLevel' => 'FINE'
    ),
);