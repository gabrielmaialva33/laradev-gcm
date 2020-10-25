```
CREATE USER 'admin'@'localhost' IDENTIFIED WITH mysql_native_password BY 'docker';
GRANT ALL PRIVILEGES ON _._ TO 'admin'@'localhost' WITH GRANT OPTION;
CREATE USER 'admin'@'%' IDENTIFIED WITH mysql_native_password BY 'docker';
GRANT ALL PRIVILEGES ON _._ TO 'admin'@'%' WITH GRANT OPTION;

CREATE DATABASE IF NOT EXISTS `gcm` COLLATE 'utf8_general_ci' ;
GRANT ALL ON `gcm`._ TO 'admin'@'%' ;
GRANT ALL ON `gcm`._ TO 'admin'@'localhost' ;
GRANT ALL ON `gcm`.* TO 'admin'@'%' ;
GRANT ALL ON `gcm`.* TO 'admin'@'localhost' ;

FLUSH PRIVILEGES ;
```
