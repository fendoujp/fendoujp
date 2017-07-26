FROM alpine:3.6

COPY enterpoint.sh /root/enterpoint.sh
ENV TIMEZONE            Asia/Tokyo

RUN apk --update --no-progress add git tzdata \
  php5 php5-mysql php5-json php5-mcrypt php5-gd php5-xmlreader php5-xmlrpc php5-iconv php5-curl php5-ctype && \
  cp /usr/share/zoneinfo/${TIMEZONE} /etc/localtime && \
	echo "${TIMEZONE}" > /etc/timezone && \
  chmod +x /root/enterpoint.sh && \
  rm -rf /var/cache/apk/*

ENTRYPOINT ["/root/enterpoint.sh"]

# docker run -it --link mysql:mysql -v $(pwd)/upload/:/upload -v $(pwd)/application/config:/config -p 89:80 fendoujp/fendoujp sh
