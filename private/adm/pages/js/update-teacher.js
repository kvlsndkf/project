const teacherUpdateModalTemplate = `
<div class="modal fade" id="confirm-update" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Editar professor</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form id="update-form" action="" method="post" enctype="multipart/form-data">
          <p>
              <label>Nome professor</label>
              <input type="text" name="updateName" id="updateName" value="">
          </p>

          <p>
              <label>Foto</label>
              <img id="image" width="100px"/>
              <input type="file" name="updatePhoto" id="updatePhoto">
              <input type="hidden" name="oldPhoto" id="oldPhoto" value="">
          </p>
        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
        <button type="submit" class="btn btn-primary">Editar</a>
      </div>
    </div>
  </div>
</div>`;

const aElementsUpdate = document.getElementsByClassName("update");

if (!document.getElementById("confirm-update")) {
  const divElementUpdate = document.createElement("div");
  divElementUpdate.innerHTML = teacherUpdateModalTemplate;
  document.body.appendChild(divElementUpdate);
}

Array.prototype.forEach.call(aElementsUpdate, (aElementUpdate) => {
  aElementUpdate.addEventListener("click", function (event) {
    const href = aElementUpdate.getAttribute("href");
    const name = aElementUpdate.getAttribute("data-bs-name");
    const photo = aElementUpdate.getAttribute("data-bs-photo");
    document.getElementById("update-form").setAttribute("action", href);

    document.getElementById("updateName").value = name;
    document.getElementById("oldPhoto").value = photo;
    document.getElementById("image").src = photo;
    
    document.getElementById("confirm-update").addEventListener("shown", () => {
      return true;
    });

    return false;
  });
});