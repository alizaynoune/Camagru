const form = document.querySelector('form');
form.addEventListener('submit', (e) =>{
    // const form = document.querySelector('form');
    // if (validationAll(form))
    // console.log(e);
    console.log('valid_done_');
    // console.log(cavas);
    // console.log(form);
    // validInputsCamera(from);
        e.preventDefault();
    
    const canvas = document.getElementById('canva_id');
    const canva = document.getElementById('canva');
    const canvasData = canva.toDataURL('image/png');
    console.log(canvasData);
    // validInputsCamera(form);
    return false;
});


function            validInputsCamera(form){
    const   inputs = form.querySelectorAll('input');

    inputs.forEach((e)=>{
        console.log(e);
    });
}