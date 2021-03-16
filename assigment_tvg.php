<form action="./index.php?content=assigment_create" method="post">
  <div class="form-group form-group-tvg login-picture">
    <h1>Assigment Toevoegen</h1>
    <label for="Hoofdstuk">Hoofdstuk</label>
    <input type="text" class="form-control" id="id" placeholder="1.1, 2.1 & 3.4 enz." aria-describedby="idHelp" name="id">
    
    <label for="lessons">Vakken</label>
    <div class="box">
      <select id="lessons" name="lessons">
        <option value="WEB">WEB</option>
        <option value="NED">NED</option>
        <option value="ENG">ENG</option>
        <option value="BUR">BUR</option>
        <option value="ASP">ASP</option>
      </select>
    </div>
    
    <label for="description">Description</label>
    <input type="text" class="form-control" placeholder="Inhoud van de Opdracht " id="description" aria-describedby="descriptionHelp" name="description">
    

    <label for="lastname">Deadline Datum</label>
    <input type="date" class="form-control" id="deadline" aria-describedby="deadlineHelp" name="deadline">
   
    <button type="submit" class="btn btn-dark btn-lg btn-block mt-4">Toevoegen</button>
  </div>
</form>