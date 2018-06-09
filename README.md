# SummaryTech

All technology be summary by my self for know what am i learning.

After pull running follow step:
(WINDOWS)
1. composer install
2. php artisan key:generate
3. Add vhost

<VirtualHost *:80>

    ServerName techs-local.vn
    
    DocumentRoot "__YOUR_LOCATION_CODE__/techs/public/"
    
    <Directory "__YOUR_LOCATION__/techs/public/">
    
        DirectoryIndex index.php
        
        AllowOverride All
        
        Order allow,deny
        
        Allow from all
        
    </Directory>
    
</VirtualHost>


4. Add hosts in C:\Windows\System32\drivers\etc

127.0.0.1 techs-local.vn

5. Reset apache.
6. Access http://techs-local.vn in browser and see result.

(UBUNTU)
Attention provider permission for folder storage
