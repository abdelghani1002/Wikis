let editBtns = Array.from(document.querySelectorAll(".editBtn"));
editBtns.forEach(btn => {
    btn.addEventListener("click", () => {
        let form = document.querySelector("#form");
        form.querySelector("input").value = btn.getAttribute('data-name');
        form.querySelector("input").focus();
        form.querySelector("button").textContent = "Edit";
        form.querySelector("button").setAttribute("name", "id");
        form.querySelector("button").setAttribute("value", btn.getAttribute("data-id"));
        let formAction = form.action;
        form.action = formAction.replace("/store", "/update")
        console.log(form.action);
    })
});