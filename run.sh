#!/bin/sh


clear
echo "Hello My Friend ;-)"
echo "please select your VM machine !"
read name
echo "Okey We Work On, $name?"
docker-machine start $name
docker-machine env $name
eval $(docker-machine env $name)
cd /Users/sberrich/Desktop/webserver
sh setup.sh
