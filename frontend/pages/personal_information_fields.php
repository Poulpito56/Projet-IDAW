<tr>
  <th><?php echo $tra->dietary_preferences; ?></th>
  <td>
    <select id='dietary_preferences'>
      <option value="1"><?php echo $tra->omnivore; ?></option>
      <option value="2"><?php echo $tra->pescetarian; ?></option>
      <option value="3"><?php echo $tra->vegetarian; ?></option>
      <option value="4"><?php echo $tra->vegan; ?></option>
    </select>
  </td>
</tr>
<tr>
  <th><?php echo $tra->gender; ?></th>
  <td>
    <select id='gender'>
      <option value="1"><?php echo $tra->unspecified; ?></option>
      <option value="2"><?php echo $tra->female; ?></option>
      <option value="3"><?php echo $tra->male; ?></option>
    </select>
  </td>
</tr>
<tr>
  <th><?php echo $tra->email; ?></th>
  <td><input id="email" name="email" pattern="[A-Za-z0-9_@!?. ]+"></td>
</tr>
<tr>
  <th><?php echo $tra->age; ?></th>
  <td><input type="number" id="age" name="age" min="1" max="200"></td>
</tr>
<tr>
  <th><?php echo $tra->physical_activity; ?></th>
  <td><input type="number" id="physical_activity" name="physical_activity" min="1" max="10"></td>
</tr>