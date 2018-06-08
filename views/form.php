<div class="row">
    <div class="col-sm-6">
        <div class="form-group">
            <label for="name">Titre</label>
            <input id="name" class="form-control" type="text" name="name" required value="<?= isset($data['name']) ? security($data['name']) :''; ?>">
            <?php if(isset($errors['name'])): ?>
            <small class='form-text text-muted'><?= $errors['name']; ?></small>
            <?php endif; ?>
        </div>
    </div>
    <div class="col-sm-6">
        <div class="form-group">
            <label for="date">Date</label>
            <input class="form-control" type="date" name="date" id="date" required value="<?= isset($data['date']) ? security($data['date']) :''; ?>">
            <?php if(isset($errors['date'])): ?>
            <small class='form-text text-muted'><?= $errors['date']; ?></small>
            <?php endif; ?>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-sm-6">
        <div class="form-group">
            <label for="start">Début</label>
            <input class="form-control" type="time" name="start" id="start" placeholder="HH:MM" required value="<?= isset($data['start']) ? security($data['start']) :''; ?>">
            <?php if(isset($errors['start'])): ?>
            <small class='form-text text-muted'><?= $errors['start']; ?></small>
            <?php endif; ?>
        </div>
    </div>
    <div class="col-sm-6">
        <div class="form-group">
            <label for="end">Fin</label>
            <input class="form-control" type="time" name="end" id="end" placeholder="HH:MM" required value="<?= isset($data['end']) ? security($data['end']) :''; ?>">
            <?php if(isset($errors['end'])): ?>
            <small class='form-text text-muted'><?= $errors['end']; ?></small>
            <?php endif; ?>
        </div>
    </div>
</div>
<div class="form-group">
    <label for="description">Description</label>
    <textarea class="form-control"  name="description" id="description"><?= isset($data['description']) ? security($data['description']) :''; ?></textarea>
</div>