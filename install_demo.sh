#!/bin/sh

ENV="prod"
if [ $1 ]
then
    ENV="$1"
fi
 
echo "get data for playground demo"
git clone https://github.com/gregorybesson/playground-demo.git data/playground-demo > /dev/null
cp -R data/playground-demo/media/* public/media/.
chmod -R 777 public/media

php vendor/doctrine/doctrine-module/bin/doctrine-module.php orm:schema-tool:drop --force
php vendor/doctrine/doctrine-module/bin/doctrine-module.php dba:import data/playground-demo/sql/demo.sql
php vendor/doctrine/doctrine-module/bin/doctrine-module.php orm:schema-tool:update --force
php public/index.php assetic setup
php public/index.php assetic build

rm -rf data/playground-demo
