let form = {
  student: document.querySelector("#form-student"),
  professor: document.querySelector("#form-professor"),
  librarian: document.querySelector("#form-librarian")
}
const inputs_HTML = document.querySelectorAll("input[type = 'radio']");
let checkes = [];
let submit = document.querySelector("button[type = submit]");

const ChangeRol = () => {
  
  checkes = [];
  let label = null;

  inputs_HTML.forEach( input_HTML => {
    
    label = document.querySelector(`#${input_HTML.id.replace("input", "label")}`);
    if(input_HTML.checked){  
      label.classList.add('control-rol__label-active');
      submit.value = input_HTML.id.substring(input_HTML.id.lastIndexOf('-') + 1);
      submit.for = `form-${submit.value}`;
      
      for (const key in form) {
        let element = form[key];
        element.hidden = !(element.id === submit.for);
      }
    }else {
      label.classList.remove('control-rol__label-active');
    }
    
    checkes.push(input_HTML.checked);
  });
}

inputs_HTML.forEach((input_HTML) => {
  input_HTML.addEventListener("change", ChangeRol);
});
