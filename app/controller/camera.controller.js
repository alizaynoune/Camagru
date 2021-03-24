//////////////////////////////////////////////////////////////////
/////// valid value input from title of new post ////////////////
/////////////////////////////////////////////////////////////////
function        valid_title(title){
    var Reg = /^\S.*\S$/;
    if (!title)
        return(false);
    if (title.value.length === 0){
        title.classList.remove('error');
        return true;
    }
    if (!Reg.test(title.value)){
        title.classList.add('error');
        return false;
    }

    if (title.value.length > 50){
        title.classList.add('error');
        return false;
    }
    else{
        title.classList.remove('error');
        return true;
    }
}

//////////////////////////////////////////////////////////////
/////////// live validation input title value ////////////////
//////////////////////////////////////////////////////////////
const form = document.querySelector('form');
var title = form.querySelector("input[name='title']");
if (title){
    title.addEventListener('input', (e)=>{
    valid_title(title);
    });
}
//////////////////////////////////////////////////////////////
/////////// event where submit new post //////////////////////
//////////////////////////////////////////////////////////////
form.addEventListener('submit', (e) =>{
    var _Error_ = document.querySelector('.error');
    var _Success_ = document.querySelector('.success');
    _Error_.innerHTML = '';
    _Success_.innerHTML = '';
    
    e.preventDefault();
    if (valid_title(title) === false){
        e.preventDefault();
        _Error_.innerHTML = 'title invalid';
        return false;
    }
    
    const canvas = document.getElementById('canva_id');
    const canva = document.getElementById('canva');
    var img = canva.toDataURL('image/png');
    if (img === document.getElementById('hiddenCanva').toDataURL()){
        _Error_.innerHTML = 'blanck canva';
        e.preventDefault();
        return false;
    }
    var stickers = [];
    var left = [];
    var top = [];
    var width = [];
    var height = [];
    var i = 0;
    var rect = canva.getBoundingClientRect();

    /////////////////////////////////////////////////////////////////////////////////////////
    ////// loop for all sticker at canvas (get all information about sticker selectd) ///////
    /////////////////////////////////////////////////////////////////////////////////////////
    var all_filter = canvas.querySelectorAll('.filter');
    for(var j = 0; j < all_filter.length; j++ ){
        var e = all_filter[j];
        left.push(e.style.left.match(/[\d\.]+/g).join(''));
        top.push(e.style.top.match(/[\d\.]+/g).join(''));
        width.push(e.style.width.match(/[\d\.]+/g).join(''));
        height.push(e.style.height.match(/[\d\.]+/g).join(''));
        var name = e.querySelector('img').src.split('/');
        stickers.push(name[name.length - 1]);
        i++;
    }
    ////////////////////////////////////////////////////////////////////////////////////
    ///////// if no sticker selected check if aready captur or sticker is disable //////
    ////////////////////////////////////////////////////////////////////////////////////
    if (i === 0 && document.getElementById('checkbox-stickers').checked === true && captur === 0){
        _Error_.innerHTML = 'please choose stickers or deactivate it';
        e.preventDefault();
        return false;
        
    }
    form.querySelector("input[name='canva']").value = img;
    form.querySelector("input[name='stickers']").value = stickers;
    form.querySelector("input[name='left']").value = left;
    form.querySelector("input[name='top']").value = top;
    form.querySelector("input[name='width']").value = width;
    form.querySelector("input[name='height']").value = height;
    
    
    //////////////////////////////////////////////////////////////////////////////
    ///////////////////////////////ajax send data to server///////////////////////
    //////////////////////////////////////////////////////////////////////////////
    var url = '../../model/NewPost.model.php';
    var request = new XMLHttpRequest();
    request.open('POST', url, true);
    var page = document.querySelector('.thumbnails');
    request.onload = function(){
        try{
            var ret =JSON.parse(this.responseText);
            if (ret !== false){
                var post = new_post(ret);
                page.insertBefore(post, page.firstChild);
                _Success_.innerHTML = 'Success Share';
                if (lastdate === '0'){
                    var today = new Date();
                    var date = today.getFullYear()+'-'+(today.getMonth()+1)+'-'+today.getDate();
                    var time = today.getHours() + ":" + today.getMinutes() + ":" + (today.getSeconds() - 2);
                    lastdate = date+' '+time;
                }
            }
            else
            _Error_.innerHTML = 'Error Share';
            form.querySelector("input[name='stickers']").value = '';
            form.querySelector("input[name='left']").value = '';
            form.querySelector("input[name='top']").value = '';
            form.querySelector("input[name='width']").value = '';
            form.querySelector("input[name='height']").value = '';
            form.querySelector("input[name='title']").value = '';
        }catch(e){
            _Error_.innerHTML = 'invalid informtion';
        }
    };
    request.onerror = function(){
        _Error_.innerHTML = 'Errors Share';
    };
    request.send(new FormData(form));
    if (typeof e.preventDefault === "function") { 
        e.preventDefault();
    } else {
        return false;
    }
});