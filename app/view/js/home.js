var     lastdate = '0';
var     contener = document.querySelector('.page');




window.addEventListener('load', function(){
    request_all(lastdate, contener);
    window.addEventListener('scroll', function(e){
        if ((Math.ceil(window.innerHeight + window.pageYOffset)) >= document.body.offsetHeight){
            request_all(lastdate, contener);
        }
    });
});

document.querySelector('.load_more').addEventListener('click', (e)=>{
    request_all(lastdate, contener);
    
});
