/* Avomation by Avocado 2017
 *  This program recieves serial data. With it, it decides if to play a tone or turn on/off a light
 * Use this as you want boi :D
 */
int buzzer = 9 ; //Digital out to buzzer 9
int led = 10; //Pin to led on digital out
String data;
int tempo = 100; //Tempo of the "song"
int noteFre = 0; //The note frecuency
int noteLen = 0; //Note duration. we use it to get the data from serial
unsigned long noteEnd = 0; //We use it to know when the note is over

int incomingData = 0; //We use this to recieve data from serial; we parse this shit

bool isNotePlaying = false; //We check if we are playing a note

void setup() {
  Serial.begin(9600); //We start the serial data, so we can recive data
  Serial.setTimeout(50);//This fucking shit is by default 1000 ms wtf 
  pinMode(buzzer, OUTPUT); //We set this pin out so the buzzer can play sounds
  pinMode(led, OUTPUT); //This pin is for the led
  
  

}

void loop() {


  if(Serial.available() > 0){//We check if we have something in the serial
    data = Serial.readString();//We get the string from the serial data
    if(data == "n"){//Is the String is Only N it means in on (I used the last letter of on for this because off starts with an o too
      digitalWrite(led, HIGH);//We turn on the led
    }
    else if(data == "f"){//Is the string in data is only off it means we should turn off the light
      digitalWrite(led, LOW);//We turn off the lighto
    }
    else{//If not a on or off message, we parse the data and play the tone
      noteFre = parseFre(data);//WE parse the data here
      noteLen = parseLen(data);
      if(isNotePlaying == false and noteFre > 0) {//If a note is not playing and the frecuency > 0 
        //noteLen = 1000;
        noteEnd = noteLen+millis();//This helps to know where the notes ends with each loop
        //Here we print the note len and the finish time of the note
        Serial.print("Note Frecuency: ");
        Serial.println(noteFre);
        Serial.print("Note len: ");
        Serial.println(noteLen);
        Serial.print("Note End: ");
        Serial.println(noteEnd);
        tone(buzzer,noteFre);//Here we play the tone
        isNotePlaying = true; //This prevents to play again the tone before the noteEnd reach it end
      }
    }
  }

  if(isNotePlaying == true and millis() >= noteEnd){//Each loop we compare the actual millisecs and the note end. This way we know if the note have reached it end lmao
    noTone(buzzer);//we stop playing
    Serial.println("Stopped playing note");
    isNotePlaying = false;//We set this false so we can play another note
  }

}

int parseFre(String data){//we use this to parse the tone (frellen) we cut from the l to the end 
  data.remove(data.indexOf("l"));
  return data.toInt();
}

int parseLen(String data){//we use this to parse the len (frellen) we cut everything before the l+1
  data.remove(0,data.indexOf("l")+1);
  return data.toInt();
}




