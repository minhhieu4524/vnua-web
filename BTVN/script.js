const input = document.getElementById("textInput");
const count = document.getElementById("count");

input.addEventListener("input", function () {
    count.textContent = input.value.length;
});