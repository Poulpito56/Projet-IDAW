<div class="custom-table-field">
  <div class="field-name"><?php echo $tra->dietary_preferences; ?></div>
  <select class="text-input" id='dietary_preferences'>
    <option value="1"><?php echo $tra->omnivore; ?></option>
    <option value="2"><?php echo $tra->pescetarian; ?></option>
    <option value="3"><?php echo $tra->vegetarian; ?></option>
    <option value="4"><?php echo $tra->vegan; ?></option>
  </select>
</div>
<div class="custom-table-field">
  <div class="field-name"><?php echo $tra->gender; ?></div>
  <select class="text-input" id='gender'>
    <option value="1"><?php echo $tra->unspecified; ?></option>
    <option value="2"><?php echo $tra->female; ?></option>
    <option value="3"><?php echo $tra->male; ?></option>
  </select>
</div>
<div class="custom-table-field">
  <div class="field-name"><?php echo $tra->email; ?></div>
  <input class="text-input" id="email" name="email" pattern="[A-Za-z0-9_@!?. ]+">
</div>
<div class="custom-table-field">
  <div class="field-name"><?php echo $tra->age; ?></div>
  <input class="text-input" type="number" id="age" name="age" min="1" max="200">
</div>
<div class="custom-table-field">
  <div class="field-name"><?php echo $tra->physical_activity; ?></div>
  <input class="text-input" type="number" id="physical_activity" name="physical_activity" min="1" max="10">
</div>