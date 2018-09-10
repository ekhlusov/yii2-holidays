FROM mysql:5.7.14
RUN apt-get update && apt-get install -y openssh-client
COPY mysql_conf.cnf /etc/mysql/conf.d/mysql_conf.cnf
