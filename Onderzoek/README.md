# The different hardware in the Internet of Things
## What kinds of hardware are there in the world of Internet of things and in what situations are they useful?
In the world of Internet of Things there are a number of different kinds of hardware. They all have different features, properties and purposes. In this research article i want to compare these IoT platforms. I am going to point out the features and in what situations they're useful. Because there is too many hardware to research, i'm going to review the following IoT platforms: <br/>

- NodeMCU
- FT232RL FTDI with ESP8266
- Spark core
- ESP32

### FT232RL FTDI with ESP8266
The ESP8266 is a WiFi module/chip. It doesn't have a USB connection which means you need a processor in order to get power. For the installation i'm going to use the FT232RL FTDI, a TTL to USB interface. 

![alt tag](https://github.com/RaymondKorrel/iot/blob/master/Onderzoek/img/esp-overzicht.png)

###### FT232RL FTDI
![alt tag](https://github.com/RaymondKorrel/iot/blob/master/Onderzoek/img/ttl.png)
The FT in FT232RL stands for Future technology. It's related to the RS (Radio standards), which is a standard for communication between computers and peripherals or computers to computers. It was the old technique to send data between computers using voltages between +12 and -12. The difference between FT and RS is that FT is based on TTL voltages. The FTDI is a UART, which is a universal asynchrounous receiver transmitter chip based on the 232 serial standard. It's located on the FT232RL in the center.

The FT232RL FTDI is needed for power through USB. But it's missing I/O pins. So it's necessary to connect it to hardware with GPIO or I/O pins to be able to write or read in and output. In this case, that's the ESP8266.

###### ESP8266
![alt tag](https://github.com/RaymondKorrel/iot/blob/master/Onderzoek/img/esp8266-pins.png)
As you can see the ESP8266 has two GPIO pins. GPIO pins can be configured to be input or output. This means that the FT232RL needs the ESP8266 WiFi module to function with code. But the ESP8266 doesn't have a power source so it needs the FT232RL for the power source and to load code. They need eachother in order to work.

###### Installation
Let's install. But wait, there's a problem. The ESP8266 is not 5v tolerant as the FT232RL is. So we need some kind of voltage level shifter. Or, we upload the code to the FT232RL via USB, and connect the ESP8266 to a 3.3v battery. This way there are two power sources, one on 3.3v and the other one on 5v.

![alt tag](https://github.com/RaymondKorrel/iot/blob/master/Onderzoek/img/esp-5v.png)

To be sure the ESP8266 works, i tested it without the FT232RL. If you connected it the right way, you should see a red light. This means the ESP8266 is ready.

![alt tag](https://github.com/RaymondKorrel/iot/blob/master/Onderzoek/img/esp-3v.png)

To get the installation ready to upload code, we need to know how to reset the ESP8266. We can do this by powering on the FT232RL when the DTR of the FT232RL is connected to the RST of the ESP8266. You can see the blue light blink on the ESP8266.

![alt tag](https://github.com/RaymondKorrel/iot/blob/master/Onderzoek/img/esp-reset.png)

This is the point where i got stuck. When i uploaded the code, i got the error:

warning: espcomm_sync failed <br/>
error: espcomm_open failed <br/>
error: espcomm_upload_mem failed

###### Conclusion
TOO DIFFICULT! You're better off buying a NodeMCU which has both in one and can do exactly the same. After 5 hours of trying and researching, i have not managed to get it to work. I suggest you buy hardware that has the WiFi chip build in. Or you can of course connect it to the Arduino.

Source: https://nl.wikipedia.org/wiki/RS-232
		https://en.wikipedia.org/wiki/General-purpose_input/output
		http://iot-playground.com/blog/2-uncategorised/17-esp8266-wifi-module-and-5v-arduino-connection
		http://www.arduinesp.com/getting-started

### Spark core
The Spark core is an IoT device that doesn't require you to write any code. It let's you connect to an app on your smartphone through WiFi where you can controll you're Spark core from an interface.

![alt tag](https://github.com/RaymondKorrel/iot/blob/master/Onderzoek/img/spark-overzicht.jpg)

###### Installation
To connect your Spark core to your smartphone, plug the USB cable in and connect it to a power source. I used my laptop. Download the Spark app on your phone and open it up. When you open the app, create an account or login to your existing Spark account. When logged in, you can fill in your SSID and password for your WiFi connection. If you're already connected to WiFi then you only have to fill in your password. 

Before you click on 'connect', make sure the Spark core blinks blue. If this is not the case, hold the setup button until the light blinks blue. 

![alt tag](https://github.com/RaymondKorrel/iot/blob/master/Onderzoek/img/spark-setup.jpg)

Then click connect. The light on the Spark core wil be solid blue. This means that it's receiving the SSID and password. Then a green light will blink which means it's connecting to WiFi. After that, the light will return to the blue/green light and now the Spark core should be connected to WiFi.

![alt tag](https://github.com/RaymondKorrel/iot/blob/master/Onderzoek/img/spark-interface.png)

When the Spark core is connected to internet, you should be able to see the 'tinker view', where you can access all analog and digital I/O's. In this screen you can read sensor data and write output. But that's not the only thing you can do with the Spark core. By putting on custom firmware, you're able to turn things on and off automatically. To go a step further with this, visit https://build.particle.io/build.

###### Conclusion
The spark core can connect up to 5 WiFi networks and connects to these automatically when they're available. It reacts really fastThe big advantage of the Spark core relative to other IoT hardware, is the ease in use. Because of the simple interface on the smartphone you don't have to write any code. So the Spark core works great for people who don't know how to code and simply want to experiment with IoT.

### NodeMCU
The NodeMCU is a microcontroller with WiFi module based on the eLua project. It uses the Lua scripting language and it includes firmware which runs on the ESP8266 Wi-Fi SoC (System on a Chip). The hardware is based on the ESP-12 module.

![alt tag](https://github.com/RaymondKorrel/iot/blob/master/Onderzoek/img/nodemcu-overzicht.jpg)

There are two programming languages the NodeMCU supports, which are Lua script and C++. To setup the NodeMCU to program in C++, download Arduino IDE. When installed, go to preferences and under additional board manager URL's fill in the following link: http://arduino.esp8266.com/stable/package_esp8266com_index.json to import the NodeMCU library. Then go to Tools > Board > Boardmanager and search for esp. Install the result: esp8266.

To connect to a wireless network, you need to configure your code to your WiFi settings. You can see an example below:

```c++
print(wifi.sta.getip())
--nil
wifi.setmode(wifi.STATION)
wifi.sta.config("SSID","password")
print(wifi.sta.getip())
--192.168.18.110
```
source: http://nodemcu.com/index_en.html

###### Conclusion
The advantage of the NodeMCU is that it's really powerful for it's low cost. A disadvantage is the uploading time which takes around 40 seconds each time. Another disadvantage is that the NodeMCU only has one analog I/O. In general it's a good choice if you just want to connect to the internet and do some basic input and output stuff. For more advanced experimenting i suggest the Arduino with the ESP8622 module because of the wider amount of I/O's. 

### ESP32
The ESP8266 is the current hype at the moment within the IoT community. That is because of it's low cost and wide availability. The ESP8266 chip is made by the Chinese company 'Espressif' which is currently working on a new, better, more expensive and much more powerful SoC (System on a Chip): the ESP32. It is still in development and not all of the details have been announced yet.

![alt tag](https://github.com/RaymondKorrel/iot/blob/master/Onderzoek/img/esp32.jpg)

The ESP32 has bluetooth capability. Because of this it will be able to connect to beacons and other bluetooth devices. The design is much bigger than it's predecessor and will include a lot more I/O's:

- 10x Capacitive Touch Inputs
- 2x 8-Bit Digital to Analog Converters (DACs) 2x I2C, 4x SPI, and 2x UART Interfaces
- 16x 12-Bit Analog to Digital Converters (ADC’s)

The ESP32 is powered by dual Tensilica CPUs clocked at 160MHz which means it's far more powerfull than the ESP8266 which is powered by one Tensilica CPU clocked at 80Mhz. The ESP32 also has more RAM memory then the ESP8266. It improves from 96KB to 416KB.

Unfortunately there are some disappointments too. The ESP32 will need a seperate IC for program and data storage, just like the ESP8266. It will also still run on 3.3v logic.

Source: http://www.allaboutcircuits.com/news/esp32-a-worth-successor-to-the-esp8266/