
function        valid_titel(elem){
    let REG = /^[\w-_\--\d]+$/;
    if (titel.value.length === 0){
        titel.classList.remove('error');
        return true;
    }
    if (!REG.test(titel.value)){
        titel.classList.add('error');
        return false;
    }
    else{
        titel.classList.remove('error');
        return true;
    }
}

const form = document.querySelector('form');
var titel = form.querySelector("input[name='titel']");
titel.addEventListener('input', (e)=>{
    valid_titel(titel);
        
})
form.addEventListener('submit', (e) =>{
    console.log('valid_done_');
    
    if (valid_titel(titel) === false){
        e.preventDefault();
        return false;
    }
    
    const canvas = document.getElementById('canva_id');
    const canva = document.getElementById('canva');
    var img = canva.toDataURL('image/png');
    if (img === document.getElementById('hiddenCanva').toDataURL()){
        document.querySelector('.error').innerHTML = 'blanck canva';
        e.preventDefault();
        return false;
    }

    var stickers = [];
    var left = [];
    var top = [];
    var retate = [];
    var size = [];
    form.querySelector("input[name='canva']").value = img;
    canvas.querySelectorAll('.filter').forEach((e)=>{
        left.push(e.style.left.match(/[\d\.]+/g).join(''));
        top.push(e.style.top.match(/[\d\.]+/g).join(''));
        size.push(e.style.width.match(/[\d\.]+/g).join(''));
        let elem = e.querySelector('img');
        retate.push(elem.style.transform.match(/[\d\.]+/g).join(''));
        let name = elem.src.split('/');
        stickers.push(name[name.length - 1]);
    })
    form.querySelector("input[name='stickers']").value = stickers;
    form.querySelector("input[name='left']").value = left;
    form.querySelector("input[name='top']").value = top;
    form.querySelector("input[name='retate']").value = retate;
    form.querySelector("input[name='size']").value = size;
    
    return true;
});


