<?php
    $inventario   = $this->getMetaLabel('inventario_participativo');
    $conselho_dir = $this->getMetaLabel('conselho_gestor');
?>

<p class="privado">
    <span class="label required"><?php echo $inventario; ?></span>
    <?php if($this->isEditable() || $entity->inventario_participativo): ?>
        <editable-singleselect entity-property="inventario_participativo" empty-label="Selecione" allow-other="true" box-title="<?php echo $inventario; ?>"></editable-singleselect>
    <?php endif; ?>
</p>

<p class="privado">
    <span class="label required"><?php echo $conselho_dir; ?></span>
    <?php if($this->isEditable() || $entity->conselho_gestor): ?>
        <editable-singleselect entity-property="conselho_gestor" empty-label="Selecione" allow-other="true" box-title="<?php echo $conselho_dir; ?>"></editable-singleselect>
    <?php endif; ?>
</p>