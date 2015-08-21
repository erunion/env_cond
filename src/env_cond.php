<?php

/**
 * A conditional wrapper for the stock env() command in Laravel. If the environment variable is not present, the default
 * value returned is dependent upon the current application environment.
 * @param  string $key
 * @param  mixed $devDefault
 * @param  mixed $liveDefault
 * @return mixed
 */
function env_cond($key, $devDefault, $liveDefault) {
    // env() defaults to null, so since we want to make sure the environment variable doesn't exist, let's default to
    // something that, can reasonably be assumed, will never be used by anyone as an environment variable.
    $data = env($key, '<DOES NOT EXIST>');
    if ($data !== false && $data !== '<DOES NOT EXIST>') {
        return $data;
    }

    // Because this function is used exclusively in our configuration files, and because configuration files are loaded
    // within Illuminate\Foundation\Bootstrap\LoadConfiguration, we're using env('APP_ENV') instead of
    // App::environment() since the App facade hasn't been set up yet.
    if (in_array(env('APP_ENV'), ['dev', 'local', 'testing'])) {
        return $devDefault;
    }

    return $liveDefault;
}
