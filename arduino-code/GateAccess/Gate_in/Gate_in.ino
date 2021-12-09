#include <Ethernet.h>
#include <Wiegand.h>

#include <ESP8266WiFi.h>
#include <ESP8266HTTPClient.h>

#define SERVER_IP "192.168.100.35"
#define relayPin D0
#define WG_PIN_D0 10
#define WG_PIN_D1 9
const char* ssid = "Rahasia";
const char* pass = "maungapain";
int count;
WIEGAND wg;

String urlPrefix = "/access-app/modul/data";
String qString = "?uid=0";
//Status Masuk = 1, Status Keluar  = 2
String qStatus = "&status=2";

String rStatus = "";

void setup(){
    //RC522
    //3v3 = 3V, 
    //D1 = RST, 
    //GND = G, 
    //MISO = D6, 
    //MOSI = D7, 
    //SCK = D5, 
    //SDA = D2

    //W5500
    //RST = D2
    //SCLK = D5
    //MISO = D6
    //MOSI = D7
    //SCS = D8

    //Wiegand
    //D0 = GPIO10/10 Wiegand
    //D1 = GPIO9/9 Wiegand
    
    //D0 = Relay
    Serial.begin(115200);
    pinMode(relayPin, OUTPUT);
    digitalWrite(relayPin, LOW);
    wg.begin(WG_PIN_D0, WG_PIN_D1);
    //Serial.flush();
    Serial.println("Connecting to Wifi -> SSID: "+String(ssid));
    WiFi.mode(WIFI_STA);
    WiFi.begin(ssid, pass);

    Serial.print("Initialize connect to Wifi");
    while(WiFi.status() != WL_CONNECTED){
        delay(500);
        Serial.print(".");
    }

    Serial.println("");

        if((WiFi.status() == WL_CONNECTED)){
      Serial.print("Connected to Server. Board IP: ");
      Serial.println(WiFi.localIP());
      delay(500);
      long rssi = WiFi.RSSI();
      String rsi = String(rssi);
      rsi.remove(0,1);
      Serial.print("Signal strength: -"+rsi);
      Serial.println("dBm");

      
      
      //IF WIFI RANGE TO LONG SWITCH TO ETHERNET
      if(rssi < -85){
        Serial.println("Wifi range to long");
        delay(500);
      }else{
        Serial.println("Wifi range OK");
        Serial.println();
        delay(500);
        Serial.println("Tap card into Reader!");
      }
    }
    

}

void loop(){
    
    if(wg.available()) {
      Serial.println("Card Readed!");
      unsigned long wcode = wg.getCode();
      Serial.print("Wiegand HEX = ");
      Serial.println(wg.getCode(),HEX);
      qString = String("?uid=")+String(wcode,HEX);
      Serial.println(qString);
      delay(1000);
      sendData();
    }
  

}



void sendData(){
  WiFiClient client;
  HTTPClient http;

  Serial.print("HTTP begin... \n");
  if(http.begin(client, "http://192.168.100.35"+ String(urlPrefix) + String(qString) + String(qStatus)) ){
    Serial.println(String(urlPrefix)+String(qString)+String(qStatus));
    int httpCode = http.GET();

    if(httpCode > 0){
      Serial.println("HTTP GET... code:"+String(httpCode));

      if(httpCode == HTTP_CODE_OK || httpCode == HTTP_CODE_MOVED_PERMANENTLY){
        String payload = http.getString();
        Serial.println(payload);
        char val = payload.charAt(8);
        rStatus = String(val);
        delay(1000);
        relayAction();
      }
    }else{
      Serial.printf("[HTTP] GET... failed, error: %s\n", http.errorToString(httpCode).c_str());
      Serial.println("Tap card into Reader!");
    }
    http.end();
    delay(1000);
  }else{
    Serial.printf("HTTP: unable to connect server\n");
    Serial.println("Check Connection or Server IP!");
    delay(1000);
  }
  
  delay(1000);
}

void relayAction(){
  if(rStatus == "1"){
    digitalWrite(relayPin, HIGH);
    delay(5000);
    digitalWrite(relayPin, LOW);
    Serial.println();
    Serial.println("Tap card into Reader!");
    loop();
  }else{
    digitalWrite(relayPin, LOW);
    Serial.println();
    Serial.println("Tap card into Reader!");
    loop();
  }
}
