function sizeOptionChanged(){
    var select = document.getElementById('size-selector');
    var selectedOption = select.options[select.selectedIndex];
    var stock = selectedOption.dataset.stock;
    var eventName = `changed-size-option-${select.selectedIndex}`

    select.dispatchEvent(new Event(eventName, {'bubbles' : true}))
}