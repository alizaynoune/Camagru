/* all Valdition Inputs*/

function        validationPasswd(Input){
    let Ret = 0;
    let RExp1 = /^.*[a-z].*$/;
    let RExp2 = /^.*[A-Z].*$/;
    let RExp3 = /^.*[0-9].*$/;
    let RExp4 = /^.*[~!@#$%^&*()\_\-\+=\\\.\?<>,\[\]\{\}:'";/].*$/;
    if (Input.value.length < 8)
        Ret++;
    if (!RExp1.test(Input.value))
        Ret++;
    if (!RExp2.test(Input.value))
        Ret++;
    if (!RExp3.test(Input.value))
        Ret++;
    if (!RExp4.test(Input.value))
        Ret++;
    return (Ret);
}

function        validationConfPasswd(Input, passwd){
    if (Input.value !== passwd.value)
        return(1);
    else
        return(0);
}

function        validationEmail(Input){
    let RExp = /^[\w-\.]+@([\w-]+\.)+[\w-]{2,4}$/g;
    if (!RExp.test(Input.value))
        return(1);
    else
        return(0);
}



function        validationLogin(Input){
    let RExp = /^[\w-\.]+$/;
    if (!RExp.test(Input.value) || Input.value.length > 15 || Input.value.length < 8)
        return(1);
    else
        return(0);
}

function        validationName(Input){
    let RExp = /^[a-zA-Z]+$/;
    if (!RExp.test(Input.value) || Input.value.length > 10)
        return(1);
    else
        return(0);
}

/* all Event Inputs */

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
        let Pass = validationPasswd(Input);

        if (Pass === 0){
            Input.classList.remove('error');
            Input.classList.remove('PasswdMed');
            Input.classList.add('PasswdGood');
        }
        else if ( Pass <= 2){
            Input.classList.remove('error');
            Input.classList.add('PasswdMed');
            Input.classList.remove('PasswdGood');
        }
        else{
            Input.classList.add('error');
            Input.classList.remove('PasswdMed');
            Input.classList.remove('PasswdGood');
        }
        console.log(Pass);
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

function        eventUserName(Input, passwd){
    Input.addEventListener('input', (e)=>{
        if (validationUserName(Input, passwd))
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
    else if (inputs[i].name === 'passwd')
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

function        togglePasswd(elem){
    var prev = elem.previousElementSibling;
    elem.classList.toggle('fa-eye');
    elem.classList.toggle('fa-eye-slash');
    if (elem.className === 'fa fa-eye-slash'){
        prev.type = 'text';
    }
    else
        prev.type = 'password';
}