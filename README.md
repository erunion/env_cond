# env_cond

A conditional wrapper for the stock env() command in Laravel. If the environment variable is not present, the default
value returned is dependent upon the current application environment.

## Usage

Say you have a `config/services.php` that looks like this:

```
<?php

return [
    'aws' => [
        's3_bucket' => env_cond('AWS_S3_BUCKET', 'cdn.app.com')
    ]
];
```

With this, you'll need to store your development S3 bucket, `dev.app` in `.env-dist` so everyone on your team has that
when they make their personal `.env` file. Now say that you need to change the default, you'll need to communicate with
your entire team to change their default over to `dev2.app`.

With `env_cond()`, developers just need to worry about settings that they **actually** want to change.

```
<?php

return [
    'aws' => [
        's3_bucket' => env_cond('AWS_S3_BUCKET', 'dev.app', 'cdn.app.com')
    ]
];
```

Here, if a developer isn't working with a custom S3 bucket locally, they don't need to add `AWS_S3_BUCKET="dev.app"`
into their `.env` file. If their environment is `dev`, or `testing`, their bucket will automatically be `dev.app`.

This makes your `.env-dist` and `.env` files a lot cleaner.
