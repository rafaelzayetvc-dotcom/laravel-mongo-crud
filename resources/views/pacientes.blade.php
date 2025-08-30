<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Pacientes - CRUD</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="container py-4">

    <h1 class="mb-4">Gestión de Pacientes</h1>

    <!-- Formulario -->
    <div class="card mb-4">
        <div class="card-body">
            <h5 id="formTitle">Nuevo Paciente</h5>
            <form id="pacienteForm">
                <input type="hidden" id="pacienteId">
                <div class="row g-3">
                    <div class="col-md-3">
                        <input type="text" id="nombre" class="form-control" placeholder="Nombre" required>
                    </div>
                    <div class="col-md-2">
                        <input type="number" id="edad" class="form-control" placeholder="Edad">
                    </div>
                    <div class="col-md-3">
                        <input type="email" id="email" class="form-control" placeholder="Email">
                    </div>
                    <div class="col-md-3">
                        <input type="text" id="telefono" class="form-control" placeholder="Teléfono">
                    </div>
                </div>
                <button type="submit" class="btn btn-primary mt-3" id="submitBtn">Agregar</button>
                <button type="button" class="btn btn-secondary mt-3 d-none" id="cancelBtn">Cancelar</button>
            </form>
        </div>
    </div>

    <!-- Tabla -->
    <table class="table table-bordered" id="pacientesTable">
        <thead class="table-light">
            <tr>
                <th>Nombre</th>
                <th>Edad</th>
                <th>Email</th>
                <th>Teléfono</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody></tbody>
    </table>

    <script>
        const API_URL = "/api/pacientes";
        let editMode = false;

        // Cargar pacientes
        async function loadPacientes() {
            const res = await fetch(API_URL);
            const data = await res.json();
            const tbody = document.querySelector("#pacientesTable tbody");
            tbody.innerHTML = "";
            data.data.forEach(p => {
                tbody.innerHTML += `
                    <tr>
                        <td>${p.nombre}</td>
                        <td>${p.edad ?? ''}</td>
                        <td>${p.email ?? ''}</td>
                        <td>${p.telefono ?? ''}</td>
                        <td>
                            <button class="btn btn-sm btn-warning me-2" onclick="editPaciente('${p.id}', '${p.nombre}', '${p.edad ?? ''}', '${p.email ?? ''}', '${p.telefono ?? ''}')">Editar</button>
                            <button class="btn btn-sm btn-danger" onclick="deletePaciente('${p.id}')">Eliminar</button>
                        </td>
                    </tr>
                `;
            });
        }

        // Crear o actualizar paciente
        document.getElementById("pacienteForm").addEventListener("submit", async (e) => {
            e.preventDefault();
            const id = document.getElementById("pacienteId").value;
            const paciente = {
                nombre: document.getElementById("nombre").value,
                edad: document.getElementById("edad").value,
                email: document.getElementById("email").value,
                telefono: document.getElementById("telefono").value,
            };

            if (editMode && id) {
                await fetch(`${API_URL}/${id}`, {
                    method: "PUT",
                    headers: { "Content-Type": "application/json" },
                    body: JSON.stringify(paciente),
                });
            } else {
                await fetch(API_URL, {
                    method: "POST",
                    headers: { "Content-Type": "application/json" },
                    body: JSON.stringify(paciente),
                });
            }

            resetForm();
            loadPacientes();
        });

        // Editar paciente
        function editPaciente(id, nombre, edad, email, telefono) {
            editMode = true;
            document.getElementById("formTitle").innerText = "Editar Paciente";
            document.getElementById("submitBtn").innerText = "Actualizar";
            document.getElementById("cancelBtn").classList.remove("d-none");

            document.getElementById("pacienteId").value = id;
            document.getElementById("nombre").value = nombre;
            document.getElementById("edad").value = edad;
            document.getElementById("email").value = email;
            document.getElementById("telefono").value = telefono;
        }

        // Cancelar edición
        document.getElementById("cancelBtn").addEventListener("click", () => {
            resetForm();
        });

        // Resetear formulario
        function resetForm() {
            editMode = false;
            document.getElementById("formTitle").innerText = "Nuevo Paciente";
            document.getElementById("submitBtn").innerText = "Agregar";
            document.getElementById("cancelBtn").classList.add("d-none");
            document.getElementById("pacienteForm").reset();
            document.getElementById("pacienteId").value = "";
        }

        // Eliminar paciente
        async function deletePaciente(id) {
            await fetch(`${API_URL}/${id}`, { method: "DELETE" });
            loadPacientes();
        }

        // Inicial
        loadPacientes();
    </script>
</body>
</html>
