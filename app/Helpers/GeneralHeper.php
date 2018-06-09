<?php

function getService($name)
{
    if ($this->app->has($name)) {
        return $this->app->make($name);
    }

    return null;
}