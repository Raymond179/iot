#include <ESP8266WiFi.h>
#include <ArduinoJson.h>

const char* ssid     = "iPhone van R";  
const char* password = "wortels18";

const char* host     = "www.raymondkorrel.nl"; // Your domain  
String path          = "/iot/light.json";  
const int pin        = D0;

void setup() {  
  pinMode(pin, OUTPUT); 
  pinMode(pin, HIGH);
  Serial.begin(9600);

  delay(10);
  Serial.print("Connecting to ");
  Serial.println(ssid);

  WiFi.begin(ssid, password);
  int wifi_ctr = 0;
  while (WiFi.status() != WL_CONNECTED) {
    delay(500);
    Serial.print(".");
  }

  Serial.println("WiFi connected");  
  Serial.println("IP address: " + WiFi.localIP());
}

void loop() {  
  Serial.print("connecting to ");
  Serial.println(host);
  WiFiClient client;
  const int httpPort = 80;
  if (!client.connect(host, httpPort)) {
    Serial.println("connection failed");
    return;
  }

  // GET
  client.print(String("GET ") + path + " HTTP/1.1\r\n" +
               "Host: " + host + "\r\n" + 
               "Connection: keep-alive\r\n\r\n");

  delay(500); // wait for server to respond

  // read response
  String section="header";
  while(client.available()){
    String line = client.readStringUntil('\r');
    // Serial.print(line);
    // we’ll parse the HTML body here
    if (section=="header") { // headers..
      Serial.print(".");
      if (line=="\n") { // skips the empty space at the beginning 
        section="json";
      }
    }
    else if (section=="json") {  // print the good stuff
      section="ignore";
      String result = line.substring(1);

      // Parse JSON
      int size = result.length() + 1;
      char json[size];
      result.toCharArray(json, size);
      StaticJsonBuffer<200> jsonBuffer;
      JsonObject& json_parsed = jsonBuffer.parseObject(json);
      if (!json_parsed.success())
      {
        Serial.println("parseObject() failed");
        return;
      }

      // Make the decision to turn off or on the LED
      if (strcmp(json_parsed["light"], "on") == 0) {
        analogWrite(pin, 20); 
        Serial.println("BUZZER ON");
      }
      else {
        analogWrite(pin, 0);
        Serial.println("buzzer off");
      }
    }
  }

  // POST
  // Define data
  String data;
  String potMeter;
  potMeter = String(analogRead(A0));
  data = "pot="+potMeter;

  //connect the nodeMCU to the server
  if(client.connect(host, httpPort)) {
    //make the POST headers and add the data string to it
    client.println("POST /iot/index.php HTTP/1.1");
    client.println("Host: www.raymondkorrel.nl:80");
    client.println("Content-Type: application/x-www-form-urlencoded");
    client.println("Connection: close");
    client.print("Content-Length: ");
    client.println(data.length());
    client.println();
    client.print(data);
    client.println();
    Serial.println("Data send");
  } else {
    Serial.println("Something went wrong");
  }
  Serial.print("closing connection. ");
}

// Source: http://blog.nyl.io/esp8266-led-arduino/
