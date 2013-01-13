React Bench
===========

This is a very little bench of memory consuption of react-php.

To re-build datas, run:

    php do-nothing.php > result-do-nothing.csv &
    for i in {1..5000} ; do ab -c100 -n1000 http://127.0.0.1:1337/ ; done ;
