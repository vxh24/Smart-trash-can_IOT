#include <ESP32Servo.h>

#define trigPin 25
#define echoPin 26
#define smokeA0 35
#define smokeD0 34
#define ledPin 4
#define trigPin2 16
#define echoPin2 17
const int servoPin = 19;
// Khai báo đối tượng Servo
Servo myServo;

// Biến thời gian cho việc đặt lại servo
unsigned long resetTime = 0;
const unsigned long resetInterval = 2000;  // Thời gian chờ trước khi đặt lại servo (2 giây)

#include "WiFi.h"
#include "HTTPClient.h"
#define DISTANCE_MIN 0
#define DISTANCE_MAX 21

const char* ssid = "anhhiep";
const char* pass = "12345687";
const char* host = "192.168.137.246";
void setup() {
  Serial.begin(115200);
  //Khai báo cho các chân
  pinMode(trigPin, OUTPUT);
  pinMode(echoPin, INPUT);
  pinMode(trigPin2, OUTPUT);
  pinMode(echoPin2, INPUT);
  pinMode(smokeA0, INPUT);
  pinMode(smokeD0, INPUT);
  pinMode(ledPin, OUTPUT);
  myServo.attach(servoPin);
  // Kết nối wifi
  WiFi.begin(ssid, pass);
  Serial.println("Conecting.....");
  while (WiFi.status() != WL_CONNECTED) {
    Serial.print(".");
    delay(500);
  }
  Serial.println("Connected!");
}

void loop() {
  //Kết nối với port server
  WiFiClient client;
  const int httpPort = 80;
  if (!client.connect(host, httpPort)) {
    Serial.println("Connection Fail");
    return;
  }
  long duration, distance;
  int a = 0;
  // Generate pulse to trigger the sensor
  digitalWrite(trigPin, LOW);
  delayMicroseconds(2);
  digitalWrite(trigPin, HIGH);
  delayMicroseconds(10);
  digitalWrite(trigPin, LOW);
  // Đo thời lượng xung từ chân echo
  duration = pulseIn(echoPin, HIGH);

  // Tính khoảng cách bằng cm
  distance = (duration * 0.0343) / 2;
  distance = constrain(distance, DISTANCE_MIN, DISTANCE_MAX);
  //In khoảng cách
  Serial.print("Distance: ");
  Serial.print(distance);
  Serial.println(" cm");
  //siêu âm 2
  digitalWrite(trigPin2, LOW);
  delayMicroseconds(2);
  digitalWrite(trigPin2, HIGH);
  delayMicroseconds(10);
  digitalWrite(trigPin2, LOW);
  long duration2 = pulseIn(echoPin2, HIGH);

  // Chuyển đổi thời gian thành khoảng cách
  float distance2 = duration2 * 0.034 / 2;

  // In ra kết quả
  Serial.print("Khoang cach2: ");
  Serial.println(distance2);


  String linkGas;
  HTTPClient httpGas;
  linkGas = "http://" + String(host) + "/thungracthongminh/readgas.php";
  httpGas.begin(linkGas);
  httpGas.GET();
  String responseGas = httpGas.getString();
  Serial.println(responseGas);
  int smokeDigitalValue;
  if(responseGas=="1"){
  int smokeAnalogValue = analogRead(smokeA0);
  smokeDigitalValue = digitalRead(smokeD0);

  Serial.print("Analog Value: ");
  Serial.println(smokeAnalogValue);

  Serial.print("Digital Value: ");
  Serial.println(smokeDigitalValue);
  }
  else{
    smokeDigitalValue=2;
  }
    // nháy đèn khi khoảng cách nhỏ hơn 5 để thông báo thùng rác đầy và smokeDigitalValue=0 để thông báo cháy
  if (distance < 5 || smokeDigitalValue==0) {
    digitalWrite(ledPin, HIGH);  // Turn on the LED
    delay(500);                  // Delay for 0.5 seconds
    digitalWrite(ledPin, LOW);   // Turn off the LED
    delay(500);                  // Delay for 0.5 seconds
  }
  String linkSieuam2;
  HTTPClient httpSieuam2;
  linkSieuam2 = "http://" + String(host) + "/thungracthongminh/readsieuam2.php";
  httpSieuam2.begin(linkSieuam2);
  httpSieuam2.GET();
  String responseSieuam2 = httpSieuam2.getString();
  Serial.println(responseSieuam2);
  String linkServo;
  HTTPClient httpServo;
  linkServo = "http://" + String(host) + "/thungracthongminh/readservo.php";
  httpServo.begin(linkServo);
  httpServo.GET();
  String responseServo = httpServo.getString();
  Serial.println(responseServo);
  // Kiểm tra nếu khoảng cách < 10cm, mở servo ở góc 90 độ
  if (distance2 < 10 && responseSieuam2=="1") {
    myServo.write(90);  // Mở servo ở góc 90 độ
    delay(2000);
  } else if (responseServo == "1") {
    myServo.write(90);
  } else {
    myServo.write(0);
  }

  httpServo.end();



  String link;
  HTTPClient http;
  link = "http://" + String(host) + "/thungracthongminh/sensordata.php?distance=" + String(distance) + "&gas=" + String(smokeDigitalValue);
  http.begin(link);
  http.GET();
  String respon = http.getString();
  Serial.println(respon);
  http.end();
  delay(1000);  // Delay for 1 second before the next measurement
}
