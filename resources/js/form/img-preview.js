// get elements from dom
const imageInput = document.getElementById("image");
const previewField = document.getElementById("preview");

// fallback image
const placeholder = "https://marcolanci.it/utils/placeholder.jpg";

// on imageInput(value) change
imageInput.addEventListener("change", () => {
    // if a file is given
    if (imageInput.files && imageInput.files[0]) {
        // define a new file reader
        const reader = new FileReader();

        // transform the file in a correct url
        reader.readAsDataURL(imageInput.files[0]);

        // when ready
        reader.onload = (e) => {
            previewField.src = e.target.result;
        };
    }
    // else return the fallback image
    else previewField.src = placeholder;
});
