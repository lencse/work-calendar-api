<?php

function env(string $key, string $default = ''): string
{
    return $_ENV[$key] ?? $default;
}
