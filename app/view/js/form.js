function        togglePasswd(target, elem){
    console.log(elem.className);
        elem.classList.toggle('fa-eye');
    elem.classList.toggle('fa-eye-slash');
    if (elem.className.search('fa-eye-slash') !== -1 ){
        target.type = 'password';
        console.log('ggg');
        
    }
    else
        target.type = 'text';
}
