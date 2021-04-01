var script = document.currentScript;
var fullUrl = script.src;
        srcIcon = fullUrl;
      
    srcIcon = srcIcon.substr(0, srcIcon.lastIndexOf("/"));
console.log(srcIcon);
var inner =false;
function intIcons(inpage= false){
if(inpage){
    inner=true;
}
    //Get HTML head element ----------------------------------------------------------------------------//
    var head = document.getElementsByTagName('head')[0];
    // Create new link Element 
    var link = document.createElement('link');
    // set the attributes for link element  
    link.rel = 'stylesheet';
    link.type = 'text/css';
    link.href = srcIcon + '/css/xicons.css';
    // Append link element to HTML head 
    head.appendChild(link);


// Create a class for the element
class PopUpInfo extends HTMLElement {
  constructor() {
    // Always call super first in constructor
    super();

    // Create a shadow root
    var shadow = this.attachShadow({mode: 'open'});

    // Create spans

    var icon = document.createElement('span');
    icon.setAttribute('class','icon');
    icon.setAttribute('tabindex', 0);


    // Insert icon
    var iconName;
    if(this.hasAttribute('name')) {
      iconName = this.getAttribute('name');
    } else {
      iconName = 'null';
    }
      //size
      var size;
    if(this.hasAttribute('size')) {
      size = this.getAttribute('size');
    } else {
      size = '40px';
    }

            //color
      var color = getComputedStyle(this).color;
       if(color=="" || color == null || !color ){
          color = "dimgrey";
      }
      //colored icon
      var colored = false
    if(this.hasAttribute('colored')) {
      colored = true;
    }
      
      var path = srcIcon+'/img/'+iconName+'.svg';
if (!doesFileExist(path)) {
      var path = srcIcon+'/img/null.svg';

}
    // Create some CSS to apply to the shadow dom
    var style = document.createElement('style');
    style.textContent = '.icon{display: inline-block;'+
    'width: '+size+';'+
    'height: '+size+';'
    if(colored){
     style.textContent += 
    'background-image:  url('+path+'); '+
        'background-size: contain;'+
    'outline: none;}';
    }else{
             style.textContent += 
'background-color:  '+color+';'+
    '-webkit-mask-image: url('+path+');'+
    'mask-image: url('+path+');'+
    'mask-size: '+size+' '+size+';'+
    '-webkit-mask-size: '+size+' '+size+';'
    }
    // attach the created elements to the shadow dom

    shadow.appendChild(style);
    shadow.appendChild(icon);
  }
}


    if(!inner){
     //creat x-icon
customElements.define('x-icon', PopUpInfo);   
        
    }



function doesFileExist(urlToFile) {
    var xhr = new XMLHttpRequest();
    xhr.open('HEAD', urlToFile, false);
    xhr.send();
     
    if (xhr.status == "404") {
        return false;
    } else {
        return true;
    }
}

}

intIcons();