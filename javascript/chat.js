const form = document.querySelector(".typing-area"),
    incoming_id = form.querySelector(".incoming_id").value,
    inputField = form.querySelector(".input-field"),
    sendBtn = form.querySelector(".send"),
    chatBox = document.querySelector(".chat-box");

form.onsubmit = (e) => {
    e.preventDefault();
}

inputField.focus();
inputField.onkeyup = () => {
    if (inputField.value != "") {
        sendBtn.classList.add("active");
    } else {
        sendBtn.classList.remove("active");
    }
}

// Send Button (Text)
sendBtn.onclick = () => {
    let xhr = new XMLHttpRequest();
    xhr.open("POST", "php/insert-chat.php", true);
    xhr.onload = () => {
        if (xhr.readyState === XMLHttpRequest.DONE) {
            if (xhr.status === 200) {
                inputField.value = "";
                scrollToBottom();
            }
        }
    }
    let formData = new FormData(form);
    xhr.send(formData);
}

chatBox.onmouseenter = () => {
    chatBox.classList.add("active");
}

chatBox.onmouseleave = () => {
    chatBox.classList.remove("active");
}

setInterval(() => {
    let xhr = new XMLHttpRequest();
    xhr.open("POST", "php/get-chat.php", true);
    xhr.onload = () => {
        if (xhr.readyState === XMLHttpRequest.DONE) {
            if (xhr.status === 200) {
                let data = xhr.response;
                chatBox.innerHTML = data;
                if (!chatBox.classList.contains("active")) {
                    scrollToBottom();
                }
            }
        }
    }
    xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    xhr.send("incoming_id=" + incoming_id);
}, 500);

function scrollToBottom() {
    chatBox.scrollTop = chatBox.scrollHeight;
}


// Attachment Form (Images, VIdeo, File)
const attachForm = document.querySelector(".attachForm form"),
    attachBtn = attachForm.querySelector(".submitAttach"),
    msgText = attachForm.querySelector(".msg-text"),
    successText = attachForm.querySelector(".success-text"),
    errorText = attachForm.querySelector(".error-text");

attachForm.onsubmit = (e) => {
    e.preventDefault();
}

function getFileData(myFile) {
    var file = myFile.files[0];
    var filename = file.name;
    msgText.style.display = "block";
    msgText.textContent = "Attached File: " + filename;
}

function openAttach() {
    document.getElementById("attachForm").style.display = "block";
    window.scrollTo(0, document.body.scrollHeight);
}
function closeAttach() {
    document.getElementById("attachForm").style.display = "none";
}

attachBtn.onclick = () => {
    let xhr = new XMLHttpRequest();
    xhr.open("POST", "php/upload.php", true);
    xhr.onload = () => {
        if (xhr.readyState === XMLHttpRequest.DONE) {
            if (xhr.status === 200) {
                let data = xhr.response;
                if (data === "success") {
                    errorText.style.display = "none";
                    successText.style.display = "block";
                    successText.textContent = data;
                } else {
                    successText.style.display = "none";
                    errorText.style.display = "block";
                    errorText.textContent = data;
                }
                window.scrollTo(0, document.body.scrollHeight);
            }
        }
    }
    let formData = new FormData(attachForm);
    xhr.send(formData);
}