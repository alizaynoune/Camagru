function    clickbtn(elem){
    elem.classList.toggle('btnActive');
    var list = document.querySelector('.list');
    list.classList.toggle('show');
    var children = list.children;
    
    if (list.classList.contains('show')){
        for (var i = 0; i < children.length; i++){
            children[i].style.transition = `all ease ${i / 1.5}s`;
        }
    }
}