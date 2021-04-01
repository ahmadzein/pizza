function addAddress(form){
       if (!validateFormGlobal(form)){
  }else{
    
        if(event){
       event.preventDefault();
}
    var elements = document.getElementById("addAddressForm").elements;
    var obj ={};
    for(var i = 0 ; i < elements.length ; i++){
        var item = elements.item(i);
        obj[item.name] = item.value;
    }   
      const Http = new XMLHttpRequest();
    var params = JSON.stringify(obj);

Http.open("POST", "../../api/address/add.php", true);
Http.send(params);
Http.onreadystatechange = (e) => {
         if(Http.readyState== 4){
             var result =JSON.parse(Http.responseText);
                 if(result["result"]){
                  closeFloat(true);
                        popMessage("Update Saved Succesfully");
                     
                     var uid= Math.floor(Math.random() * 100)+Math.floor(Math.random() * 100)+Math.floor(Math.random() * 100);
                    var appander  =  `<form class="padd-10" id="addressForm`+uid+`">


                     <div class="profileSection hidden">

    <label>ID:</label> 
        
        <div class="gInput disabled">
							<input value="`+result['id']+`" type="number" name="id" placeholder="ID" autocomplete="" disabled="">
							
						</div>
         <x-icon onclick="editSection(this);" name="edit" size="15px"></x-icon>
    </div>
         <div class="profileSection hidden">

    <label>UID:</label> 
        
        <div class="gInput disabled">
							<input value="pzu5ff8d6999c7d7" type="number" name="user_id" placeholder="UID" autocomplete="" disabled="">
							
						</div>
         <x-icon onclick="editSection(this);" name="edit" size="15px"></x-icon>
    </div>
         <div class="profileSection ">

    <label>Address label:</label> 
        
        <div class="gInput required disabled">
							<input value="`+obj['name']+`" type="text" name="name" placeholder="Address label" autocomplete="shipping address-label" disabled="" minlength="2" maxlength="25" required="">
							
						</div>
         <x-icon onclick="editSection(this);" name="edit" size="15px"></x-icon>
    </div>
         <div class="profileSection ">

    <label>Contact Number:</label> 
        
        <div class="gInput required disabled">
							<input value="`+obj['contact']+`" type="tel" name="contact" placeholder="Contact Number" autocomplete="shipping tel" disabled="" minlength="3" maxlength="40" pattern="^[0-9-+\s()]*$" required="">
							
						</div>
         <x-icon onclick="editSection(this);" name="edit" size="15px"></x-icon>
    </div>
         <div class="profileSection ">

    <label>Address Line:</label> 
        
        <div class="gInput required disabled">
							<input value="`+obj['address_line_1']+`" type="text" name="address_line_1" placeholder="Address Line" autocomplete="shipping address-line1" disabled="" minlength="2" maxlength="100" required="">
							
						</div>
         <x-icon onclick="editSection(this);" name="edit" size="15px"></x-icon>
    </div>
         <div class="profileSection ">

    <label>Address Line Two:</label> 
        
        <div class="gInput disabled">
							<input value="`+obj['address_line_2']+`" type="text" name="address_line_2" placeholder="Address Line Two" autocomplete="shipping address-line2" disabled="" minlength="2" maxlength="25">
							
						</div>
         <x-icon onclick="editSection(this);" name="edit" size="15px"></x-icon>
    </div>
         <div class="profileSection ">

    <label>City:</label> 
        
        <div class="gInput required disabled">
							<input value="`+obj['city']+`" type="text" name="city" placeholder="City" autocomplete="shipping address-level2" disabled="" minlength="2" maxlength="100" required="">
							
						</div>
         <x-icon onclick="editSection(this);" name="edit" size="15px"></x-icon>
    </div>
         <div class="profileSection ">

    <label>Postal Code:</label> 
        
        <div class="gInput required disabled">
							<input value="`+obj['postalcode']+`" type="text" name="postalcode" placeholder="Postal Code" autocomplete="shipping postal-code" disabled="" minlength="6" maxlength="8" required="">
							
						</div>
         <x-icon onclick="editSection(this);" name="edit" size="15px"></x-icon>
    </div>
         <div class="profileSection ">

    <label>Delivery Note:</label> 
        
        <div class="gInput disabled">
							<input value="`+obj['note']+`" type="text" name="note" placeholder="Delivery Note" autocomplete="shipping note" disabled="" minlength="5" maxlength="255">
							
						</div>
         <x-icon onclick="editSection(this);" name="edit" size="15px"></x-icon>
    </div>
                    
                
                
                
                
                
    <button data-key="`+uid+`" onclick="updateAddress('addressForm`+uid+`');">Save</button>
    </form>`;
                     
             var list =pj("#address");         
                    
                     
                     
                     var node = document.createElement("div");  
node.classList.add("panel");

node.innerHTML =appander;  
   list.insertBefore(node, list.childNodes[0]) ;  
                                  var node = document.createElement("button");        
       
 node.innerHTML=obj['name'];
node.classList.add("accordion");
                     node.setAttribute("id", "addttl"+uid.toString);
    list.insertBefore(node, list.childNodes[0]) ;                
                     
              

            fixInputs();            
                   startacc();
  intIcons(true);
                     
                     
}else{
        popMessage("error");
                 };

         }
}

}


}