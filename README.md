<details open="open">
  <summary>Table of Contents</summary>
  <ol>
    <li>
      <a href="#about-the-project">About The Project</a>
      <ul>
        <li><a href="#built-with">Built With</a></li>
      </ul>
    </li>
    <li>
      <a href="#getting-started">Getting Started</a>
      <ul>
        <li><a href="#prerequisites">Prerequisites</a></li>
        <li><a href="#installation">Installation</a></li>
      </ul>
    </li>
    <li><a href="#usage">Usage</a></li>

  </ol>
</details>

## About the project

This is PHP command line weather app which prints current weather of any city that is provided as argument. 
It contains main weather information like description of weather condition, current temperature,
minimum temperature and maximum temperature in degrees celsius. Additional information like humidity, wind speed, time of sunset and sunrise is also provided. Everything is fetched using API provided by
https://openweathermap.org/ .


#### Built with

- PHP 7.4
- Composer

## Getting started
#### Prerequisites
- docker 
- docker-compose

#### Installation
1. Clone this repo and change directory to weather-app folder
2. Create a file .env.local and add API key into it (refer to .env)
3. Install dependencies 

    ```docker-compose up composer```
   
## Usage

Get weather info for Berlin like this:

   ```./run.sh "Berlin"```
   
You can also start unit tests:

   ```./test.sh```
   

After providing city for bash script weather data will be printed out to console.

![Weather info for Berlin](https://user-images.githubusercontent.com/18744725/109013441-75a67980-76b3-11eb-9492-7b6a80fe195c.png)
 
(Icon matches the weather condition to make it more interesting :) Try with other cities to get other icons.)




If you run a bash script without providing argument or argument with not allowed characters, corresponding error message
will be shown. Error messages will be also displayed if there is any problem with response from weather API - like non existing city, invalid API key, malformed JSON.

Last important thing, if you don't provide API key in config, it won't be possible to boot the application.


