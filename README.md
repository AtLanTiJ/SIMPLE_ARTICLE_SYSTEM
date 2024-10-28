  # REAADME

- 我自己是用的xampp搭建的环境，直接将项目放在`xampp/htdocs/www`下，然后需要注意的是还要更改几个配置文件的内容才能访问到这个目录。

- 1.更改`xampp/apache/conf/httd.conf`文件中的DocumentRoot的值，即apache的默认起始页面
    ```
    DocumentRoot "X:/xampp/htdocs/www"
    ```

- 2.向`xampp/apache/conf/extra/httd-vhosts.conf`中添加内容，开启项目目录访问权限
    ```
    <Directory "E:\xampp\htdocs\www">
		Require all granted
    </Directory>
    ```

- 3.重启服务

> 学PHP的时候自己练手的小项目，涉及到PHP基础语法、登陆验证、文件管理、与MYSQL数据库交互、访问控制等。对前端不太了解，项目的样式由AI完成。自己慢慢写的代码中存在许多漏洞，后续学的时候给填上吧。