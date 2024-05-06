const editButtons = document.querySelectorAll('#panel .admin-buttons button.edit-btn');
const addButton = document.querySelector('#panel .add-button');
addButton.addEventListener("click", openAddModal);
let queue = document.querySelector('h2[value]');

switch (queue.textContent) {
    case 'Партньори': queue = 'partners';
        break;
    case 'Екип': queue = 'team';
        break;
    case 'Съдържание': queue = 'content';
        break;
} 

console.log(q);


editButtons.forEach(b => b.addEventListener('click', openEditModal));

function openEditModal(event) {
    const modal = document.createElement("div");
    modal.setAttribute("class", "modal");
    //add modal to the parent element 

    modal.addEventListener("keypressed", (e) => {
        console.log(e);
    });

    document.querySelector(".site-main").append(modal);

    const closeBtn = document.createElement("i");
    closeBtn.setAttribute("class", "fas fa-times closeBtn");
    //close function
    closeBtn.onclick = () => {
        modal.remove();
    };

    const item1 = event.target.parentElement.parentElement;
    const item2 = event.target.parentElement.parentElement;
    const id = item1.id;

    const value1 = item1.querySelector('.title').textContent;
    const value2 = item2.querySelector('.author').textContent;

    const formContiner = createForm(value1, value2, id);
    modal.append(closeBtn, formContiner);
}

function createForm(value1, value2, id) {
    let input1, input2, input3, input4;
    const formContainer = document.createElement('div');
    formContainer.classList.add("form-container");

    const form = document.createElement('form');
    form.classList.add('panel-form');
    form.setAttribute("method", "POST");
    form.setAttribute('action', `./panel?q=${queue}`);
    form.enctype = 'multipart/form-data';

    const formHeading = document.createElement("h2");
    formHeading.textContent = document.querySelector('h2[value]').textContent;
    form.append(formHeading);

    input1 = document.createElement('input');
    input1.name = 'memberName';

    input2 = document.createElement('input');
    input2.name = 'title';

    input3 = document.createElement('input');
    input3.type = 'file';
    input3.name = 'image';
    input3.accept = 'image/*';

    const submitButton = document.createElement('button');
    submitButton.type = "submit";

    if (value1 && value2) {
        submitButton.textContent = 'Редактирай';
        submitButton.name = 'edit-team';

        input1.value = value1;

        if(queue == "content") {
            input2 = document.createElement("textarea");
            input2.name = 'title';
            input2.rows = 10;
            input2.cols = 50;
            input2.textContent = value2;
        } else {
            input2.value = value2;
        }

        input4 = document.createElement("input");
        input4.type = "hidden";
        input4.value = id;
        input4.name = "team-id";

        form.append(input4);
    } else {
        submitButton.textContent = 'Добави';
        submitButton.name = 'add-team';

        let placeholder1, placeholder2;

        switch (queue) {
            case 'team':
                placeholder1 = "Имена";
                placeholder2 = "Титла";
            break;
            
            case 'partners':
                placeholder1 = 'Име на партньор';
                placeholder2 = 'Ранк на партньор';
            break;
            
            case 'content':
                placeholder1 = "Заглавие";
                placeholder2 = "Съдържание...";

                input2 = document.createElement("textarea");
                input2.name = 'title';

            break;
        }

        input1.placeholder = placeholder1;
        input2.placeholder = placeholder2;


        form.append(input3);
    }

    form.append(input1, input2, input3, submitButton);
    formContainer.append(form);

    return formContainer;
}

function openAddModal() {
    const modal = document.createElement("div");
    modal.setAttribute("class", "modal");
    //add modal to the parent element 
    document.querySelector(".site-main").append(modal);

    const closeBtn = document.createElement("i");
    closeBtn.setAttribute("class", "fas fa-times closeBtn");
    //close function
    closeBtn.onclick = () => {
        modal.remove();
    };

    const formContiner = createForm();
    modal.append(closeBtn, formContiner);
}