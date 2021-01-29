function    clickbtn(elem){
    // var elem = document.getElementsByClassName('menuBtn');
    elem.classList.toggle('btnActive');
    var list = document.querySelector('.list');
    list.classList.toggle('show');
    var children = document.querySelector('.list').children;
    // console.log(children[0]);
    // children.forEach(e => {
    //     console.log(e)
    // });
    // children.forEach(element => {
    //     console.log(element);
    // });
    // console.log(children);
    // $('.menuBtn').toggleClass('btnClose');
    // $('.navLinks').toggleClass('toggleNavLinks');
    // var allChild = $('.navLinks').children();
    // if ($('.btnClose').length > 0){
    //     allChild.each(function(index, elem){
    //         $(elem).css('transition', `all ease ${index / 1.5}s`);
    //     });
    // }
    // if (active)
    //     console.log(active);
}