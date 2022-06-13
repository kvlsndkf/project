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
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Excluir resposta</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        Tem certeza de que deseja excluir essa resposta permanentemente?
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fechar</button>
        <a class="btn btn-danger" id="delete-button-answer">Excluir</a>
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

