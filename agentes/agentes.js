// Archivo: agentes.js

document.addEventListener("DOMContentLoaded", function() {
  const agentesLista = document.getElementById("agentes-lista");

  // Información de los agentes
  const agentes = [
    { nombre: "Gekko", uuid: "e370fa57-4757-3604-3648-499e1f642d3f" },
    { nombre: "Fade", uuid: "dade69b4-4f5a-8528-247b-219e5a1facd6" },
    { nombre: "Viper", uuid: "707eab51-4836-f488-046a-cda6bf494859" },
    { nombre: "Breach", uuid: "1e58de9c-4950-5125-93e9-a0aee9f98746" },
    { nombre: "Sage", uuid: "569fdd95-4d10-43ab-ca70-79becc718b46" },
    { nombre: "Phoenix", uuid: "eb93336a-449b-9c1b-0a54-a891f7921d69" },
    { nombre: "Brimstone", uuid: "9f0d8ba9-4140-b941-57d3-a7ad57c6b417" },
    { nombre: "Cypher", uuid: "117ed9e3-49f3-6512-3ccf-0cada7e3823b" },
    { nombre: "Sova", uuid: "ded3520f-4264-bfed-162d-b080e2abccf9" },
    { nombre: "Omen", uuid: "8e253930-4c05-31dd-1b6c-968525494517" },
    { nombre: "Jett", uuid: "add6443a-41bd-e414-f6ad-e58d267f4e95" },
    { nombre: "Raze", uuid: "f94c3b30-42be-e959-889c-5aa313dba261" },
    { nombre: "Reyna", uuid: "a3bfb853-43b2-7238-a4f1-ad90e9e46bcc" },
    { nombre: "Killjoy", uuid: "1e58de9c-4950-5125-93e9-a0aee9f98746" },
    { nombre: "Yoru", uuid: "7f94d92c-4234-0a36-9646-3a87eb8b5c89" },
    { nombre: "Skye", uuid: "6f2a04ca-43e0-be17-7f36-b3908627744d" },
    { nombre: "Astra", uuid: "41fb69c1-4189-7b37-f117-bcaf1e96f1bf" },
    { nombre: "KAY/O", uuid: "601dbbe7-43ce-be57-2a40-4abd24953621" },
    { nombre: "Iso", uuid: "0e38b510-41a8-5780-5e8f-568b2a4f2d6c" },
    { nombre: "Neon", uuid: "bb2a4828-46eb-8cd1-e765-15848195d751" },
    { nombre: "Deadlock", uuid: "cc8b64c8-4b25-4ff9-6e7f-37b4da43d235" },
    { nombre: "Breach", uuid: "5f8d3a7f-467b-97f3-062c-13acf203c006" },
    { nombre: "Chamber", uuid: "22697a3d-45bf-8dd7-4fec-84a9e28c69d7" },
    { nombre: "Harbor", uuid: "95b78ed7-4637-86d9-7e41-71ba8c293152" }
  ];

  // Mostrar la lista de agentes cuando la página se carga
  mostrarAgentes();

  // Función para mostrar la información del agente cuando se hace clic
  function mostrarInfoAgente(event) {
    const uuid = event.target.dataset.uuid;
    if (uuid) {
      window.location.href = `agentes/agente.php?uuid=${uuid}`;
    }
  }

  // Función para mostrar la lista de agentes
  function mostrarAgentes() {
    agentes.forEach(agente => {
      const divAgente = document.createElement("div");
      divAgente.innerHTML = `
        <h2>${agente.nombre}</h2>
        <a href="#" class="agente-link" data-uuid="${agente.uuid}">
          <img src="https://media.valorant-api.com/agents/${agente.uuid}/displayicon.png" alt="${agente.nombre}" class="agent-img">
        </a>
      `;
      agentesLista.appendChild(divAgente);
    });
  }

  // Agregar un evento de clic a cada enlace de agente
  agentesLista.addEventListener("click", function(event) {
    if (event.target.matches(".agente-link")) {
      event.preventDefault(); // Evitar que el enlace siga su URL
      mostrarInfoAgente(event);
    }
  });
});
