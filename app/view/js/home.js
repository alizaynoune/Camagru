var     lastdate = '0';
var     contener = document.querySelector('.container');




window.addEventListener('load', function(){
    request_all(lastdate, contener);
    window.addEventListener('scroll', function(e){
        var tst = Math.ceil(window.innerHeight + window.pageYOffset);
        if ((Math.ceil(window.innerHeight + window.pageYOffset)) >= document.body.offsetHeight){
            request_all(lastdate, contener);
        }
    });
});

