function    clickbtn(elem){
    // elem.classList.toggle('btnActive');
    var list = document.querySelector('.list');
    list.classList.toggle('show');
    var children = list.children;
    
    if (list.classList.contains('show')){
        for (var i = 0; i < children.length; i++){
            children[i].style.transition = `all ease ${i / 2.2}s`;
        }
    }
}


var oldScroll = window.pageYOffset;

window.addEventListener('load', function(){
    var menu = document.querySelector('.list');

    window.addEventListener('scroll', function(e){
        currScroll = window.pageYOffset;
        if ((currScroll - oldScroll) > 50){
            oldScroll = currScroll;
            navBar.classList.add('navHidden');
            menu.classList.remove('show');
        }
        else if ((oldScroll - currScroll) > 50){
            navBar.classList.remove('navHidden');
            menu.classList.remove('show');
            oldScroll = currScroll;
        }
        // console.log(oldScroll + ' ' + currScroll);
    });
});

