#!/bin/sh

if [[ ! -d /fendoujp ]]; then
  git clone https://github.com/fendoujp/fendoujp.git
  echo "0 8 * * * php /fendoujp/index.php sys_robot batch_rate" > /var/spool/cron/root
  ln -s /upload /fendoujp/upload
fi

cd /fendoujp

echo "checkout ."
git checkout .
echo "pull"
git pull


cp -f /config/database.php /fendoujp/application/config/database.php

crond &

php -S 0.0.0.0:80
