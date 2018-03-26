FROM mysql:5.7

RUN apt-get update && apt-get -y install \
    nano \
    && apt-get clean

ADD my.cnf /etc/my.cnf
