var     lastdate = '0';
var     contener = document.querySelector('.page');
var     login = document.querySelector('input[name="login"]').value;


window.addEventListener('load', function(){
    request_profile(login, lastdate, contener);
    window.addEventListener('scroll', function(e){
        if ((Math.ceil(window.innerHeight + window.pageYOffset)) >= document.body.offsetHeight){
            request_profile(login, lastdate, contener);
        }
    });
});

document.querySelector('.load_more').addEventListener('click', (e)=>{
    request_profile(login, lastdate, contener);
});

