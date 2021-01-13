function        validationPasswd(Input){
    if (Input.value.length < 8)
        return(1);
    else
        return(0);
}

function        validationConfPasswd(Input, passwd){
    if (Input.value !== passwd.value)
        return(1);
    else
        return(0);
}

function        validationEmail(Input){
    if (!Input.validity.valid)
        return(1);
    else
        return(0);
}



function        validationLogin(Input){
    Input.addEventListener('input', (e)=>{
        console.log(e);
    });
}

function        validationName(Input){
    Input.addEventListener('input', (e)=>{
        // console.log(Input.value);
        let RExp = /([a-z]\w)/g;
        console.log(RExp.test(Input))
        console.log(RExp);
        //     return(0);
        // else
        //     return(1);
    });
    // console.log(RExp);
}

function        eventName(Input){
    Input.addEventListener('input', (e)=>{
    if (validationName(Input))
        Input.classList.add('error');
    else
        Input.classList.remove('error');
    });
}

function        eventLogin(Input){
    Input.addEventListener('input', (e)=>{
        if (validationLogin(Input))
        Input.classList.add('error');
    else
        Input.classList.remove('error');
    });
}

function        eventEmail(Input){
    Input.addEventListener('input', (e)=>{
        if (validationEmail(Input))
        Input.classList.add('error');
    else
        Input.classList.remove('error');
    });
}

function        eventPasswd(Input){
    Input.addEventListener('input', (e)=>{
        if (validationPasswd(Input))
            Input.classList.add('error');
        else
            Input.classList.remove('error');
    });
}

function        eventConfPasswd(Input, passwd){
    Input.addEventListener('input', (e)=>{
        if (validationConfPasswd(Input, passwd))
        Input.classList.add('error');
        else
            Input.classList.remove('error');
    });
}


const form = document.querySelector('form');
const inputs = form.querySelectorAll('input');
for (var i = 0; i < inputs.length; i++){
    if (inputs[i].name === 'login')
        eventLogin(inputs[i]);
    else if (inputs[i].name === 'firstName' ||
                inputs[i].name === 'lastName')
        eventName(inputs[i]);
    else if (inputs[i].name === 'confPasswd')
        eventConfPasswd(inputs[i], form.querySelector('input[name="passwd"]'));
    else if (inputs[i].type === 'password')
        eventPasswd(inputs[i]);
    else if (inputs[i].type === 'email')
        eventEmail(inputs[i]);
    
}

document.querySelector('form').addEventListener('submit', (e) =>{
    console.log('done');
    // validitForm();
    // alert('ttt');
     e.preventDefault();
    // console.log(e);
   
    e.stopPropagation();
    return false;
});
