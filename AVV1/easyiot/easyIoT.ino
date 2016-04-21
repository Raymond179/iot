// Include libraries
#include <EIoTCloudRestApi.h>
#include <EIoTCloudRestApiConfig.h>

EIoTCloudRestApi eiotcloud;

void setup() {
  // Begin easyiot cloud service
   eiotcloud.begin();
}

void loop() {
 // Get sound data
 int sound = analogRead(A0);
 int val = digitalRead(D0);

 // Send data to easyiot
 eiotcloud.sendParameter("5703b3aec943a0661cf314a4/ARrieI0b4sSkMZy3", sound);
 eiotcloud.sendParameter("5703b3aec943a0661cf314a4/wISZiqKHmU9cxN3q", val);
}
