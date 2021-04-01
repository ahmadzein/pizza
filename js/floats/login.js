function login(){
    console.log("logging in");
    
    
        if(event){
       event.preventDefault();
}
    var elements = pj("#logForm").elements;
    var obj ={};
    for(var i = 0 ; i < elements.length ; i++){
        var item = elements.item(i);
        obj[item.name] = item.value;
    }   
      const Http = new XMLHttpRequest();
    var params = JSON.stringify(obj);

Http.open("POST", "../../api/login.php", true);
Http.send(params);

Http.onreadystatechange = (e) => {
         if(Http.readyState== 4){
             var result =Http.responseText;
             if(result == true){
                 console.log("successs");
                                  closeFloat(true);

                 signedIn();
                 }else{
                     pj("#msg").innerHTML= result; 
                 }

         }
}




}