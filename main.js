let add = document.getElementById("new");
let modal = document.getElementById("modal");
let cancel = document.getElementById("cancel");
let save = document.getElementById("save");

add.addEventListener("click", () => {
    modal.classList.remove('hidden');
});

cancel.addEventListener("click", () => {
    modal.classList.add('hidden');
});
