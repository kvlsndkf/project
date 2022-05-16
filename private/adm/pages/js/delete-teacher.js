const modalTemplate = `
<div class="modal fade" id="confirm-delete" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content teste">
      <div class="modal-body body-modal">
        <div class="start">
          <span class="modal-title normal-20-bold-modaltitle white-title" id="exampleModalLabel">Excluir professor</span>
          <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div>
            <p class="normal-14-bold-p white-title">
              Tem certeza de que deseja excluir esse professor permanentemente?
            </p>
        </div>
        <div class="warning-container">
          <span class="warning-text normal-12-bold-tiny red-title">Atenção: </span><span class="normal-12-bold-tiny white-title">O professor também será removido das Etec's vincluladas.</span>
        </div>
        <div class="modal-buttons">
          <a class="btn btn-danger button normal-14-bold-p excluir" id="delete-button">Excluir</a>
          <button type="button" class="btn btn-secondary button cancelar normal-14-bold-p" data-bs-dismiss="modal">Cancelar</button>
        </div>
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