# php-unit-training
PHPUnit training by Continuous

# Prerequisite
When you download this branch please create your environment settings.

    $ cp .env.dist .env

First, start the docker containers:

    $ docker-compose up -d

After, install via composer :

    $ docker-compose exec web composer install

Now you could  the containers we will use for this training :

    $ docker-compose ps

You could show the list of containers like this :

```
Name                        Command               State          Ports
---------------------------------------------------------------------------------------
php-unit-training_web_1   docker-php-entrypoint apac ...   Up      0.0.0.0:8000->80/tcp
```


And you should see phpinfo on http://localhost:8000