function show_add() {
    document.getElementById("my_add").classList.toggle("show");
}

window.onclick = function(event) {
    if (!event.target.matches(".drop_btn")) {
        var myadd = document.getElementById("my_add");
        if (myadd.classList.contain("show"))
            myadd.classList.remove("show");
    } 
}