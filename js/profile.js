console.log("profile is laoded");

pj("#profile").querySelectorAll('input').forEach((input) => {
    if(input.disabled){
input.parentNode.classList.add("disabled");

    };
  });
function editSection(e){
    console.log("click");
    var fixer= event.currentTarget.parentElement.getElementsByClassName("gInput")[0];
    fixer.classList.remove("disabled");
    fixer.getElementsByTagName("input")[0].disabled = false;
   
};
function saveChanges(form){
     event.preventDefault();
  if (!validateFormGlobal(form)){
  }else{
          var elements = document.getElementById(form).elements;
    var obj ={};
    for(var i = 0 ; i < elements.length ; i++){
        var item = elements.item(i);
        obj[item.name] = item.value;
    }

        var http = new XMLHttpRequest();
    http.open("POST", "api/user/update.php", true);
    http.setRequestHeader("Content-type","application/x-www-form-urlencoded");

    var params = JSON.stringify(obj);
        // probably use document.getElementById(...).value

    http.send(params);
    http.onload = function() {

if(JSON.parse(http.responseText)["result"]){
   popMessage("Update Saved Succesfully");
    signedIn();
}else{
        popMessage("error");
}
        
    }
    
    
    }


};


function updateAddress(form){
    
    if (!validateFormGlobal(form)){
  }else{
     event.preventDefault();
  if (1==2){
console.log("not valid");   
  }else{
          var elements = document.getElementById(form).elements;
    var obj ={};
    for(var i = 0 ; i < elements.length ; i++){
        var item = elements.item(i);
        obj[item.name] = item.value;
    }

        var http = new XMLHttpRequest();
    http.open("POST", "api/address/update.php", true);
    http.setRequestHeader("Content-type","application/x-www-form-urlencoded");
    var params = JSON.stringify(obj);
        // probably use document.getElementById(...).value
    http.send(params);
    http.onload = function() {
             var result =JSON.parse(http.responseText);
                 if(result["result"]){
                     popMessage("Update Saved Succesfully");
}else{
        popMessage("error");
              
                 };

         
/*if(JSON.parse(http.responseText)["result"]){
            signedIn();
  console.log("updated");
}
        */
    }
    
    
    }
    }
}

function openTab(name) {
         event.preventDefault();

  var i;
  var x = document.getElementsByClassName("tab");
  for (i = 0; i < x.length; i++) {
    x[i].style.display = "none";  
  }
  document.getElementById(name).style.display = "grid";  
}


var acc = document.getElementsByClassName("accordion");
var i;

for (i = 0; i < acc.length; i++) {
  acc[i].addEventListener("click", function() {
    this.classList.toggle("active");
    var panel = this.nextElementSibling;
    if (panel.style.maxHeight) {
      panel.style.maxHeight = null;
    } else {
      panel.style.maxHeight = panel.scrollHeight + "px";
    }
  });
}

    fixInputs();
