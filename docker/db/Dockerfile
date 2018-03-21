FROM mysql:5.7

ENV WWW_UID 1000
ENV WWW_GID 1000

RUN apt-get update && apt-get -y install \
    && apt-get clean


COPY my.cnf /etc/my.cnf

EXPOSE 3306
