# PHP-MYSQL example using docker-compose

This is an example of running a simple php-mysql web app using docker-compose.

## docker-compose

Web applications generally require multiple components or *services* (e.g. PHP interpreter, web server, DBMS).

Each *service* can be placed in its own Docker container. Containers required to run an app are called a stack.

Instead of managing all containers individually, we use `docker-compose` - a tool that allows us to easily launch and manage stacks of containers.

Docker-compose launches all the required *services* to run our web application. Services are defined by a configuration file `docker-compose.yml`. Have a look at this file. You will see 3 services defined: **db** (MySQL database), **web** (Apache with PHP interpreter) and **myadmin** (PhpMyAdmin db administration tool). You will notice that **db** and **myadmin** services are launched from standard Docker images that will be downloaded from DockerHub; however, **web** service uses a custom image built from `Dockerfile.extensions` dockerfile. I will explain the reason for this in class. Review `docker-compose.yml` file in conjunction with the [docs](https://docs.docker.com/compose/compose-file/) to understand how the stack is defined. You will see that most options for each service correspond to the options of `docker run` command.

`docker-compose` will look for `docker-compose.yml` file in the current directory, so make sure you execute the command from the right directory, when you bring the stack up and also down.

To bring the stack up, open terminal and navigate to this directory.

Execute: `docker-compose up -d`

This will start containers for all the services defined in `docker-compose.yml` file and create a custom network to interconnect them. `-d` flag indicates that containers should be launched in the background, so you should get back to the terminal prompt straight away. However, you can see the output that services running in those containers produce by executing `docker-compose logs`.

You can also check that the containers are running by executing `docker ps`.

Now you can navigate your browser to `localhost:8000` (It will take a few seconds for all services to get initialised properly so don't do it straight away) and you should see the web app running. You can run `docker-compose logs web` to see the webserver log that should show your browser's requests.

You can also open `localhost:8080` to access PhpMyAdmin tool and explore the database. Alternatively, you can launch the command line mysql client on the **db** service: `docker-compose exec db mysql -proot`.


Once you're finished with the application, you can 'bring the stack down' with `docker-compose down`. This will stop and remove the containers. Run `docker ps` again and you will see - the containers have now disappeared.

## PHP-MSQL application

This is a simple application that either inserts new data or modifies existing data in the database (depending on which form is submitted).

Note that the database is reset to the default state if you simply open the URL. However, if you submit one of the forms, the application performs appropriate action on the database. Carefully exampine the code in `app/index.php` to learn how it functions.
