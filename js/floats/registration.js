console.log("loaded");
var currentTab = 0; // Current tab is set to be the first tab (0)
showTab(currentTab); // Display the current tab
var input = pj('#regForm');
var inputp = pj('#personalForm');
var inputa = pj('#addressForm');

//input.addEventListener('change', validateForm);
inputp.addEventListener('change', function() { validateForm("personalForm"); });
inputa.addEventListener('change', function() { validateForm("addressForm"); });

function showTab(n) {
    console.log("tabber "+ n);
  // This function will display the specified tab of the form...
  var x = document.getElementsByClassName("tab");
  x[n].style.display = "grid";

  //... and fix the Previous/Next buttons:
  if (n == 0) {
    document.getElementById("prevBtn").style.display = "none";
  } else if (n < x.length -1) {
    document.getElementById("prevBtn").style.display = "inline";
  }else{
          document.getElementById("prevBtn").style.display = "none";
  }
  if (n == (x.length - 2)) {
    document.getElementById("nextBtn").style.display = "none";
     document.getElementById("submitBtn").style.display = "inline";

  } else if (n < x.length -1) {
    document.getElementById("nextBtn").style.display = "inline";
     document.getElementById("submitBtn").style.display = "none";
      
  }else{
         document.getElementById("nextBtn").style.display = "none";
     document.getElementById("submitBtn").style.display = "none"; 
  }
  //... and run a function that will display the correct step indicator:
  fixStepIndicator(n)
}

function nextPrev(n) {

  // This function will figure out which tab to display
  var x = document.getElementsByClassName("tab");
  // Exit the function if any field in the current tab is invalid:
  if (n == 1 && ! validateForm("personalForm")) return false;

  // Increase or decrease the current tab by 1:
  currentTab = currentTab + n;

      // Hide the current tab:
 // x[currentTab].style.display = "grid";
    currentPossition =((100*currentTab)*-1) + "%";
    console.log(currentPossition);
    pj("#tabHolder").style.left = currentPossition;
    
  // if you have reached the end of the form...
  if (currentTab >= x.length -1 ) {
    
  }
  // Otherwise, display the correct tab:
  showTab(currentTab);
}

function validateForm(form) {
     
  //  console.log("validating...");
    return validateFormGlobal(form);
}



function fixStepIndicator(n) {
        console.log("fixStepIndicator");

  // This function removes the "active" class of all steps...
  var i, x = document.getElementsByClassName("step");
  for (i = 0; i < x.length; i++) {
    x[i].className = x[i].className.replace(" active", "");
  }
  //... and adds the "active" class on the current step:
  x[n].className += " active";
}


function submitForm(e){
  if (!validateForm("addressForm")){
console.log("not valid");   
  }else{
          var elements = document.getElementById("personalForm").elements;
          var elements2 = document.getElementById("addressForm").elements;
    var obj ={};
    for(var i = 0 ; i < elements.length ; i++){
        var item = elements.item(i);
        obj[item.name] = item.value;
    }
       for(var i = 0 ; i < elements2.length ; i++){
        var item = elements2.item(i);
        obj[item.name] = item.value;
    }

        var http = new XMLHttpRequest();
    http.open("POST", "api/register.php", true);
    http.setRequestHeader("Content-type","application/x-www-form-urlencoded");
    var params = JSON.stringify(obj);
        // probably use document.getElementById(...).value
    http.send(params);
    http.onload = function() {
if(http.responseText == true){
    

    pj("#thanks").innerHTML ='<div class="al-c "><x-icon  name="check-circle" size="145px" ></x-icon>'+
        '<h1>Thank for registering</h1></div>';
    nextPrev(1);
    console.log("sucsess");
  
    setTimeout((e) => {
        signedIn();
          closeFloat(true);
   }, 2000);

   // pj("#regForm").style.opacity = "0";
    
}else{
           popMessage(http.responseText);
 
}
        
    }
    
    
    }
};
