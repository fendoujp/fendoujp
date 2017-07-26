FROM centos:7

COPY enterpoint.sh /root/enterpoint.sh
ENV TIMEZONE            Asia/Tokyo

RUN yum install -y git php php-mysql php-mbstring php-pdo php-gd php-xml php-xmlrpc && \
    yum install -y cronie crontabs && \
    sed -i '/session    required   pam_loginuid.so/c\#session    required   pam_loginuid.so' /etc/pam.d/crond && \
    cp /usr/share/zoneinfo/${TIMEZONE} /etc/localtime && \
    echo "${TIMEZONE}" > /etc/timezone && \
    chmod +x /root/enterpoint.sh && \
    yum clean all

ENTRYPOINT ["/root/enterpoint.sh"]

# docker run -it --link mysql:mysql -v $(pwd)/upload/:/upload -v $(pwd)/application/config:/config -p 89:80 fendoujp/fendoujp sh
