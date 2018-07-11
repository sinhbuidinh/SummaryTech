<?php

defined('MESSAGE_TYPE_SUCCESS') or define('MESSAGE_TYPE_SUCCESS', 'success');
defined('MESSAGE_TYPE_ERROR') or define('MESSAGE_TYPE_ERROR', 'error');
defined('MESSAGE_TYPE_WARNING') or define('MESSAGE_TYPE_WARNING', 'warning');
defined('MESSAGE_TYPE_INFO') or define('MESSAGE_TYPE_INFO', 'info');

defined('CONFIG_ARR_BY_KEY') or define('CONFIG_ARR_BY_KEY', 'key');
defined('CONFIG_ARR_BY_CODE') or define('CONFIG_ARR_BY_CODE', 'code');
defined('CONFIG_ARR_BY_NAME') or define('CONFIG_ARR_BY_NAME', 'name');

defined('CONFIG_ARR_KEYS') or define('CONFIG_ARR_KEYS', [
    CONFIG_ARR_BY_KEY,
    CONFIG_ARR_BY_CODE,
    CONFIG_ARR_BY_NAME
]);

defined('CONFIG_ARR_VALS') or define('CONFIG_ARR_VALS', [
    CONFIG_ARR_BY_CODE,
    CONFIG_ARR_BY_NAME
]);

defined('DATE_FORMAT_YMD') or define('DATE_FORMAT_YMD', 'Ymd');
defined('DATE_FORMAT_YM') or define('DATE_FORMAT_YM', 'Ym');
defined('DATE_FORMAT_YMD_SUB') or define('DATE_FORMAT_YMD_SUB', 'Y-m-d');
defined('DATE_FORMAT_YMD_HIS') or define('DATE_FORMAT_YMD_HIS', 'Y-m-d\TH:i:s');
defined('DATE_FORMAT_YMD_DOT') or define('DATE_FORMAT_YMD_DOT', 'Y.m.d');

defined('DEFAULT_TIMEZONE') or define('DEFAULT_TIMEZONE', 'Asia/Ho_Chi_Minh');
