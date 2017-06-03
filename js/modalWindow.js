var modalForm = document.getElementById('modal');
var modalController = document.getElementById('modal_controller');
var avatarForm = document.getElementById('upload');
var avatarController = document.getElementById('avatar');
var modalPhoto = document.getElementById('modal_photo');

if (modalController) {
    modalController.onclick = function () {
        if (modalForm.style.display == "none" || !modalForm.style.display) {
            modalForm.style.display = "block";
        } else {
            modalForm.style.display = "none";
        }
    }
}

if (avatarController) {
    avatarController.onclick = function () {
        if (avatarForm.style.display == "none" || !avatarForm.style.display) {
            avatarForm.style.display = "block";
        } else {
            avatarForm.style.display = "none";
        }
    }
}

window.onclick = function(event) {
    if (event.target == modalForm) {
        modalForm.style.display = "none";
    }
    if (event.target == avatarForm) {
        avatarForm.style.display = "none";
    }
    if (event.target == modalPhoto) {
        modalPhoto.style.display = "none";
    }
};