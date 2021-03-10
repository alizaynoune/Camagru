
var oldScroll = window.pageYOffset;
var navBar = document.querySelector('.navBar');


// console.log(heightNav);


window.addEventListener('load', function(){
    // var menu = document.querySelector('.list');
    window.addEventListener('scroll', function(e){
        currScroll = window.pageYOffset;
        if ((currScroll - oldScroll) > 50){
            oldScroll = currScroll;
            navBar.classList.add('navHidden');
            // menu.classList.remove('show');
        }
        else if ((oldScroll - currScroll) > 50){
            navBar.classList.remove('navHidden');
            // menu.classList.remove('show');
            oldScroll = currScroll;
        }
        // console.log(oldScroll + ' ' + currScroll);
    });
});


