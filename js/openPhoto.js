/**
 * Created by ykondrat on 6/3/17.
 */
function openPhoto(photo) {
    var src = photo.getAttribute('src');
    var modalDiv = document.createElement('div');
    modalDiv.className = "modal_window_img";
    modalDiv.id = "modal_photo";
    document.body.insertBefore(modalDiv, document.body.firstChild);
    var insertDiv = document.createElement('div');
    insertDiv.className = "modal_form_img";
    modalDiv.insertBefore(insertDiv, modalDiv.lastChild);
    var img = document.createElement('img');
    img.setAttribute("src", src);
    img.className = "open_img";
    insertDiv.insertBefore(img, insertDiv.lastChild);
}