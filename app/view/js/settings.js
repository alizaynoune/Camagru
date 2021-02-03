function        hedin_modal(){
    let elem = document.querySelector('.modal');
    elem.style.width = '0px';
    elem.style.height = '0px';
    children = elem.getElementsByTagName('label');
    for (var i = 0; i < children.length; i++){
        children[i].style.display = 'none';
    }
}

function        show_modal(){
    let elem = document.querySelector('.modal');
    elem.style.width = '700px';
    elem.style.height = '500px';
    children = elem.getElementsByTagName('label');
    for (var i = 0; i < children.length; i++){
        children[i].style.display = 'block';
    }
}