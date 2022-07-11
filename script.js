function save() {
    localStorage.setItem("download", document.getElementById("save").innerHTML);
}

function load() {
    document.getElementById("content").innerHTML = decodeURI(localStorage.getItem("download"));
}