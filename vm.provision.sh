#!/usr/bin/env bash
echo 'Start "vm.provision.sh"'

DBPASSWD=root

sudo mysqladmin -u root password $DBPASSWD
sudo service nginx restart

echo 'Provision complete.'