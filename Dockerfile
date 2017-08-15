FROM centos:7

COPY enterpoint.sh /root/enterpoint.sh
ENV TIMEZONE            Asia/Tokyo

RUN rpm --import /etc/pki/rpm-gpg/RPM-GPG-KEY-CentOS-7  && \
    yum install -y git php php-mysql php-mbstring php-pdo php-gd php-xml php-xmlrpc && \
    yum install -y cronie crontabs && \
    sed -i '/session    required   pam_loginuid.so/c\#session    required   pam_loginuid.so' /etc/pam.d/crond && \
    cp /usr/share/zoneinfo/${TIMEZONE} /etc/localtime && \
    echo "${TIMEZONE}" > /etc/timezone && \
    chmod +x /root/enterpoint.sh && \
    ## install minify
    yum install -y go && \
    mkdir /go && \
    export GOPATH=/go && \
    go get github.com/tdewolff/minify/cmd/minify && \
    mv /go/bin/minify /usr/bin/minify && \
    rm -rf /go && \
    yum remove -y cpp gcc  glibc-devel glibc-headers golang-bin golang-src kernel-headers libgomp libmpc mpfr && \

    yum clean all


ENTRYPOINT ["/root/enterpoint.sh"]

# docker run -it --link mysql:mysql -v $(pwd)/upload/:/upload -v $(pwd)/application/config:/config -p 89:80 fendoujp/fendoujp sh
# docker run -it --link mysql:mysql -v $(pwd):/fendoujp -v $(pwd)/application/config:/config -p 89:80 fendoujp sh
