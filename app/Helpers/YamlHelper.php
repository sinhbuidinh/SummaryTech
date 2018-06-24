<?php

function getKubunCustom(
    $link_config,
    $element,
    $key = CONFIG_ARR_BY_KEY,
    $value = CONFIG_ARR_BY_NAME
) {
    if (!in_array($key, CONFIG_ARR)
        || !in_array($value, CONFIG_ARR)
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

    return $result;
}
