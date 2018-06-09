<?php

function getService($name)
{
    if (app()->has($name)) {
        return app()->make($name);
    }

    return null;
}
