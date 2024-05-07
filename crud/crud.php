<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">

  <title>Document</title>
</head>

<body>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
    crossorigin="anonymous"></script>
  <h1 class="text-center p-3">Registro de habitaciones</h1>
  <?php
  include "conn.php";
  include "registhab.php";
  include "eliminar.php";
  ?>
  <div class="container fluid row ">
    <form class=" col col-lg-4 p-4" method="post">
      <h3 class="text-center text-secondary">Habitacion nueva</h3>
      <div class="mb-3">
        <label class="form-label">Tipo de habitacion</label>
        <select class="form-select" aria-label="Default select example" name="habitacion">
          <option value="Sencilla">Sencilla</option>
          <option value="Doble">Doble</option>
          <option value="Familiar">Familiar</option>
        </select>
      </div>
      <div class="mb-3">
        <label class="form-label">Numero de personas</label>
        <select class="form-select" aria-label="Default select example" name="personas">
          <option value="2">2</option>
          <option value="4">4</option>
          <option value="6">6</option>
        </select>

      </div>
      <div class="mb-3">
        <label class="form-label">Precio</label>
        <input type="number" class="form-control" name="precio">
      </div>
      <div class="mb-3">
        <label class="form-label">Reservada</label>
        <select class="form-select" aria-label="Default select example" name="reservada">
          <option value="Si">Si</option>
          <option value="No">No</option>
        </select>

      </div>

      <button type="submit" class="btn btn-primary" name="agregar">Agregar</button>
    </form>

    <div class="col p-2 m-auto">
      <table class="table table-hover">
        <thead class="table-dark">
          <tr>
            <th scope="col">ID</th>
            <th scope="col">Tipo</th>
            <th scope="col">Personas</th>
            <th scope="col">Precio</th>
            <th scope="col">Reservada</th>
            <th> </th>
          </tr>
        </thead>
        <tbody>
          <?php
          include "conn.php";
          $llamar = $conn->query("select * from `habitaciones`");
          while ($datos = $llamar->fetch_object()) { ?>
            <tr>
              <th scope="row"><?= $datos->id ?></th>
              <td><?= $datos->tipo ?></td>
              <td><?= $datos->personas ?></td>
              <td><?= $datos->precio ?></td>
              <td><?= $datos->reservada ?></td>
              <td>
                <a href="modificarFrom.php?id=<?= $datos->id ?>">Editar</a>
                <a href="crud.php?id=<?= $datos->id ?>">Eliminar</a>
              </td>
            </tr>


          <?php }
          ?>


        </tbody>
      </table>
    </div>

  </div>
</body>

</html>