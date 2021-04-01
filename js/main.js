    window.addEventListener('load', (event) => {


        var path = window.location.pathname.substring(1).split("/");
        if(path[0] == "index" || path[0] == "" ||  !path ){

                var page = "home";

        }else{
                var page = path[0];

        }

       navigateTo(page);



    fixInputs();
        updateCart(true);
    console.log('page is fully loaded');
    });

function loading(){
    pj("#loading").classList.remove("hidden");
}
function loaded(){
        pj("#loading").classList.add("hidden");

}

    function fixInputs(){
         pj(".iconInput",1).forEach(
            function (element){ 
    element.setAttribute("data-tmp", element.getElementsByTagName("input")[0].placeholder);                 

                if (element.getElementsByTagName("input")[0].required){
                    element.classList.add("required");
                }
        }

                                  );

             pj(".gInput",1).forEach(
            function (element){ 

if(element.getElementsByTagName("input").length > 0){
                if (element.getElementsByTagName("input")[0].required){
                    element.classList.add("required");
                }
    }else{

          if (element.getElementsByTagName("textarea")[0].required){
          

                    element.classList.add("required");
                }
        
    }
        }

                                  );



    }


    function popMessage(msg){
                if(event){
           event.preventDefault();
    }
        console.log(msg);
        pj("#globalNotification").style.display = "block";
        if(msg == "error"){
            msg ="Something went wrong please contact the webmaster"
        }
        pj("#modal-message").innerHTML= msg.toString();
    }
    function dropMessage(){
        pj("#globalNotification").style.display = "none";
        pj("#modal-message").innerHTML="";

    }


    function openFloat(float,obj={}) {
        if(event){
           event.preventDefault();
    }
            var params = JSON.stringify(obj);

             const Http = new XMLHttpRequest();

    Http.open("POST", "./modules/floats/"+float+".php", true);
    Http.send(params);

    Http.onreadystatechange = (e) => {
             if(Http.readyState== 4){
        pj("#floater").innerHTML = Http.responseText;
        var css = document.createElement("link");
        css.rel = "stylesheet";
          css.type =    "text/css";
        css.href = "css/floats/"+float+".css"; 
        pj("#tempscrpt").appendChild(css);


        var script = document.createElement("script");
        script.type = "text/javascript";
        script.src = "js/floats/"+float+".js"; 
        pj("#tempscrpt").appendChild(script);



      pj("#floated").style.display = "grid";
           setTimeout(() => {   pj("#floated").style.width = "100%";
      pj("#floated").style.opacity = "1";}, 90);
        fixInputs();
             }
    };
    }



function closeFloat(bol= false) {
      if(event === undefined && bol ){
         closer();
      } else if(event.target.id == "floated" || bol){
      closer();
      } 
        function closer(){

      pj("#floated").style.width = "0";
      pj("#floated").style.opacity = "0";
       setTimeout(() => { 

           pj("#floated").style.display = "none";
            pj("#tempscrpt").innerHTML="";
            pj("#floater").innerHTML="";

       }, 900);
        }
 
}


    function openNav() {
      pj("#mySidenav").style.width = "250px";
                pj("#navclosebtn").innerHTML = "&times;"

    }
    function closeNav() {
      pj("#mySidenav").style.width = "0";
        pj("#navclosebtn").innerHTML = ""

    }

    var cart = false
    function cartClick(open= false) {

            console.log(cart);
    if(open){
        cart =false;
    }
        cartbox=pj("#shopping-cart");
        if(cart){
    stopCartTimer();
            document.removeEventListener("click", remoteClose);
      cartbox.style.transform = "scale(0.0)";
            cart = false;

            }else{
    cartbox.style.transform = "scale(1.0)";
                        cart = true;
                setTimeout(() => {    document.addEventListener("click", remoteClose);}, 90)

            }

    }
    function remoteClose(event) {
        // If user clicks inside the element, do nothing
        if (event.target.closest("#shopping-cart")) return;

        // If user clicks outside the element, hide it!
        cartClick();
                cart = false;

    }
    function signedIn(){

                 const Http = new XMLHttpRequest();

    Http.open("GET", "./modules/loggedMenu.php", true);
    Http.send();

    Http.onreadystatechange = (e) => {
             if(Http.readyState== 4){
                    pj("#welcome").innerHTML = Http.responseText;
                 pj("#logoutBTN").classList.remove("hidden");
                 navigateTo(currentPage);
             }
    }


        };

    function logOut(){

            if(event){
           event.preventDefault();
    }
          const Http = new XMLHttpRequest();

    Http.open("GET", "./modules/logout.php", true);
    Http.send();

    Http.onreadystatechange = (e) => {
             if(Http.readyState== 4){
                    pj("#welcome").innerHTML ='  <a href="#" onclick="openFloat(\'registration\');" id="registration">Register</a><span class="h-space-10"> | </span><a href="#" onclick="openFloat(\'login\');">login</a>';
                              pj("#logoutBTN").classList.add("hidden");
                     updateCart();


             }
    }

    };


    window.addEventListener('popstate', function (event) {
        // Log the state data to the console
        navigateTo(event.state['pageName']);
    });

    var currentPage = "home";
    function navigateTo(page){
        loading();
        if(event){
           event.preventDefault();
    }
        currentPage =page;
        var main =pj("#main");
        var mainscript= pj("#maintempscrpt");

    //main.style.display = "none";
             const Http = new XMLHttpRequest();

    Http.open("GET", "../views/"+page+".php", true);
    Http.send();

    Http.onreadystatechange = (e) => {
             if(Http.readyState== 4){
            mainscript.innerHTML="";

        main.innerHTML = Http.responseText;
                 var css = document.createElement("link");
        css.rel = "stylesheet";
          css.type =    "text/css";
        css.href = "css/"+page+".css"; 
        mainscript.appendChild(css);


        var script = document.createElement("script");
        script.type = "text/javascript";
        script.src = "js/"+page+".js"; 
        mainscript.appendChild(script);

setpagetitles(page)
        fixInputs();
              //   main.style.display = "grid";
        loaded();


             }
    };
                      if(event){   

                  if(event.type == "click"){   
                  console.log(event.type);
    const nextURL = window.location.protocol + '//' + window.location.hostname + ":"+window.location.port+ "/" +page ;
    const nextTitle = document.title;
    const nextState = { pageName: page };

    // This will create a new entry in the browser's history, without reloading
    window.history.pushState(nextState, nextTitle, nextURL);
              }};
        closeNav()
    }

