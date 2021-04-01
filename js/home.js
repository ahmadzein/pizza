function fixprice(id){
    var  options = pj("#sizeDropdown"+id);
    var  btn = pj("#pricebtn"+id);
    var selected =  options.selectedIndex
    var basPrice =options.options[selected].getAttribute('data-pricebase');  
    var price = btn.getAttribute('data-price')*(basPrice/100);

    btn.setAttribute('data-sid',options.value);
    btn.innerHTML = "Add for £" + price.toFixed(2);
};
