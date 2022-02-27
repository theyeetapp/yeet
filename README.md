### Yeet

------------
So I consider myself financial market curious. I like to at least be in the know about the latest happenings in the stock/crypto market. There a bunch of companies/cryptos that I take particular interest in. So I thought to turn it into a fun project to build. 

I built Yeet along with its accompanying Telegram bot, [YeetBot](https://github.com/olamileke/yeetbot "YeetBot") to deliver stock and crypto price notifications every morning at 8am GMT +1. Yeet is a Laravel monolith while YeetBot is written in Python via the Python Telegram Bot library.

Access the live application at [https://theyeetapp.com](https://theyeetapp.com "https://theyeetapp.com").

### Installation
--------------
Clone the project and cd into the application directory.  Create and copy over the relevant environment variables from the .env.example file with 
```
$ cat .env.example > .env
```
Make sure to update the relevant environment variables. I think they are descriptive enough, but if you need clarification, feel free to reach out.
Install the project dependencies and start a local server with the following terminal commands:

```
$ composer install
$ php artisan serve
```
Navigate to http://localhost:8000/ to access the application.

### Build
-----
Alternatively, you can run the application as a Docker container. Still in the application directory run the following command
```
$ docker build -t Yeet .
```
This will make use of the Dockerfile in the root directory and build a "Yeet" image on your system, the Docker host. Create and run a Docker container based on this image with

```
$ docker run -p 9000:9000 --name Yeet -d Yeet
```
Once this is done, you can access the application via your local IP address on the 9000 port. So say your local IP address is http://192.168.43.127/, it would be available at http://192.168.43.127:9000. Its accessed on the 9000 port due to the port mapping specified with the docker run command. Run it on a different port of your choosing by simply specifying a different port after the -p option. So to run it on port 5000, it would simply be

```
$ docker run -p 5000:9000 --name Yeet  -d Yeet
```