function setpagetitles(page){
    var title ="Delicious Pizza | " ;
    var desc;
    switch(page) {
  case "home":
     title += "Oven hot deliverd to you"    
    // code block
    break;
  case "menu":
title   += "Descover Our Menu"    

    break;
  case "profile":
            title += "Profile"
    break;
  case "management":
            title += "Management Center"
    break;
  case "contact":
            title += "Contact Us"
    break;
  case "menu":
title =  preset+ "Checkout"
            break;
  default:
    title ="Delicious Pizza"
}
    document.title = title;
    
}

    function addToCart(id,Q=1,iId = ""){
                document.removeEventListener("click", remoteClose);
                if(event){
           event.preventDefault();
    }

        if(event.target.getAttribute("data-sid") !=false){
                var size =event.target.getAttribute("data-sid");

        }else{
            size=1;
        }
        obj ={"id":id,"Q":Q,"iId":iId.toString(),"size":size};
        console.log(size);
          const Http = new XMLHttpRequest();
        var params = JSON.stringify(obj);

    Http.open("POST", "../../modules/addtocart.php", true);
    Http.send(params);

    Http.onreadystatechange = (e) => {
             if(Http.readyState== 4){
                 var result =Http.responseText;
                 if(currentPage == "checkout"){
              navigateTo(currentPage);

                    }           
                 updateCart();

             }
    }





    };

    function updateCart(obj,closed=false){
        clearTimeout(closer);

              const Http = new XMLHttpRequest();
        var params = JSON.stringify(obj);
    Http.open("POST", "../../modules/updatecart.php", true);
    Http.send(params);

    Http.onreadystatechange = (e) => {
             if(Http.readyState== 4){
                 var result =Http.responseText;

                 pj("#shopping-cart").innerHTML = Http.responseText ;
                 var inpageCart = pj("#shopping-cart-inpage");
    if(inpageCart){
                 inpageCart.innerHTML = Http.responseText ;

        }else{
            console.log("inpage not cart");

        }
                 if(!closed){
              cartClick(true);  
            runCartTimer();                      
    }

             }
    }


    setcarttag();
            document.addEventListener("click", remoteClose);


    };

    function stopCartTimer(){
       clearTimeout(closer);

    }


    var closer;
    function runCartTimer(){
     closer= setTimeout(() => { cartClick(false); }, 8000);

    }
    function setcarttag(){

        console.log("setcarttag");
        console.log(getCookie("cart"));
        number = getCookie("cart");
        if(number == ""){
            number=0;
        }

        pj("#pointer").innerHTML = number;

    }
    function getCookie(cname) {
      var name = cname + "=";
      var decodedCookie = decodeURIComponent(document.cookie);
      var ca = decodedCookie.split(';');
      for(var i = 0; i <ca.length; i++) {
        var c = ca[i];
        while (c.charAt(0) == ' ') {
          c = c.substring(1);
        }
        if (c.indexOf(name) == 0) {
          return c.substring(name.length, c.length);
        }
      }
      return "";
    }







    // Form Validation Check
    function validateFormGlobal(form) {
        form = pj("#"+form);
       form.reportValidity();
        form.reportValidity();
        return form.checkValidity();

    }


