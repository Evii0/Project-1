function qualificationSelection(){
    var valid = false;

    var radios = document.getElementsByName("sales");
    for( i = 0; i < radios.length; i++){
      if(radios[i].checked){
        valid = true;
      }
    }

    radios = document.getElementsByName("property");
    for( i = 0; i < radios.length; i++){
      if(radios[i].checked){
        valid = true;
      }
    }

    radios = document.getElementsByName("branch");
    for( i = 0; i < radios.length; i++){
      if(radios[i].checked){
        valid = true;
      }
    }
    if(valid){
        nextSection('qualificationRecognition');
    }
}
