<form method="POST" action="./index.php?p=insertTraitement" enctype="multipart/form-data" id="insertForm">
    <div class="mb-3">
        <label for="title" class="form-label">Titre: </label><input type="text" name="title" id="title" maxlength="100" class="form-control">
    </div>
    <div class="mb-3">
        <label for="duration" class="form-label">Durée </label><input type="number" name="duration" id="duration" class="form-control">
    </div>
    <div class="mb-3">
        <label for="description" class="form-label">Description </label>
        <textarea name="description" id="description" cols="30" rows="10" class="form-control"></textarea>
    </div>
    <div class="mb-3">
        <label for="dateSortie" class="form-label">Date de sortie </label><input type="date" name="dateSortie" id="dateSortie" class="form-control">
    </div>
    <div class="mb-3">
        <label for="image" class="form-label">Image: </label><input type="file" name="image" id="image">
    </div>
    <button type="submit" class="btn btn-primary">Insérer</button>
</form>