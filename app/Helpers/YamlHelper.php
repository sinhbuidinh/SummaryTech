<?php

function getKubunCustom(
    $link_config,
    $element,
    $key = CONFIG_ARR_BY_KEY,
    $value = CONFIG_ARR_BY_NAME,
    $only = []
) {
    if (!in_array($key, CONFIG_ARR_KEYS)
        || !in_array($value, CONFIG_ARR_VALS)
    ) {
        return [];
    }

    //read file in config -> $link
    $app_path = config_path()?? '';

    //parse str to arr
    $link_arr = explode('.', $link_config);

    //get file location
    $file_location = $app_path. '\\' . implode('\\', $link_arr). '.yml';

    //get content
    $yaml_contents = Symfony\Component\Yaml\Yaml::parse(file_get_contents($file_location));

    //get result
    $result = array_get($yaml_contents, $element);

    //key = value of key default
    $key_replace = array_keys($result[CONFIG_ARR_BY_CODE]);

    //get key by $key
    $keys = array_get($result, $key, $key_replace);
    //get value by $value
    $values = array_get($result, $value);

    if (!empty($only)) {
        $keys   = array_only($keys, $only);
        $values = array_only($values, $only);
    }

    //combine to get array result
    $key2val = array_combine($keys, $values);

    return $key2val;
}
