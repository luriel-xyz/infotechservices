<!-- if hardware components array is empty -->
<?php if (!$hardware_components) : ?>
  <div class="alert alert-info text-center">
    <?= "No Data Found!"; ?>
  </div>
  <!-- if not empty -->
<?php else : ?>
  <table class="table table-hover text-center">
    <thead class="blue-grey lighten-4">
      <th>Hardware Component Name</th>
      <th>Hardware Component Type</th>
      <th>Hardware Sub Component Category</th>
      <th>Action</th>
    </thead>
    <tbody id="table_body">
      <?php
      foreach ($hardware_components as $component) :
        if ($component->hwcomponent_type === 'sub') {
          $hwcomponent = App\Hardware::find($component->hwcomponent_category);
        }
      ?>
        <tr>
          <td class="font-weight-bold"> <?= $component->hwcomponent_name ?> </td>
          <td> <?= $component->hwcomponent_type ?> </td>
          <td>
            <?php if ($component->hwcomponent_type === 'sub' && $hwcomponent) : ?>
              <?= $hwcomponent->hwcomponent_name ?>
            <?php endif; ?>
          </td>
          <td>
            <button type="button" class="btn btn-sm btn-primary edit-hardware" id="<?= $component->hwcomponent_id ?>" data-toggle="tooltip" title="Edit"><i class="fa fa-pen-square" aria-hidden="true"></i></button>
          </td>
        </tr>
      <?php endforeach; ?>
    </tbody>
  </table>
  </div>
  </div>
<?php endif; ?>