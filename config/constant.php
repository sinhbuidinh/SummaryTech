<?php

defined('MESSAGE_TYPE_SUCCESS') or define('MESSAGE_TYPE_SUCCESS', 'success');
defined('MESSAGE_TYPE_ERROR') or define('MESSAGE_TYPE_ERROR', 'error');
defined('MESSAGE_TYPE_WARNING') or define('MESSAGE_TYPE_WARNING', 'warning');
defined('MESSAGE_TYPE_INFO') or define('MESSAGE_TYPE_INFO', 'info');

defined('CONFIG_ARR_BY_KEY') or define('CONFIG_ARR_BY_KEY', 'key');
defined('CONFIG_ARR_BY_CODE') or define('CONFIG_ARR_BY_CODE', 'code');
defined('CONFIG_ARR_BY_NAME') or define('CONFIG_ARR_BY_NAME', 'name');

defined('CONFIG_ARR') or define('CONFIG_ARR', [
    CONFIG_ARR_BY_KEY,
    CONFIG_ARR_BY_CODE,
    CONFIG_ARR_BY_NAME
]);
