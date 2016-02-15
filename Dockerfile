FROM akitchin/magento
MAINTAINER Anthony Kitchin

#http://devdocs.magento.com/guides/v2.0/install-gde/install/cli/install-cli-install.html
RUN /etc/init.d/mysql start && cd /usr/local/magento2 && sudo -u www-data php bin/magento setup:install --db-host=localhost --db-name=magento2 --db-user=root --backend-frontname=admin --admin-user=anthony --admin-password=teamsw1n --admin-email=noreply@macys.com --admin-firstname=First --admin-lastname=Last --base-url=http://magento2.local/ --language=en_US --currency=USD --use-rewrites=1 --use-secure=0 --use-secure-admin=0 --cleanup-database && /etc/init.d/mysql stop

#RUN /etc/init.d/mysql start && cd /usr/local/magento2 && sudo -u www-data php bin/magento setup:static-content:deploy && /etc/init.d/mysql stop

RUN /etc/init.d/mysql start && cd /usr/local/magento2 && sudo -u www-data php bin/magento indexer:reindex && /etc/init.d/mysql stop

RUN cp /usr/local/magento2/php.ini.sample /etc/php5/apache2/php.ini

EXPOSE 80

# Default docker process 
CMD ["/usr/sbin/apache2ctl", "-D", "FOREGROUND"]