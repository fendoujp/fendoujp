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

if [[ ! -d /fendoujp/assets/front/minify ]]; then
  mkdir /fendoujp/assets/front/minify
fi

minify -o /fendoujp/assets/front/minify/minify.css \
        /fendoujp/assets/front/css/bootstrap.min.css \
        /fendoujp/assets/front/css/icofont.css \
        /fendoujp/assets/front/css/font-awesome.min.css \
        /fendoujp/assets/front/css/owl.carousel.css \
        /fendoujp/assets/front/css/animate.css \
        /fendoujp/assets/front/css/meanmenu.css \
        /fendoujp/assets/front/css/prettyPhoto.css \
        /fendoujp/assets/front/font/stylesheet.css \
        /fendoujp/assets/front/css/style.css \
        /fendoujp/assets/front/css/responsive.css \
        /fendoujp/assets/front/css/child/factory.css \
        /fendoujp/assets/front/css/gdt-style.css


minify -o /fendoujp/assets/front/minify/minify.js \
        /fendoujp/assets/front/js/jquery.min.js \
        /fendoujp/assets/front/js/jquery.meanmenu.js \
        /fendoujp/assets/front/js/jquery.sticky.js \
        /fendoujp/assets/front/js/waypoints.min.js \
        /fendoujp/assets/front/js/bootstrap.min.js \
        /fendoujp/assets/front/js/jquery.counterup.min.js \
        /fendoujp/assets/front/js/owl.carousel.min.js \
        /fendoujp/assets/front/js/jquery.prettyPhoto.js \
        /fendoujp/assets/front/js/slick.min.js \
        /fendoujp/assets/front/js/main.js \
        /fendoujp/assets/front/js/color-settings.js

cp -rf /fendoujp/assets/* /assets &
crond &

php -S 0.0.0.0:80
