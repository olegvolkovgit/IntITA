#!/bin/sh

    ssh -oStrictHostKeyChecking=no -i /home/web/gitlab_access/intita_rsa "$@"
