
var oldScroll = window.pageYOffset;
var navBar = document.querySelector('.navBar');
window.addEventListener('load', function(){
    window.addEventListener('scroll', function(e){
        currScroll = window.pageYOffset;
        if ((currScroll - oldScroll) > 50){
            oldScroll = currScroll;
            navBar.classList.add('navHidden');
        }
        else if ((oldScroll - currScroll) > 50){
            navBar.classList.remove('navHidden');
            oldScroll = currScroll;
        }
    });
});


