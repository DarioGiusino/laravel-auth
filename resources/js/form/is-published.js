//get elements from dom
const checkbox = document.getElementById("is_published");
const checkboxLabel = document.getElementById("toggle-label");

checkbox.addEventListener("click", () => {
    if (checkbox.checked) {
        checkboxLabel.innerText = "Will be published";
        checkboxLabel.classList.remove("text-danger");
        checkboxLabel.classList.add("text-success");
    } else {
        checkboxLabel.innerText = "Will be drafted";
        checkboxLabel.classList.remove("text-success");
        checkboxLabel.classList.add("text-danger");
    }
});
