const btnclbn = document.getElementById('.librarianbtn');
const btncpfs = document.getElementById('.professorbtn');
const btncstd = document.getElementById('.studentbtn');

const Lbnform = document.querySelector('.lib-form-box');
const Pfsform = document.querySelector('.pfs-form-box');
const Stdform = document.querySelector('.std-form-box');

const msg = document.querySelector('.Message');

function ChangeLibrarian(){
    Lbnform.style.display = "block";
    Pfsform.style.display = "none";
    Stdform.style.display = "none";
    msg.style.display = "none";
}

function ChangeProfessor(){
    Lbnform.style.display = "none";
    Pfsform.style.display = "block";
    Stdform.style.display = "none";
    msg.style.display = "none";
}

function ChangeStudent(){
    Lbnform.style.display = "none";
    Pfsform.style.display = "none";
    Stdform.style.display = "block";
    msg.style.display = "none";
}