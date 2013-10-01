#!/bin/bash

if [ -z "$environment" ]; then
    export environment=prod
fi

php vendor/bin/ruckus.php $@