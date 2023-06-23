void printGrid(String text){
  globGrid = "";
  globRows[0] = "";
  globRows[1] = "";
  globRows[2] = "";
  globRows[3] = "";
  globRows[4] = "";
  for (int j = 0; j < text.length(); j++) {
    char sym = text.charAt(j);
    //loop through dictionary; -> find that symbol and its value
    for (int i = 0; i < sizeof(symLabels)/sizeof(symLabels[0]); i++) {
      if(symLabels[i]==sym){
        globRows[0] += symVals[i][0]+((j<text.length()-1)?"0":"");
        globRows[1] += symVals[i][1]+((j<text.length()-1)?"0":"");
        globRows[2] += symVals[i][2]+((j<text.length()-1)?"0":"");
        globRows[3] += symVals[i][3]+((j<text.length()-1)?"0":"");
        globRows[4] += symVals[i][4]+((j<text.length()-1)?"0":"");
      }
    }
  }
  //full length of message -> globRows[0].length()
  int sx = 13 - ((globRows[0].length()>27)?12:round(globRows[0].length()/2)); //center text
  int sy = 2;
//  clean sides
//left
  for(int i=0;i<sx;i++){
    for(int py = 0; py<5;py++){
      leds[ledsPos[py+sy][i]] = MRGB(0,0,0);
    }
  }
  //right
  for(int i=(sx+globRows[0].length());i<27;i++){
    for(int py = 0; py<5;py++){
      leds[ledsPos[py+sy][i]] = MRGB(0,0,0);
    }
  }
//  Serial.println(round(globRows[0].length()/2));
  //PRINT MATRIX
  for(int px = 0;px<globRows[0].length();px++){
    for(int py = 0; py<5;py++){
      switch(globRows[py][px]){
        case '1':
        drawWithColor(ledsPos[py+sy][px+sx]);
//          leds[ledsPos[py+sy][px+sx]] = CRGB::Blue;
        break;
        case '0':
         leds[ledsPos[py+sy][px+sx]] = CRGB::Black;
        break;
      }
     
    }
  }
  FastLED.show();
}