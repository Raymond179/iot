# How do you choose the right IoT hardware and what are the advantages and disadvantages for installation and use?

In the world of Internet of Things there are different types of hardware. They all have different features, properties and purposes. In this research article I will compare some of these IoT hardware platforms. I am going to describe how to install these hardware platforms and find out the differences and their pros and cons for installation and use. The following IoT hardware will be reviewed:

- FT232RL FTDI with ESP8266
- Spark core
- NodeMCU
- ESP32

## Table of contents
- FT232RL FTDI with ESP8266
	- FT232RL FTDI
	- ESP8266
	- Installation
	- Conclusion
- Spark core
	- Installation
	- Conclusion
- NodeMCU
	- Installation
	- Conclusion
- ESP32
	- Installation
	- Conclusion
- Overall conclusion

### FT232RL FTDI with ESP8266
The FT232RL FTDI is processing unit which in this installation will work together with the ESP8266, a Wi-Fi module/chip.
In the picture below the setup of the installation is shown, using the FT232RL FTDI in combination with the ESP8266.

![alt tag](https://github.com/RaymondKorrel/iot/blob/master/Onderzoek-Herkansing/img/esp-overzicht.jpg)

###### FT232RL FTDI
![alt tag](https://github.com/RaymondKorrel/iot/blob/master/Onderzoek-Herkansing/img/ttl.png)

This picture shows the FT232RL FTDI and its pin-layout.
The FT in FT232RL stands for Future technology. It's related to the RS (Radio standards), which is a standard for communication between computers and peripherals or computers to computers. It was the old technique to send data between computers using voltages between +12V and -12V. The difference between FT and RS is that FT is based on TTL voltages. The FTDI is a UART, which is a “Universal Asynchronous Receiver Transmitter” chip based on the RS232 serial standard. It's located on the FT232RL in the center.
The FT232RL FTDI will be powered through USB, using the USB-connecter. Via this connection the code can also be transferred.<br/>
The FT232RL FTDI however is missing I/O pins. So it's necessary to connect it to hardware with GPIO or I/O pins to be able to write or read in- and output. For this purpose we will be using the ESP8266.


###### ESP8266
![alt tag](https://github.com/RaymondKorrel/iot/blob/master/Onderzoek-Herkansing/img/esp8266-pins.png)

As you can see in the picture above the ESP8266 has two GPIO pins (General Purpose Input Output). GPIO pins can be configured to be input or output. Another primary function of the module is the Wi-Fi capability. However, the ESP8266 has no USB-connection so it cannot be programmed. <br/>
In order to function as an IoT hardware device, both the FT232RL and the ESP826 are needed.


###### Installation
Let's install. But wait, there's a problem. The ESP8266 is not 5V tolerant and should be powered with 3,3 Volt.  So we need some kind of voltage level shifter. Or, we upload the code to the FT232RL via USB, and connect the ESP8266 to a 3,3V external power source (battery). In this way there are two power sources. The ESP8266 will use 3,3V and the FT232RL will use 5V through USB.

![alt tag](https://github.com/RaymondKorrel/iot/blob/master/Onderzoek-Herkansing/img/esp-5v.jpg)

To be sure the ESP8266 works, I tested it standalone (without using the FT232RL). If you connect it in the right way, you should see a red light. This means the ESP8266 is ready.

![alt tag](https://github.com/RaymondKorrel/iot/blob/master/Onderzoek-Herkansing/img/esp-3v.jpg)

To get the installation ready to upload code, we need to know how to reset the ESP8266. We can do this by powering on the FT232RL when the DTR of the FT232RL is connected to the RST of the ESP8266. You can see the blue light blink on the ESP8266.

![alt tag](https://github.com/RaymondKorrel/iot/blob/master/Onderzoek-Herkansing/img/esp-reset.jpg)

Before uploading the code to the FT232RL, we need to know that the ESP8266 has been reset. 
I found out that by powering on the FT232RL the ESP8266 will automatically be reset when the DTR of the FT232RL is connected to the RST of the ESP8266. After power on you first see the blue light blink on the ESP8266.
This is the point where I got stuck. When I upload the code, I constantly get the following errors in the console of the Arduino IDE:
```
warning: espcomm_sync failed 
error: espcomm_open failed 
error: espcomm_upload_mem failed
```

###### Conclusion
Installing the FT232RL with the ESP8266 is not easy. However I managed to successfully setup the combination, I was not able to upload the code and let the setup function. Therefore I cannot say anything about the IoT-functionality. Further research is required.
On the other hand, the FT232RL and ESP8266 together only cost around 8 euros.
If you prefer an easier setup, you’re better off buying a NodeMCU which has the Wi-Fi module built in. Another possibility is connecting the ESP8266 to the Arduino.

Source: https://nl.wikipedia.org/wiki/RS-232 <br/>
		https://en.wikipedia.org/wiki/General-purpose_input/output<br/>
		http://iot-playground.com/blog/2-uncategorised/17-esp8266-wifi-module-and-5v-arduino-connection<br/>
		http://www.arduinesp.com/getting-started

### Spark core
The Spark core is a device in which it is not necessary to write code. It lets you connect to an app on your smartphone using Wi-Fi. From the interface on your smartphone you can control the output on your Spark core. The Spark core can connect up to 5 Wi-Fi networks

![alt tag](https://github.com/RaymondKorrel/iot/blob/master/Onderzoek-Herkansing/img/spark-overzicht.jpg)

This picture shows the setup of the Spark core, using a LED as an output indicator. The Spark core is powered by USB.

###### Installation
To connect your Spark core to your smartphone, plug the USB cable in and connect it to a power source. I used my laptop for this. Download the Spark app on your smartphone and open the app. When you open the app, create an new account or login to your existing Spark account. When logged in, you can fill in your SSID and password for your Wi-Fi connection. If you're already connected to Wi-Fi, then you only have to fill in your password.<br/>
Before you click on 'connect', make sure the Spark core onboard LED blinks blue. If this is not the case, hold the setup button until the light blinks blue.

![alt tag](https://github.com/RaymondKorrel/iot/blob/master/Onderzoek-Herkansing/img/spark-setup.jpg)

Then click  on “connect” in the app of your smartphone. The light on the Spark core will be solid blue. This means that it's receiving the SSID and password. The onboard LED will be blinking green which means it is connecting to Wi-Fi. After that, the LED will return to the blue/green status. The Spark core should now be connected to the Wi-Fi network.

![alt tag](https://github.com/RaymondKorrel/iot/blob/master/Onderzoek-Herkansing/img/spark-interface.png)

This picture shows the login screen of the app.

When the Spark core is connected to internet through Wi-Fi, you should be able to see the 'Linker view', where you can access all analog and digital I/O's. In this screen you can read sensor data and write output. But that's not the only thing you can do with the Spark core. By installing custom firmware, it is also possible to program the Spark core and turn things on and off automatically. To go a step further with this, visit https://build.particle.io/build.

###### Conclusion
The Spark core can connect up to 5 Wi-Fi networks and connect to these automatically when they're available. The big advantage of the Spark core module compared to other IoT hardware, is the ease of use. Because of the simple interface on the smartphone you don't have to write any code. So the Spark core works great for people who don't know how to program and simply want to experiment with IoT devices. The disadvantage of the Spark core is the high price. It costs around 70 dollars.

### NodeMCU
The NodeMCU is a microcontroller with Wi-Fi module based on the “eLua project”. It uses the “Lua” scripting language and it includes firmware which runs on the ESP8266 Wi-Fi SoC (System on a Chip). The hardware is based on the ESP-12 module.

![alt tag](https://github.com/RaymondKorrel/iot/blob/master/Onderzoek-Herkansing/img/nodemcu-overzicht.jpg)

This picture shows an example installation of the NodeMCU.

###### Installation

There are two programming languages the NodeMCU supports, which are Lua script and C++. To setup the NodeMCU to program in C++, download Arduino IDE.<br/>
When installed, go to preferences and under additional board manager URL's fill in the following link: http://arduino.esp8266.com/stable/package_esp8266com_index.json to import the NodeMCU library. Then go to Tools > Board > Boardmanager and search for esp. Install the result: esp8266.

To connect to a Wi-Fi network, you need to configure your code to your Wi-Fi settings. You can see an example below:
```
print(wifi.sta.getip())
--nil
wifi.setmode(wifi.STATION)
wifi.sta.config("SSID","password")
print(wifi.sta.getip())
--192.168.18.110
```

After a correct installation of the NodeMCU you are able to upload user defined code and control the input and output ports. I noticed however that uploading the code took a lot of time (about 40 seconds) which was annoying during experimenting with the code.
In my experiments with the NodeMCU, I have made successful setups with both a pressure sensor and an infrared sensor. Via Wi-Fi I have collected the data of the sensors and visualized the values in a graph on the website engine. I was satisfied with the results.

source: http://nodemcu.com/index_en.html

###### Conclusion
The advantage of the NodeMCU is that it's really powerful for its low cost. A disadvantage is the upload time which takes around 40 seconds each time. Another disadvantage is that the NodeMCU only has one analog I/O. In general the NodeMCU is a good choice if you just want to connect to the internet and do some basic input and output stuff. For more advanced experimenting I suggest the Arduino with the ESP8622 module because of the more diverse and wider amount of input- and output ports.

### ESP32
The ESP8266 is the current hype at the moment within the IoT community. That is because of its low cost and wide availability. The ESP8266 chip is made by the Chinese company 'Espressif' which is currently working on a new, better, more expensive and much more powerful SoC (System on a Chip): the ESP32. It is still in development and not all of the details have been published yet.

![alt tag](https://github.com/RaymondKorrel/iot/blob/master/Onderzoek-Herkansing/img/esp32.png)

This picture shows an overview of the ESP32 hardware and pin layout.

The ESP32 even has Bluetooth capability. Because of this it will be able to connect to beacons and other Bluetooth devices. The design is much bigger than its predecessor (ESP8266) and will include a lot more input and output ports, including:

- 10x Capacitive Touch Inputs
- 2x 8-Bit Digital to Analog Converters (DACs) 2x I2C, 4x SPI, and 2x UART Interfaces
- 16x 12-Bit Analog to Digital Converters (ADC’s)

The ESP32 is powered by dual Tensilica CPUs clocked at 160MHz. This means that it is far more powerful than the older ESP8266, which is powered by one Tensilica CPU clocked at 80Mhz. The ESP32 also has more RAM memory then the ESP8266. It increased from 96kB to 416kB.

Unfortunately there are some disappointments too. Because the ESP32 has no flash memory, it cannot save code. Therefore the ESP32 will still need a separate IC for program and data storage, just like the ESP8266. 
Also, the ESP32 will still runs on 3.3V logic, which means that a non-standard external power source is required.


###### Conclusion
The ESP32 promises to be a powerful device with Wi-Fi and Bluetooth capabilities, combined with a lot more input and output ports. Also the ESP32 is much more powerful in its processing power because of its dual 160MHz processor.
Although the ESP32 has not been released yet, is promises to be a powerful and very useful IoT device.
For more information, see the following link:<br/>
http://www.allaboutcircuits.com/news/esp32-a-worth-successor-to-the-esp8266/

## Overall conclusion
In this article I decribed four different IoT hardware devices:

- FT232RL FTDI with ESP8266
- Spark core
- NodeMCU
- ESP32

All of these devices has their own features for use in the world of Internet of Things.
Features which have been tested and researched are: ease of installation and effectiveness and ease of use.<br/>
Looking at ease of installation, the Spark core seems to be the best of all. Disadvantages of the Spark core is the high price.  Also the NodeMCU is not very complicated in setup and installation. It is also not expensive. The FT232RL in combination with the ES8266 however, presented difficulties in physical installation and moreover you will experience difficulties in coding the device. On the other hand this hardware-combination is not very expensive.<br/>
The ESP32 promises to be a powerful IoT device, but unfortunately it is not available yet. Also the price of the ESP32 is unknown. 
As I was not able to test the ESP32, my conclusion is that the most effective and easy in use hardware, is the NodeMCU. This conclusion is based on the diversity in I/O ports of the NodeMCU and its coding possibilities. On the other hand, the upload time for code with the NodeMCU is too long, which causes irritation when experimenting with different codes. Also the NodeMCU has just one analog I/O port, limiting the possibilities.<br/>
Despite of the fact that the NodeMCU has some drawbacks, the NodeMCU is my preferred IoT hardware overall.
