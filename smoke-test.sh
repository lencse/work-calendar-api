#!/usr/bin/env bash

function main {
    php -S localhost:8220 public/index.php &
    local pid=$!
    sleep 3
    vendor/bin/cigar --url=http://localhost:8220/
    local code=$?
    echo $pid
    kill -9 $pid
    exit $code
}

main
