


const form = document.querySelector('form');
var titel = form.querySelector("input[name='titel']");
titel.addEventListener('input', (e)=>{
    let REG = /^[\w-_\--\d]+$/;
    if (!REG.test(titel.value))
        console.log('error');
        
})
form.addEventListener('submit', (e) =>{
    // const form = document.querySelector('form');
    // if (validationAll(form))
    // console.log(e);
    console.log('valid_done_');
    // console.log(cavas);
    // console.log(form);
    // validInputsCamera(from);
    //////////valid titel img/////////////////////
    //////////////////////////////////////////////
        // e.preventDefault();
    
    const canvas = document.getElementById('canva_id');
    const canva = document.getElementById('canva');
    var img = canva.toDataURL('image/png');
    var stickers = [];
    var left = [];
    var top = [];
    var retate = [];
    var size = [];
    form.querySelector("input[name='canva']").value = img;
    canvas.querySelectorAll('.filter').forEach((e)=>{
        left.push(e.style.left.match(/\d/g).join(''));
        top.push(e.style.top.match(/\d/g).join(''));
        size.push(e.style.width.match(/\d/g).join(''));
        let elem = e.querySelector('img');
        retate.push(elem.style.transform.match(/\d/g).join(''));
        let name = elem.src.split('/');
        stickers.push(name[name.length - 1]);
    })
    form.querySelector("input[name='stickers']").value = stickers;
    form.querySelector("input[name='left']").value = left;
    form.querySelector("input[name='top']").value = top;
    form.querySelector("input[name='retate']").value = retate;
    form.querySelector("input[name='size']").value = size;
    
    return false;
});


function            validInputsCamera(form){
    const   inputs = form.querySelectorAll('input');

    inputs.forEach((e)=>{
        console.log(e);
    });
}