//O código de envio dos dados não foi implementado por problemas no componente ESP

const int botao = 2;

const int LEDr = 5;
const int LEDy = 4;
const int LEDg = 3;

int modo = 3;

boolean oxi_read = false;
boolean temp_read = false;

//----

int temp=0,ultimatemp=0;
int primeiratemp=0;
int media[10];

//-----

int bpm=0,ultimobpm=0;
int somabpm=0;
int o2=0,ultimoo2=0;
int somao2=0;
int contadoroximetro=0;

#include <Wire.h>
#include "MAX30100_PulseOximeter.h"


#define REPORTING_PERIOD_MS     1000

PulseOximeter pox;

uint32_t tsLastReport = 0;

void onBeatDetected()
{
    Serial.println("Beat!");
}

void setup()
{
    pinMode(botao, INPUT);

    pinMode(LEDr, OUTPUT);
    pinMode(LEDy, OUTPUT);
    pinMode(LEDg, OUTPUT);

    pinMode(8, OUTPUT),
    pinMode(9, OUTPUT);

    pinMode(A0, INPUT);

    digitalWrite(LEDr,HIGH);

    Serial.begin(9600);

    Serial.print("Initializing pulse oximeter..");

    if (!pox.begin()) {
        Serial.println("FAILED");
        for(;;);
    } else {
        Serial.println("SUCCESS");
    }

    pox.setOnBeatDetectedCallback(onBeatDetected);
}


void loop(){
  
  if (modo == 3){
    if (digitalRead(botao) == HIGH){
      while(digitalRead(botao)== HIGH){
        Serial.println("pressionando");
      }
      digitalWrite(LEDy,HIGH);
      digitalWrite(LEDr,LOW);
      digitalWrite(LEDg, LOW);
      digitalWrite(8, LOW);
      digitalWrite(9, LOW);
      modo = 2;

      for(int i=0;i<10;i++){
        media[i]=(analogRead(A0)*(5.0/1023))/0.01;
        temp=temp+media[1];
        delay(100);     
      }
      temp=temp/10.0;
      
      for(int i=0;i<10;i++){
        media[i]=(analogRead(A0)*(5.0/1023))/0.01;
        temp=temp+media[1];
        delay(100);     
      }
      temp=temp/10.0;
    }
  }

  if (modo == 2){
    pox.update();

    Serial.print("Heart rate:");
    Serial.print(pox.getHeartRate());
    Serial.print("bpm / SpO2:");
    Serial.print(pox.getSpO2());
    Serial.println("%");

    if(oxi_read == false){
        
        ultimobpm = pox.getHeartRate();
        ultimoo2 = pox.getSpO2();

        if(ultimobpm > 50){
            contadoroximetro = contadoroximetro + 1;

            somao2 = somao2 + ultimoo2;
            o2 = somao2/contadoroximetro;

            somabpm = somabpm + ultimobpm;
            bpm = somabpm/contadoroximetro;  

        }else if(ultimobpm < 50 && bpm != contadoroximetro){
            digitalWrite(8, HIGH);
            oxi_read = true;
        }

        tsLastReport = millis();
        
        
    }

    if(temp_read == false){
      if(primeiratemp == 0 && temp != 0){
        primeiratemp = temp;
      }

      for(int i=0;i<10;i++){
        media[i]=(analogRead(A0)*(5.0/1023))/0.01;
        temp=temp+media[1];
        delay(100);     
      }
      temp=temp/10.0;

      if(temp!=ultimatemp){
        ultimatemp=temp;
        Serial.println("Temp: ");
        Serial.println(primeiratemp);
        Serial.println(temp);
        Serial.println("°C");
      }

      if(primeiratemp != 0 && (primeiratemp + 4) < temp){
        temp_read = true;
        digitalWrite(9, HIGH);
      }

      
    }


    if (temp_read == true && oxi_read == true){

      modo = 1;
      Serial.println("Temperatura:");
      Serial.println(ultimatemp);

      Serial.println("BPM e Saturacao de Oxigenio:");
      Serial.println(ultimobpm);
      Serial.println(ultimoo2);

      digitalWrite(LEDy,LOW);
      digitalWrite(LEDr,LOW);   
      digitalWrite(LEDg, HIGH);
    }
  }

  if (modo == 1){
    if (digitalRead(botao) == HIGH){
      while(digitalRead(botao)==HIGH)
      {}
      modo = 3;
      digitalWrite(LEDy,LOW);
      digitalWrite(LEDr,HIGH);
      digitalWrite(LEDg, LOW);
      digitalWrite(8, LOW);
      digitalWrite(9, LOW);

      oxi_read = false;
      temp_read = false;
    } 
  }

}