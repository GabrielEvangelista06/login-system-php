FROM centos/httpd

RUN yum install https://dl.fedoraproject.org/pub/epel/epel-release-latest-7.noarch.rpm -y
RUN yum install http://rpms.remirepo.net/enterprise/remi-release-7.rpm -y
RUN yum install yum-utils -y
RUN yum install telnet vim -y
RUN yum-config-manager --enable remi-php72
RUN yum install mod_ssl -y

RUN yum install php php-common -y
RUN yum install php-bcmath php-cli php-common php-devel php-fpm php-gd php-imap php-intl php-json php-mbstring php-mcrypt php-memcached php-mysqlnd php-opcache php-pdo php-pecl-igbinary php-pecl-mcrypt php-pecl-memcache php-pecl-memcached php-pecl-redis php-pgsql php-process php-redis php-soap php-xml php-xmlrpc -y
RUN yum install php-devel gcc libtool pcre-devel -y

RUN rm -rf /var/www/html
RUN rm -rf /var/www/cgi-bin

RUN rm -rf /etc/httpd/conf.d/README
RUN rm -rf /etc/httpd/conf.d/autoindex.conf
RUN rm -rf /etc/httpd/conf.d/userdir.conf
RUN rm -rf /etc/httpd/conf.d/welcome.conf

WORKDIR "/var/www/volkker.com.br"

CMD ["/run-httpd.sh"]