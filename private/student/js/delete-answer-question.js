const modalTemplateQuestion = `
<div class="modal fade" id="confirm-delete" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Excluir questão</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        Tem certeza de que deseja excluir essa questão permanentemente?
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
  divElement.innerHTML = modalTemplateQuestion;
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

const modalTemplateAnswer = `
<div class="modal fade" id="confirm-delete-answer" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
<div class="modal-dialog">
<div class="modal-content teste">
  <div class="modal-body body-modal">
    <div class="start">
      <span class="modal-title normal-20-bold-modaltitle white-title" id="exampleModalLabel">Excluir resposta</span>
      <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
    </div>
    <div>
        <p class="normal-14-bold-p title">
          Tem certeza de que deseja excluir essa resposta permanentemente?
        </p>
    </div>
    <div class="warning-container1">
      <span class="warning-text normal-12-bold-tiny colortext2">Atenção: </span><span class="normal-12-bold-tiny title">Ao excluir uma resposta você perderá </span> <span class="normal-12-bold-tiny corXp">50xp</span>
    </div>
    <div class="modal-buttons">
      <a class="btn btn-danger button normal-14-bold-p" id="delete-button-answer">Excluir</a>
      <button type="button" class="btn btn-secondary button cancelar normal-14-bold-p" data-bs-dismiss="modal">Cancelar</button>
    </div>
  </div>
</div>
</div>
</div>`;

const aeElements = document.getElementsByClassName("delete-answer");

if (!document.getElementById("confirm-delete-answer")) {
  const divElement = document.createElement("div");
  divElement.innerHTML = modalTemplateAnswer;
  document.body.appendChild(divElement);
}

Array.prototype.forEach.call(aeElements, (aeElement) => {
  aeElement.addEventListener("click", function (event) {
    const href = aeElement.getAttribute("href");

    document.getElementById("delete-button-answer").setAttribute("href", href);

    document.getElementById("confirm-delete-answer").addEventListener("shown", () => {
      return true;
    });

    return false;
  });
});

