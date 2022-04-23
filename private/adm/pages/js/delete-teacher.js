const modalTemplate = `
<div class="modal fade" id="confirm-delete" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Excluir professor</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        Tem certeza de que deseja excluir esse professor permanentemente?
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fechar</button>
        <a class="btn btn-danger" id="delete-button">Excluir</a>
      </div>
    </div>
  </div>
</div>`;

const aElements = document.getElementsByClassName("delete");

if (!document.getElementById("confirm-delete")) {
  const divElement = document.createElement("div");
  divElement.innerHTML = modalTemplate;
  document.body.appendChild(divElement);
}

Array.prototype.forEach.call(aElements, (aElement) => {
  aElement.addEventListener("click", function (event) {
    const href = aElement.getAttribute("href");

    document.getElementById("delete-button").setAttribute("href", href);

    document.getElementById("confirm-delete").addEventListener("shown", () => {
      return true;
    });

    return false;
  });
});