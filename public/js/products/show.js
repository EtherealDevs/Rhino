function sizeOptionChanged(){
    var select = document.getElementById('size-selector');
    var selectedOption = select.options[select.selectedIndex];
    var stock = selectedOption.dataset.stock;
    var eventName = `changed-size-option-${select.selectedIndex}`

    select.dispatchEvent(new Event(eventName, {'bubbles' : true}))
}
function populateProductSubmitForm(event, sizes)
{
    event.preventDefault();
    var form = document.getElementById('sendProductToCart');

    var counter = document.getElementById('counter');
    var counterInput = document.getElementById('counterInput');

    var sizeSelector = document.getElementById('size-selector');
    var sizeInput = document.getElementById('sizeInput');

    
    counterInput.value = counter.innerText;
    sizeInput.value = sizeSelector.value;

    var selectedSize;
    var sizeExists = false;

    sizes.forEach(element => {
        if (element.name == sizeInput.value)
            {
                console.log(`Size selected: ${element.name}`);
                console.log(element);
                console.log(sizeInput.value);
                sizeExists = true;
                selectedSize = element;
                return;
            }
    });
    if (counterInput.value > 0 && counterInput.value <= selectedSize.pivot.stock && sizeExists) {
        form.submit();
    }

}